<?php
require_once "core/Database.php";

class Part {
   
    public static function getAll() {
        $db = Database::connect();
        $result = $db->query("SELECT * FROM parts");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

  
    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM parts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

  
    public static function create($name, $max_life, $current_usage) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO parts (name, max_life, current_usage) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $name, $max_life, $current_usage);
        return $stmt->execute();
    }


    public static function update($id, $name, $max_life, $current_usage) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE parts SET name = ?, max_life = ?, current_usage = ? WHERE id = ?");
        $stmt->bind_param("siii", $name, $max_life, $current_usage, $id);
        return $stmt->execute();
    }

 
    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM parts WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}