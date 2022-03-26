<?php

class Database
{
    protected function getBdd()
    {
        try {
            return new PDO('mysql:host=localhost;dbname=dysit;charset=utf8', 'root', '');
        } catch (Exception $e) {
            return die("Erreur: " . $e->getMessage());
        }
    }
}
