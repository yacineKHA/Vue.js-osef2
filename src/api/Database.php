<?php

class Database
{
    private static $pdo = null;

    public static function getBdd()
    {
        if (is_null(self::$pdo)){
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=dysit;charset=utf8', 'root', '');
            } catch (Exception $e) {
                die("Erreur: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
