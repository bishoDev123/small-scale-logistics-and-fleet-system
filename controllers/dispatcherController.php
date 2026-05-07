<?php

class DispatcherController
{
    public function index()
    {
        session_start();

        if (
            !isset($_SESSION['user']) ||
            $_SESSION['user']['role_name']
            !== 'Dispatcher'
        ) {
            die("Access denied");
        }

        require "views/dispatcher.php";
    }
}