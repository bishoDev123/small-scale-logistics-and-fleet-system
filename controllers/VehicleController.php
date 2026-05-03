<?php
require_once "models/Vehicle.php";

class VehicleController {
    public function index() {
        $vehicles = Vehicle::getAll();
        require "views/vehicles/index.php";
    }

    public function lock() {
        if (isset($_GET['id'])) {
            Vehicle::markUnavailable($_GET['id']);
        }
        // نرجع للصفحة الرئيسية للمركبات بعد التعديل
        header("Location: index.php?url=vehicle/index");
        exit;
    }
}