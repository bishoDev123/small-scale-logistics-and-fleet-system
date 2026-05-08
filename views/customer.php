<?php

require_once "models/Package.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Fleeter Customer Portal
    </title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {

            min-height: 100vh;

            background-image:
                    linear-gradient(
                            rgba(0,0,0,0.75),
                            rgba(0,0,0,0.75)
                    ),
                    url('https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?q=80&w=1920&auto=format&fit=crop');

            background-size: cover;
            background-position: center;
            background-attachment: fixed;

            color: white;

            padding: 40px;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: auto;
        }

        .hero {
            text-align: center;
            margin-bottom: 50px;
        }

        .hero h1 {
            font-size: 58px;
            margin-bottom: 15px;
        }

        .hero p {
            color: rgba(255,255,255,0.8);
            font-size: 18px;
        }

        .content-grid {

            display: grid;

            grid-template-columns:
                1fr
                1fr;

            gap: 30px;
        }

        .glass-card {

            background: rgba(255,255,255,0.08);

            backdrop-filter: blur(14px);

            border: 1px solid rgba(255,255,255,0.12);

            border-radius: 20px;

            padding: 30px;
        }

        h2 {
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: rgba(255,255,255,0.85);
        }

        input,
        select {

            width: 100%;

            padding: 14px;

            border-radius: 10px;

            border: 1px solid rgba(255,255,255,0.15);

            background: rgba(255,255,255,0.08);

            color: white;

            outline: none;
        }

        option {
            color: black;
        }

        input::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .checkbox-group {

            display: flex;
            align-items: center;
            gap: 10px;

            margin-top: 15px;
            margin-bottom: 20px;
        }

        .checkbox-group input {
            width: auto;
        }

        button {

            width: 100%;

            padding: 15px;

            border: none;

            border-radius: 10px;

            background: #2563eb;

            color: white;

            font-size: 16px;
            font-weight: bold;

            cursor: pointer;

            transition: 0.25s;
        }

        button:hover {
            background: #1d4ed8;
        }

        .package-list {

            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .package-card {

            background: rgba(255,255,255,0.08);

            border-radius: 14px;

            padding: 20px;

            border-left: 5px solid #2563eb;
        }

        .package-card h3 {
            margin-bottom: 12px;
        }

        .priority {

            display: inline-block;

            margin-top: 12px;

            padding: 6px 12px;

            border-radius: 999px;

            font-size: 14px;
            font-weight: bold;
        }

        .high {
            background: #dc2626;
        }

        .medium {
            background: #d97706;
        }

        .low {
            background: #16a34a;
        }

        @media (max-width: 900px) {

            .content-grid {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 42px;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <div class="hero">

        <h1>
            Fleeter Customer Portal
        </h1>

        <p>
            Request package deliveries and let
            Fleeter intelligently prioritize
            your logistics operations.
        </p>

    </div>

    <div class="content-grid">

        <div class="glass-card">

            <h2>
                Request Delivery
            </h2>

            <form
                method="POST"
                action="index.php?url=customer/requestPackage"
            >

                <div class="form-group">

                    <label>
                        Package Weight (kg)
                    </label>

                    <input
                        type="number"
                        step="0.1"
                        name="weight"
                        required
                    >

                </div>

                <div class="form-group">

                    <label>
                        Customer Priority
                    </label>

                    <select name="customer_priority">

                        <option value="1">
                            Normal
                        </option>

                        <option value="2">
                            Important
                        </option>

                        <option value="3">
                            VIP
                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label>
                        Promised Delivery Window
                    </label>

                    <select name="promised_window">

                        <option value="72">
                            72 Hours
                        </option>

                        <option value="48">
                            48 Hours
                        </option>

                        <option value="24">
                            24 Hours
                        </option>

                    </select>

                </div>

                <div class="checkbox-group">

                    <input
                        type="checkbox"
                        name="perishable"
                    >

                    <label>
                        Perishable Package
                    </label>

                </div>

                <button type="submit">
                    Request Delivery
                </button>

            </form>

        </div>

        <div class="glass-card">

            <h2>
                Package Priority Queue
            </h2>

            <div class="package-list">

                <?php foreach ($packages as $package): ?>

                    <?php

                    $priorityLabel =
                        Package::getPriorityLabel(
                            $package['priority_score']
                        );

                    ?>

                    <div class="package-card">

                        <h3>
                            Package #<?= $package['id'] ?>
                        </h3>

                        <p>
                            <strong>Weight:</strong>
                            <?= htmlspecialchars($package['weight']) ?> kg
                        </p>

                        <p>
                            <strong>Priority Score:</strong>
                            <?= htmlspecialchars($package['priority_score']) ?>
                        </p>

                        <p>
                            <strong>Status:</strong>
                            <?= htmlspecialchars($package['status']) ?>
                        </p>

                        <p>
                            <strong>Delivery Window:</strong>
                            <?= htmlspecialchars($package['promised_window']) ?>
                            Hours
                        </p>

                        <span
                            class="
                                priority
                                <?= strtolower($priorityLabel) ?>
                            "
                        >

                            <?= $priorityLabel ?>
                            Priority

                        </span>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>

</body>
</html>