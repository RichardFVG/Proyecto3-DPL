<?php
// public/index.php

require_once __DIR__ . '/../controllers/LoginController.php';
require_once __DIR__ . '/../controllers/ProductosController.php';

$controller = $_GET['controller'] ?? 'Login';
$action = $_GET['action'] ?? 'index';

if ($controller == 'Login') {
    $loginCtrl = new LoginController();
    if ($action == 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $loginCtrl->login(); // Llamada al método login
    } elseif ($action == 'logout') {
        $loginCtrl->logout(); // Llamada al método logout
    } else {
        require_once __DIR__ . '/../views/login/index.php'; // Muestra el formulario si no hay POST
    }
} elseif ($controller == 'Productos') {
    $productosCtrl = new ProductosController();
    if ($action == 'listar') {
        $productosCtrl->listar();
    } elseif ($action == 'detalle') {
        $productosCtrl->detalle($_GET['id']);
    } elseif ($action == 'crear') {
        $productosCtrl->crear();
    } elseif ($action == 'update') {
        $productosCtrl->update($_GET['id']);
    } elseif ($action == 'borrar') {
        $productosCtrl->borrar($_GET['id']);
    }
}
