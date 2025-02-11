<?php
// controllers/VotosController.php

require_once __DIR__ . '/../models/Voto.php';

class VotosController {
    private $votoModel;

    public function __construct() {
        $this->votoModel = new Voto();
    }

    public function store() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            echo json_encode(["ok" => false, "msg" => "No estás logueado"]);
            return;
        }

        $idUs = $_SESSION['usuario'];
        $idPr = $_POST['idPr'];
        $cantidad = $_POST['cantidad'];

        $exito = $this->votoModel->votar($idUs, $idPr, $cantidad);

        if (!$exito) {
            echo json_encode(["ok" => false, "msg" => "Ya has valorado este producto"]);
        } else {
            echo json_encode(["ok" => true, "msg" => "Valoración guardada con éxito"]);
        }
    }
}
