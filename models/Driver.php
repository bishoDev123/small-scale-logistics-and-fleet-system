<?php

require_once "core/Database.php";

class Driver
{
    public static function getDriverByUserId(
        $userId
    ) {

        $db = Database::connect();

        $stmt = $db->prepare("
            SELECT *
            FROM drivers
            WHERE user_id = ?
        ");

        $stmt->bind_param(
            "i",
            $userId
        );

        $stmt->execute();

        return $stmt
            ->get_result()
            ->fetch_assoc();
    }

    public static function getAvailableVehiclesByLicense(
        $license
    ) {

        $db = Database::connect();

        /*
        |--------------------------------------------------------------------------
        | SIMPLE LICENSE MAPPING
        |--------------------------------------------------------------------------
        |
        | B -> type 1
        | C -> type 2
        | D -> type 3
        |
        */

        $vehicleType = 1;

        if ($license === 'C') {
            $vehicleType = 2;
        }

        if ($license === 'D') {
            $vehicleType = 3;
        }

        $stmt = $db->prepare("
            SELECT *
            FROM vehicles
            WHERE type = ?
            AND status = 'Available'
        ");

        $stmt->bind_param(
            "i",
            $vehicleType
        );

        $stmt->execute();

        return $stmt
            ->get_result()
            ->fetch_all(MYSQLI_ASSOC);
    }

    public static function assignVehicle(
        $driverId,
        $vehicleId
    ) {

        $db = Database::connect();

        /*
        |--------------------------------------------------------------------------
        | ASSIGN VEHICLE TO DRIVER
        |--------------------------------------------------------------------------
        */

        $stmt = $db->prepare("
            UPDATE drivers
            SET
                assigned_vehicle = ?,
                ready_status = 1
            WHERE user_id = ?
        ");

        $stmt->bind_param(
            "ii",
            $vehicleId,
            $driverId
        );

        $success = $stmt->execute();

        /*
        |--------------------------------------------------------------------------
        | MARK VEHICLE BUSY
        |--------------------------------------------------------------------------
        */

        $stmt2 = $db->prepare("
            UPDATE vehicles
            SET status = 'Assigned'
            WHERE id = ?
        ");

        $stmt2->bind_param(
            "i",
            $vehicleId
        );

        $stmt2->execute();

        return $success;
    }

    public static function getAvailableDriversForPackage(
        $packageId
    ) {

        $db = Database::connect();

        /*
        |--------------------------------------------------------------------------
        | GET PACKAGE
        |--------------------------------------------------------------------------
        */

        $stmt = $db->prepare("
            SELECT *
            FROM packages
            WHERE id = ?
        ");

        $stmt->bind_param(
            "i",
            $packageId
        );

        $stmt->execute();

        $package =
            $stmt
                ->get_result()
                ->fetch_assoc();

        if (!$package) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | FIND READY DRIVERS WITH ENOUGH CAPACITY
        |--------------------------------------------------------------------------
        */

        $stmt2 = $db->prepare("
            SELECT
                users.name,
                users.email,
                drivers.user_id,
                drivers.license,
                vehicles.id AS vehicle_id,
                vehicles.capacity,
                vehicles.type
            FROM drivers

            JOIN users
            ON users.id = drivers.user_id

            JOIN vehicles
            ON vehicles.id = drivers.assigned_vehicle

            WHERE
                drivers.ready_status = 1
            AND
                vehicles.capacity >= ?
        ");

        $stmt2->bind_param(
            "d",
            $package['weight']
        );

        $stmt2->execute();

        return $stmt2
            ->get_result()
            ->fetch_all(MYSQLI_ASSOC);
    }
}