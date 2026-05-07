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

            session_start();

            $email = $_POST['email'];
            $password = $_POST['password'];

            $isStaff = isset($_POST['is_staff']);

            $employeeCode =
                $_POST['employee_code'] ?? '';

            $user = User::login(
                $email,
                $password
            );

            if ($user) {

                $_SESSION['user'] = $user;

                if ($isStaff) {

                    if (
                        $employeeCode ===
                        $user['employee_code']
                    ) {

                        if (
                            $user['role_name']
                            === 'Driver'
                        ) {

                            header(
                                "Location: index.php?url=driver/index"
                            );

                            exit;
                        }

                        if (
                            $user['role_name']
                            === 'Dispatcher'
                        ) {

                            header(
                                "Location: index.php?url=dispatcher/index"
                            );

                            exit;
                        }
                    }

                    echo "Invalid employee code";
                    return;
                }

                header(
                    "Location: index.php?url=home/index"
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
        session_start();

        session_destroy();

        header(
            "Location: index.php?url=auth/login"
        );

        exit;
    }
}