<?php
require_once __DIR__ . '/Database.php';

class ConsultaDAO {
    private $db;

    public function __construct() {
        $this->db = Database::getConexion();
    }

    public function guardar($ciudad, $pais, $lat, $lon, $tipo) {
        $stmt = $this->db->prepare("SELECT id FROM ciudades WHERE ABS(lat-?) < 0.01 AND ABS(lon-?) < 0.01");
        $stmt->execute([$lat, $lon]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $cidId = $row['id'];
        } else {
            $stmt = $this->db->prepare("INSERT INTO ciudades (nombre, pais, lat, lon) VALUES (?,?,?,?)");
            $stmt->execute([$ciudad, $pais, $lat, $lon]);
            $cidId = $this->db->lastInsertId();
        }
        $stmt = $this->db->prepare("INSERT INTO consultas (ciudad_id, tipo) VALUES (?,?)");
        $stmt->execute([$cidId, $tipo]);
    }

    public function obtenerTodas() {
        return $this->db->query(
            "SELECT c2.nombre, c2.pais, c.tipo, c.fecha
             FROM consultas c JOIN ciudades c2 ON c.ciudad_id = c2.id
             ORDER BY c.fecha DESC LIMIT 100"
        )->fetchAll(PDO::FETCH_ASSOC);
    }
}
