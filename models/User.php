<?php

require_once "core/Database.php";
class User
{
    public static function getAll() {
        $db = Database::connect();
        $result = $db->query("SELECT * FROM users");

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}