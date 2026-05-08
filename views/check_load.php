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

    <div class="driver-card">

        <p>
            <strong>Name:</strong>
            <?= $driver['name'] ?>
        </p>

        <p>
            <strong>Vehicle Capacity:</strong>
            <?= $driver['capacity'] ?> kg
        </p>

        <form method="POST" action="index.php?url=dispatcher/assignDriver">

            <input type="hidden" name="driver_id" value="<?= $driver['user_id'] ?>">
            <input type="hidden" name="package_id" value="<?= $_GET['package_id'] ?>">

            <button type="submit">
                Assign Driver
            </button>

        </form>

    </div>

<?php endforeach; ?>

</body>
</html>