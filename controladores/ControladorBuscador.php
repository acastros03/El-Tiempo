<?php
require_once __DIR__ . '/../modelos/TiempoAPI.php';

class ControladorBuscador {
    public function index() {
        $ciudades = [];
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ciudad = trim($_POST['ciudad']);
            if (!preg_match('/^[a-zA-ZÀ-ÿ\s\-\.]+$/', $ciudad)) {
                $error = "Por favor introduce un nombre de ciudad válido.";
            } else {
                $api = new TiempoAPI();
                $ciudades = $api->buscarCiudad($ciudad);
                if (empty($ciudades)) $error = "No se encontró ninguna ciudad con ese nombre.";
            }
        }

        require_once __DIR__ . '/../vistas/buscador.php';
    }
}
