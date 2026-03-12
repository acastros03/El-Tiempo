<?php
class TiempoAPI {
    private $key = 'AQUI_TU_API_KEY';

    public function buscarCiudad($nombre) {
        $url = "http://api.openweathermap.org/geo/1.0/direct?q=" . urlencode($nombre) . "&limit=5&appid={$this->key}";
        $resultados = $this->get($url);
        if (!$resultados) return [];

        $vistos = [];
        $filtrados = [];
        foreach ($resultados as $c) {
            $clave = round($c['lat'], 2) . ',' . round($c['lon'], 2);
            if (!in_array($clave, $vistos)) {
                $vistos[] = $clave;
                $filtrados[] = $c;
            }
        }
        return $filtrados;
    }

    public function tiempoActual($lat, $lon) {
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid={$this->key}&units=metric&lang=es";
        return $this->get($url);
    }

    public function previsionHoras($lat, $lon) {
        $url = "https://api.openweathermap.org/data/2.5/forecast?lat=$lat&lon=$lon&appid={$this->key}&units=metric&lang=es&cnt=8";
        return $this->get($url);
    }

    public function previsionSemanal($lat, $lon) {
        $url = "https://api.openweathermap.org/data/2.5/forecast?lat=$lat&lon=$lon&appid={$this->key}&units=metric&lang=es&cnt=40";
        $datos = $this->get($url);
        if (!$datos) return null;

        $porDia = [];
        foreach ($datos['list'] as $item) {
            $dia = date('Y-m-d', $item['dt']);
            $porDia[$dia]['temps'][] = $item['main']['temp'];
            $porDia[$dia]['icon']    = $item['weather'][0]['icon'];
            $porDia[$dia]['desc']    = $item['weather'][0]['description'];
        }

        $dias = [];
        foreach ($porDia as $fecha => $info) {
            $dias[] = [
                'fecha'    => $fecha,
                'temp_max' => round(max($info['temps']), 1),
                'temp_min' => round(min($info['temps']), 1),
                'icon'     => $info['icon'],
                'desc'     => ucfirst($info['desc']),
            ];
        }
        return $dias;
    }

    private function get($url) {
        $resp = @file_get_contents($url);
        if (!$resp) return null;
        $data = json_decode($resp, true);
        return (isset($data['cod']) && $data['cod'] == 404) ? null : $data;
    }
}
