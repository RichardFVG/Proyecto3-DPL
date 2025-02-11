<?php
// controllers/ProductosController.php

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Voto.php';

class ProductosController {
    private $productoModel;
    private $votoModel;

    public function __construct() {
        $this->productoModel = new Producto();
        $this->votoModel = new Voto();
    }

    private function checkLogin() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: ../../public/index.php?controller=Login&action=login"); // Redirigir al login si no está logueado
            exit;
        }
    }

    public function listar() {
        // Verifico si está logueado
        $this->checkLogin();  

        // Obtengo todos los productos
        $productos = $this->productoModel->getAll();

        // Obtengo las valoraciones para cada producto
        foreach ($productos as &$producto) {
            $valoracion = $this->votoModel->getValoracion($producto['id']);
            $producto['media'] = $valoracion['media'] ? round($valoracion['media'], 2) : 'N/A';
            $producto['total'] = $valoracion['total'] ?? 0;
        }

        // Paso los productos con sus valoraciones a la vista
        require_once __DIR__ . '/../views/productos/listado.php';
    }

    public function detalle($id) {
        // Verifico si está logueado
        $this->checkLogin();  

        // Obtengo y muestra el detalle de un producto
        $producto = $this->productoModel->getById($id);
        require_once __DIR__ . '/../views/productos/detalle.php';
    }

    public function crear() {
        // Verifico si está logueado
        $this->checkLogin();  

        // Creo un nuevo producto
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            $this->productoModel->create($nombre, $descripcion, $precio);
            header("Location: ../../public/index.php?controller=Productos&action=listar");
        } else {
            require_once __DIR__ . '/../views/productos/crear.php';
        }
    }

    public function update($id) {
        // Verifico si está logueado
        $this->checkLogin();  

        // Actualizo un producto
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];

            $this->productoModel->update($id, $nombre, $descripcion, $precio);
            header("Location: ../../public/index.php?controller=Productos&action=detalle&id=$id");
        } else {
            $producto = $this->productoModel->getById($id);
            require_once __DIR__ . '/../views/productos/update.php';
        }
    }

    public function borrar($id) {
        // Verifico si está logueado
        $this->checkLogin();  

        // Elimina un producto
        $this->productoModel->delete($id);
        header("Location: ../../public/index.php?controller=Productos&action=listar");
    }

    public function getValoraciones($idPr) {
        // Llamo al método del modelo de Voto para obtener la valoración
        return $this->votoModel->getValoracion($idPr);
    }
}
