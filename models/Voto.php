<?php
// models/Voto.php

require_once __DIR__ . "/../config/db.php";

class Voto {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function votar($idUs, $idPr, $cantidad) {
        // Verifico si el usuario ya ha votado este producto
        $check = $this->db->prepare("SELECT * FROM votos WHERE idUs = ? AND idPr = ?");
        $check->execute([$idUs, $idPr]);
        $resultado = $check->fetch(PDO::FETCH_ASSOC);

        // Si ya ha votado, devuelve false
        if ($resultado) {
            return false;
        } else {
            // Si no, se inserta la valoración
            $stmt = $this->db->prepare("INSERT INTO votos (idUs, idPr, cantidad) VALUES (?, ?, ?)");
            $stmt->execute([$idUs, $idPr, $cantidad]);
            return true;
        }
    }

    public function getValoracion($idPr) {
        // Consulto el promedio (AVG) y el total (COUNT) de valoraciones para un producto
        $stmt = $this->db->prepare("SELECT AVG(cantidad) AS media, COUNT(*) AS total FROM votos WHERE idPr = ?");
        $stmt->execute([$idPr]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // En caso de que no haya filas, devuelve un array por defecto
        if (!$data) {
            return [
                'media' => null,
                'total' => 0
            ];
        }

        return $data;
    }
}
