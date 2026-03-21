<?php
class Database {
    private static $db = null;

    public static function getConexion() {
        if (self::$db === null) {
            $host = getenv('DB_HOST') ?: 'db';
            try {
                self::$db = new PDO("mysql:host=$host;dbname=el_tiempo;charset=utf8", "root", "root");
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error BD: " . $e->getMessage());
            }
        }
        return self::$db;
    }
}
