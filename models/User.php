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
}