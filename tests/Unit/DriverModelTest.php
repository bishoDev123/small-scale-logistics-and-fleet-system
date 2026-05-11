<?php

use PHPUnit\Framework\TestCase;

require_once "./models/Driver.php";
require_once "./core/Database.php";

class DriverModelTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | GET DRIVER BY USER ID
    |--------------------------------------------------------------------------
    */

    public function test_get_driver_by_user_id_returns_driver()
    {
        $driver = Driver::getDriverByUserId(2);

        $this->assertIsArray($driver);
        $this->assertEquals(2, $driver['user_id']);
    }

    public function test_get_driver_by_user_id_returns_null_for_invalid_id()
    {
        $driver = Driver::getDriverByUserId(999999);

        $this->assertNull($driver);
    }

    /*
    |--------------------------------------------------------------------------
    | GET AVAILABLE VEHICLES BY LICENSE
    |--------------------------------------------------------------------------
    */

    public function test_get_available_vehicles_for_b_license()
    {
        $vehicles = Driver::getAvailableVehiclesByLicense('B');

        $this->assertIsArray($vehicles);

        foreach ($vehicles as $vehicle) {
            $this->assertEquals(1, $vehicle['type']);
            $this->assertEquals('Available', $vehicle['status']);
        }
    }

    public function test_get_available_vehicles_for_c_license()
    {
        $vehicles = Driver::getAvailableVehiclesByLicense('C');

        foreach ($vehicles as $vehicle) {
            $this->assertEquals(2, $vehicle['type']);
        }
    }

    public function test_get_available_vehicles_for_d_license()
    {
        $vehicles = Driver::getAvailableVehiclesByLicense('D');

        foreach ($vehicles as $vehicle) {
            $this->assertEquals(3, $vehicle['type']);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ASSIGN VEHICLE
    |--------------------------------------------------------------------------
    */

    public function test_assign_vehicle_returns_true()
    {
        $success = Driver::assignVehicle(1, 1);

        $this->assertTrue($success);
    }

    /*
    |--------------------------------------------------------------------------
    | GET AVAILABLE DRIVERS FOR PACKAGE
    |--------------------------------------------------------------------------
    */

    public function test_get_available_drivers_for_package()
    {
        $drivers = Driver::getAvailableDriversForPackage(1);

        $this->assertIsArray($drivers);

        foreach ($drivers as $driver) {
            $this->assertArrayHasKey('user_id', $driver);
            $this->assertArrayHasKey('vehicle_id', $driver);
            $this->assertArrayHasKey('capacity', $driver);
        }
    }

    public function test_get_available_drivers_for_invalid_package()
    {
        $drivers = Driver::getAvailableDriversForPackage(999999);

        $this->assertFalse($drivers);
    }

    /*
    |--------------------------------------------------------------------------
    | GET ASSIGNED DELIVERIES
    |--------------------------------------------------------------------------
    */

    public function test_get_assigned_deliveries()
    {
        $deliveries = Driver::getAssignedDeliveries(1);

        $this->assertIsArray($deliveries);

        foreach ($deliveries as $delivery) {
            $this->assertArrayHasKey('target_address', $delivery);
            $this->assertArrayHasKey('delivery_status', $delivery);
        }
    }
}