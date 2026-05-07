<?php

class DriverController
{
    public function index()
    {
        session_start();

        if (
            !isset($_SESSION['user']) ||
            $_SESSION['user']['role_name']
            !== 'Driver'
        ) {
            die("Access denied");
        }

        require "views/driver.php";
    }
}