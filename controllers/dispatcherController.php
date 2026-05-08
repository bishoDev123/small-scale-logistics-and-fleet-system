<?php

require_once "models/Driver.php";
require_once "models/Package.php";

class DispatcherController
{
    public function index()
    {

        $packages =
            Package::getAll();

        require "views/dispatcher.php";
    }

    public function checkLoad()
    {

        $packageId =
            $_GET['package_id'];

        $drivers =
            Driver::getAvailableDriversForPackage(
                $packageId
            );

        if ($drivers === false) {

            http_response_code(404);

            echo "404 Package Not Found";

            return;
        }

        require "views/check_load.php";
    }
}