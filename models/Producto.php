<?php
// models/Producto.php

require_once __DIR__ . "/../config/db.php";

class Producto {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM productos ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nombre, $descripcion, $precio) {
        $stmt = $this->db->prepare("INSERT INTO productos (nombre, descripcion, precio) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $precio]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nombre, $descripcion, $precio) {
        $stmt = $this->db->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=? WHERE id=?");
        return $stmt->execute([$nombre, $descripcion, $precio, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id=?");
        return $stmt->execute([$id]);
    }
}
