<?php

require_once "models/User.php";

class HomeController
{
    public function index() {
        $users = User::getAll();
        require "views/home.php";
    }
}