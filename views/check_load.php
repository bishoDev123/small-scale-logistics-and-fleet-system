<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <title>
        Available Drivers
    </title>

    <style>

        body {

            background: #111827;
            color: white;

            font-family: Arial;

            padding: 40px;
        }

        .driver {

            background: #1f2937;

            padding: 25px;

            border-radius: 14px;

            margin-bottom: 20px;
        }

    </style>

</head>

<body>

<h1>
    Available Drivers
</h1>

<?php if (count($drivers) === 0): ?>

    <p>
        No drivers available for this package.
    </p>

<?php endif; ?>

<?php foreach ($drivers as $driver): ?>

    <div class="driver">

        <h2>
            <?= htmlspecialchars($driver['name']) ?>
        </h2>

        <p>
            Email:
            <?= htmlspecialchars($driver['email']) ?>
        </p>

        <p>
            Vehicle ID:
            <?= $driver['vehicle_id'] ?>
        </p>

        <p>
            Vehicle Capacity:
            <?= $driver['capacity'] ?> kg
        </p>

        <p>
            License:
            <?= htmlspecialchars($driver['license']) ?>
        </p>

    </div>

<?php endforeach; ?>

</body>
</html>