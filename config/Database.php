<?php
class Database {
    private static $host = 'localhost';
    private static $dbname = 'association_tanger';
    private static $user = 'root';
    private static $password = '';

    public static function connect() {
        return new PDO(
            'mysql:host=' . self::$host . ';dbname=' . self::$dbname . ';charset=utf8mb4',
            self::$user,
            self::$password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }
}
