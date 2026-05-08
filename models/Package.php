<?php

require_once "core/Database.php";

class Package
{
    public static function create(
        $weight,
        $customerPriority,
        $perishableStatus,
        $promisedWindow,
        $customerId
    ) {

        $db = Database::connect();

        $priorityScore =
            self::calculatePriority(
                $customerPriority,
                $perishableStatus,
                $promisedWindow
            );

        $status = "Pending";

        $stmt = $db->prepare("
            INSERT INTO packages
            (
                weight,
                priority_score,
                status,
                customer_priority,
                perishable_status,
                promised_window
            )
            VALUES
            (?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
            "ddsiii",
            $weight,
            $priorityScore,
            $status,
            $customerPriority,
            $perishableStatus,
            $promisedWindow
        );

        return $stmt->execute();
    }

    public static function getAll()
    {
        $db = Database::connect();

        $result = $db->query("
            SELECT *
            FROM packages
            ORDER BY priority_score DESC
        ");

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function calculatePriority(
        $customerPriority,
        $perishableStatus,
        $promisedWindow
    ) {

        $score = 0;

        if ($perishableStatus == 1) {
            $score += 3;
        }

        $score += $customerPriority;

        if ($promisedWindow <= 24) {

            $score += 3;

        }
        elseif ($promisedWindow <= 48) {

            $score += 2;

        }
        else {

            $score += 1;

        }

        return $score;
    }

    public static function getPriorityLabel(
        $score
    ) {

        if ($score >= 8) {
            return "High";
        }

        if ($score >= 5) {
            return "Medium";
        }

        return "Low";
    }
    public static function calculateETA($package)
    {
        $eta = 30;

        $eta += ($package['weight'] * 2);
        $eta -= ($package['priority_score'] * 3);

        if ($eta < 15) {
            $eta = 15;
        }

        return round($eta);
    }

    public static function formatETA($minutes)
    {
        if ($minutes < 60) {
            return $minutes . " mins";
        }

        $hours = floor($minutes / 60);
        $mins = $minutes % 60;

        return $hours . "h " . $mins . "m";
    }
}