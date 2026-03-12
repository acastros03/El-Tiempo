<?php
require_once __DIR__ . '/../modelos/ConsultaDAO.php';

class ControladorHistorial {
    public function index() {
        $dao = new ConsultaDAO();
        $consultas = $dao->obtenerTodas();

        require_once __DIR__ . '/../vistas/historial.php';
    }
}
