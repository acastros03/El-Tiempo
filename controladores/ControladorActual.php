<?php
require_once __DIR__ . '/../modelos/TiempoAPI.php';
require_once __DIR__ . '/../modelos/ConsultaDAO.php';

class ControladorActual {
    public function index() {
        $lat    = $_GET['lat']    ?? '';
        $lon    = $_GET['lon']    ?? '';
        $nombre = $_GET['nombre'] ?? '';
        $pais   = $_GET['pais']   ?? '';

        if (!$lat || !$lon) { header('Location: index.php'); exit; }

        $api = new TiempoAPI();
        $t = $api->tiempoActual($lat, $lon);

        if ($t) {
            $dao = new ConsultaDAO();
            $dao->guardar($nombre, $pais, $lat, $lon, 'actual');
        }

        $volver = "lat=$lat&lon=$lon&nombre=" . urlencode($nombre) . "&pais=" . urlencode($pais);
        require_once __DIR__ . '/../vistas/actual.php';
    }
}
