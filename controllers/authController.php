<?php

require_once "models/User.php";

class AuthController
{
    public function index()
    {
        $this->login();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email =
                $_POST['email'];

            $password =
                $_POST['password'];

            $isStaff =
                isset($_POST['is_staff']);

            $employeeCode =
                $_POST['employee_code'] ?? '';

            $user = User::login(
                $email,
                $password
            );

            if ($user) {

                $_SESSION['user'] = $user;

                /*
                |--------------------------------------------------------------------------
                | STAFF LOGIN
                |--------------------------------------------------------------------------
                */

                if ($isStaff) {

                    if (
                        $employeeCode !==
                        $user['employee_code']
                    ) {

                        echo "Invalid employee code";

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | DRIVER
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $user['role_name']
                        === 'Driver'
                    ) {

                        header(
                            "Location: index.php?url=driver/index"
                        );

                        exit;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | DISPATCHER
                    |--------------------------------------------------------------------------
                    */

                    if (
                        $user['role_name']
                        === 'Dispatcher'
                    ) {

                        header(
                            "Location: index.php?url=dispatcher/index"
                        );

                        exit;
                    }

                    echo "Unauthorized staff role";

                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | CUSTOMER LOGIN
                |--------------------------------------------------------------------------
                */

                header(
                    "Location: index.php?url=customer/index"
                );

                exit;
            }

            echo "Invalid credentials";

            return;
        }

        require "views/login.php";
    }
    public function logout()
    {
        $_SESSION = [];

        session_destroy();

        header("Location: index.php?url=home/index");
        exit;
 
 
 
 
       }

    public function register()
    {
        $db = Database::connect();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role_id = $_POST['role_id'];

            $employeeCode = null;

            if ($role_id == 2 || $role_id == 3) {
                $employeeCode = 'DRIVER123';
            }

            /*
            |--------------------------------------------------------------------------
            | 1. INSERT USER FIRST
            |--------------------------------------------------------------------------
            */

            $stmt = $db->prepare("
            INSERT INTO users (name, email, password, role_id, employee_code)
            VALUES (?, ?, ?, ?, ?)
        ");

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt->bind_param(
                "sssis",
                $name,
                $email,
                $hashedPassword,
                $role_id,
                $employeeCode
            );

            if (!$stmt->execute()) {
                echo "Registration failed. Email might already exist.";
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | 2. GET AUTO-INCREMENT USER ID
            |--------------------------------------------------------------------------
            */

            $userId = $db->insert_id;

            /*
            |--------------------------------------------------------------------------
            | 3. INSERT DRIVER IF ROLE IS DRIVER
            |--------------------------------------------------------------------------
            */

            if ($role_id == 3) {

                $stmt2 = $db->prepare("
                INSERT INTO drivers
                (
                    user_id,
                    license,
                    assigned_vehicle,
                    assigned_delivery,
                    performance_score,
                    ready_status
                )
                VALUES (?, 'B', NULL, NULL, 100, 0)
            ");

                $stmt2->bind_param("i", $userId);
                $stmt2->execute();
            }

            header("Location: index.php?url=auth/login");
            exit;
        }

        require "views/register.php";
    }}
