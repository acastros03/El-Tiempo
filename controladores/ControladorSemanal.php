<?php
require_once __DIR__ . '/../modelos/TiempoAPI.php';
require_once __DIR__ . '/../modelos/ConsultaDAO.php';

class ControladorSemanal {
    public function index() {
        $lat    = $_GET['lat']    ?? '';
        $lon    = $_GET['lon']    ?? '';
        $nombre = $_GET['nombre'] ?? '';
        $pais   = $_GET['pais']   ?? '';

        if (!$lat || !$lon) { header('Location: index.php'); exit; }

        $api  = new TiempoAPI();
        $dias = $api->previsionSemanal($lat, $lon);

        if ($dias) {
            $dao = new ConsultaDAO();
            $dao->guardar($nombre, $pais, $lat, $lon, 'semanal');
        }

        $volver   = "lat=$lat&lon=$lon&nombre=" . urlencode($nombre) . "&pais=" . urlencode($pais);
        $labels   = array_map(fn($d) => date('D d/m', strtotime($d['fecha'])), $dias ?? []);
        $maxTemps = array_map(fn($d) => $d['temp_max'], $dias ?? []);
        $minTemps = array_map(fn($d) => $d['temp_min'], $dias ?? []);

        require_once __DIR__ . '/../vistas/semanal.php';
    }
}
