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
    public function assignDriver()
    {

        $packageId = $_POST['package_id'];
        $driverId  = $_POST['driver_id'];

        require_once "models/Package.php";
        require_once "models/Driver.php";

        $db = Database::connect();

        /*
        |---------------------------------------------------------
        | STEP 1: GET PACKAGE
        |---------------------------------------------------------
        */

        $stmt = $db->prepare("
        SELECT *
        FROM packages
        WHERE id = ?
    ");

        $stmt->bind_param("i", $packageId);
        $stmt->execute();
        $package = $stmt->get_result()->fetch_assoc();

        if (!$package) {
            http_response_code(404);
            echo "Package not found";
            return;
        }

        /*
        |---------------------------------------------------------
        | STEP 2: CREATE DELIVERY
        |---------------------------------------------------------
        */

        $customerId = 1; // fallback or extend later if needed

        $stmt2 = $db->prepare("
        INSERT INTO deliveries (driver_id, customer_id, status)
        VALUES (?, ?, 'Assigned')
    ");

        $stmt2->bind_param("ii", $driverId, $customerId);
        $stmt2->execute();

        $deliveryId = $db->insert_id;

        /*
        |---------------------------------------------------------
        | STEP 3: LINK PACKAGE → DELIVERY
        |---------------------------------------------------------
        */

        $stmt3 = $db->prepare("
        UPDATE packages
        SET delivery_id = ?, status = 'Assigned'
        WHERE id = ?
    ");

        $stmt3->bind_param("ii", $deliveryId, $packageId);
        $stmt3->execute();

        /*
        |---------------------------------------------------------
        | STEP 4: ASSIGN TO DRIVER TABLE
        |---------------------------------------------------------
        */

        $stmt4 = $db->prepare("
        UPDATE drivers
        SET assigned_delivery = ?
        WHERE user_id = ?
    ");

        $stmt4->bind_param("ii", $deliveryId, $driverId);
        $stmt4->execute();

        /*
        |---------------------------------------------------------
        | STEP 5: REDIRECT BACK
        |---------------------------------------------------------
        */

        header("Location: index.php?url=dispatcher/index");
        exit;
    }
}