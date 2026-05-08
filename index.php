<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$url = isset($_GET["url"]) ? $_GET["url"] : 'home/index';
$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';
$method = isset($url[1]) ? $url[1] : 'index';

require_once "controllers/$controllerName.php";

$controller = new $controllerName();
$controller->$method();