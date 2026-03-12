<?php
class ControladorCiudad {
    public function index() {
        $lat    = $_GET['lat']    ?? '';
        $lon    = $_GET['lon']    ?? '';
        $nombre = $_GET['nombre'] ?? '';
        $pais   = $_GET['pais']   ?? '';

        if (!$lat || !$lon) { header('Location: index.php'); exit; }

        require_once __DIR__ . '/../vistas/ciudad.php';
    }
}
