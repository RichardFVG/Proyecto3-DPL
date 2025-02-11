<?php
// controllers/LoginController.php

require_once __DIR__ . '/../config/db.php';

class LoginController
{
    public function login()
    {
        // Fuerzo la salida como JSON
        header('Content-Type: application/json; charset=utf-8');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? null;
            $password = $_POST['password'] ?? null;

            if (!$usuario || !$password) {
                // Faltan datos, error en JSON
                echo json_encode([
                    'ok' => false,
                    'msg' => 'Faltan credenciales.'
                ]);
                exit;
            }

            $db = Database::connect();

            // Verifico si existe el usuario en la BD
            $stmt = $db->prepare("SELECT * FROM usuarios WHERE usuario=? AND password=?");
            $stmt->execute([$usuario, $password]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($user) {
                // Credenciales correctos => se crea sesión
                session_start();
                $_SESSION['usuario'] = $user['usuario'];

                echo json_encode([
                    'ok' => true,
                    'msg' => 'Login correcto',
                    'redirectUrl' => '../../public/index.php?controller=Productos&action=listar'
                ]);
                exit;
            } else {
                // Credenciales inválidos
                // Ajusto la zona horaria a la de Islas Canarias
                date_default_timezone_set('Atlantic/Canary');

                // Construyo la fecha/hora real en el formato deseado
                $tz = new \DateTimeZone('Atlantic/Canary');
                $now = new \DateTime('now', $tz);
                $offsetStr = $now->format('P');          // p.ej. +00:00
                // Quito los dos puntos para ponerlo en el estilo "GMT+0000"
                $offsetStrNoColon = str_replace(":", "", $offsetStr);
                $fechaFormateada = $now->format("D M d Y H:i:s") . " GMT{$offsetStrNoColon} (hora de Islas Canarias)";

                // Simulo “debugOutput” parecido a Xajax
                // Incluyo un mensaje explícito de que user/pass están incorrectos
                $fakeDebugOutput = "
{$fechaFormateada}
CALLING: xjxFu
  [Usuario/Contraseña inválidos]
  URI: include/validar.php

RECEIVED [status: 200, size: 27 bytes, time: 19ms]
{\"xjxrv\":false,\"xjxobj\":[]}

DONE [208ms]
                ";

                echo json_encode([
                    'ok' => false,
                    'msg' => 'Usuario o contraseña incorrectos.',
                    'debugOutput' => $fakeDebugOutput
                ]);
                exit;
            }
        } else {
            // Si no es POST, se muestra la vista normal de login
            require_once __DIR__ . '/../views/login/index.php';
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        // Redirige al login tras cerrar sesión
        header("Location: ../../public/index.php?controller=Login&action=login");
        exit;
    }
}
