<?php
require_once __DIR__ . '/../modelos/TiempoAPI.php';
require_once __DIR__ . '/../modelos/ConsultaDAO.php';

class ControladorHoras {
    public function index() {
        $lat    = $_GET['lat']    ?? '';
        $lon    = $_GET['lon']    ?? '';
        $nombre = $_GET['nombre'] ?? '';
        $pais   = $_GET['pais']   ?? '';

        if (!$lat || !$lon) { header('Location: index.php'); exit; }

        $api  = new TiempoAPI();
        $data = $api->previsionHoras($lat, $lon);

        if ($data) {
            $dao = new ConsultaDAO();
            $dao->guardar($nombre, $pais, $lat, $lon, 'horas');
        }

        $volver = "lat=$lat&lon=$lon&nombre=" . urlencode($nombre) . "&pais=" . urlencode($pais);
        $horas  = $data['list'] ?? [];
        $labels = array_map(fn($i) => date('H:i', $i['dt']), $horas);
        $temps  = array_map(fn($i) => round($i['main']['temp'], 1), $horas);

        require_once __DIR__ . '/../vistas/horas.php';
    }
}
