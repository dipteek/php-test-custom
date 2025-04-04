<?php
class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            $host = "postgres_db"; // Use "mysql" if using MySQL
            $dbname = "hellofresh";
            $username = "hellofresh";
            $password = "hellofresh";

            try {
                self::$connection = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
?>
