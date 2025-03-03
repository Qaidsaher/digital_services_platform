<?php
namespace App\Database;

use PDO;

class DB {
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            // Adjust your DSN, username, and password as needed.
            $dsn = "mysql:host=localhost;dbname=techdb;charset=utf8mb4";
            $user = "root";
            $password = "";
            self::$connection = new PDO($dsn, $user, $password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }
}
