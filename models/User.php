<?php

require_once "core/Database.php";

class User
{
    public static function getAll()
    {
        $db = Database::connect();

        $result = $db->query("
            SELECT
                users.*,
                roles.name AS role_name
            FROM users
            JOIN roles
            ON users.role_id = roles.id
        ");

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function login($email, $password)
    {
        $db = Database::connect();

        $stmt = $db->prepare("
            SELECT
                users.*,
                roles.name AS role_name
            FROM users
            JOIN roles
            ON users.role_id = roles.id
            WHERE email = ?
            AND password = ?
        ");

        $stmt->bind_param(
            "ss",
            $email,
            $password
        );

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
    public static function register($name, $email, $password, $role_id, $employeeCode)
    {
        global $db; // افترض أن هذا هو متغير الاتصال بقاعدة البيانات الخاص بك
        
        try {
            $stmt = $db->prepare("INSERT INTO users (name, email, password, role_id, employee_code) VALUES (?, ?, ?, ?, ?)");
            return $stmt->execute([$name, $email, $password, $role_id, $employeeCode]);
        } catch (PDOException $e) {
            return false;
        }
    }
}