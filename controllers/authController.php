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
}