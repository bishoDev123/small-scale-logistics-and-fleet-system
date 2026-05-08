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

        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public static function register($name, $email, $password, $role_id, $employeeCode)
    {
        $db = Database::connect();

        try {
            $stmt = $db->prepare("
            INSERT INTO users (name, email, password, role_id, employee_code)
            VALUES (?, ?, ?, ?, ?)
        ");

            $stmt->bind_param(
                "sssis",
                $name,
                $email,
                $password,
                $role_id,
                $employeeCode
            );

            return $stmt->execute();
        }
        catch (mysqli_sql_exception $e) {

            // Duplicate email (MySQL error code 1062)
            if ($e->getCode() === 1062) {
                return "EMAIL_EXISTS";
            }

            return false;
        }
    }
}