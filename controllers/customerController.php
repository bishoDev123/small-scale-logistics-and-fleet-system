<?php

require_once "models/Package.php";

class CustomerController
{
    public function index()
    {

        $packages =
            Package::getAll();

        require "views/customer.php";
    }

    public function requestPackage()
    {

        if (
            $_SERVER['REQUEST_METHOD']
            === 'POST'
        ) {

            $weight =
                $_POST['weight'];

            $customerPriority =
                $_POST['customer_priority'];

            $perishableStatus =
                isset($_POST['perishable'])
                    ? 1
                    : 0;

            $promisedWindow =
                $_POST['promised_window'];

            if ($weight <= 0) {

                echo "Invalid package request";

                return;
            }

            Package::create(
                $weight,
                $customerPriority,
                $perishableStatus,
                $promisedWindow,
                1
            );

            header(
                "Location: index.php?url=customer/index"
            );

            exit;
        }
    }
}