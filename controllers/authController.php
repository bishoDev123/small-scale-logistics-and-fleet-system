<?php

require_once "models/User.php";

class authController
{
    public function index() {
        require "views/login.php";
    }
}