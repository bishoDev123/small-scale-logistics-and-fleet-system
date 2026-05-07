<?php

require_once "models/User.php";

class HomeController
{
    public function index()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            die("Access denied");
        }

        $users = User::getAll();

        require "views/home.php";
    }
}