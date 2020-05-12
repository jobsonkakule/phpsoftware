<?php
namespace App;

use PDO;

class Connection {

    private static $pdo;

    public static function getPDO (): PDO {
        if (self::$pdo === null) {
            self::$pdo = new PDO('mysql:dbname=phpsoftware;host=127.0.0.1', 'root', 'root', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$pdo;
    }
}