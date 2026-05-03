<?php
require_once "core/Database.php";

class Vehicle {
    public static function getAll() {
        $db = Database::connect();
        $result = $db->query("SELECT * FROM vehicles");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public static function markUnavailable($id) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE vehicles SET status = 'Out-of-Service' WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}