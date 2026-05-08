<?php

require_once "models/Driver.php";
require_once "models/Package.php";

class DriverController
{
    public function index()
    {

        $user = $_SESSION['user'];

        $driver = Driver::getDriverByUserId($user['id']);

        $vehicles = Driver::getAvailableVehiclesByLicense($driver['license']);

        $deliveries = Driver::getAssignedDeliveries($user['id']);

        require "views/driver.php";
    }

    public function assignVehicle()
    {

        $user = $_SESSION['user'];

        $vehicleId = $_POST['vehicle_id'];

        Driver::assignVehicle($user['id'], $vehicleId);

        header("Location: index.php?url=driver/index");
        exit;
    }
}