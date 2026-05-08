<?php

require_once "models/User.php";

class HomeController
{
    public function index()
    {
        session_start();


        $users = User::getAll();

        require "views/home.php";
    }
}