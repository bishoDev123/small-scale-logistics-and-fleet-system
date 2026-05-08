<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <title>Driver Dashboard</title>

    <style>

        body {
            background: #111827;
            color: white;
            font-family: Arial;
            padding: 40px;
        }

        .card {
            background: #1f2937;
            padding: 30px;
            border-radius: 16px;
            max-width: 900px;
            margin: auto;
            margin-bottom: 30px;
        }

        h1 {
            margin-bottom: 25px;
        }

        .vehicle, .delivery {
            background: #374151;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            cursor: pointer;
        }

        .section-title {
            margin-bottom: 15px;
            font-size: 20px;
            color: #93c5fd;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            background: #10b981;
            font-size: 12px;
            margin-top: 10px;
        }

    </style>

</head>

<body>

<div class="card">

    <h1>
        Driver Dashboard
    </h1>

    <!-- VEHICLES SECTION -->
    <div class="section-title">
        Available Vehicles
    </div>

    <?php if (empty($vehicles)): ?>

        <p>No vehicles available for your license class.</p>

    <?php endif; ?>

    <?php foreach ($vehicles as $vehicle): ?>

        <div class="vehicle">

            <h2>Vehicle #<?= $vehicle['id'] ?></h2>

            <p>Capacity: <?= $vehicle['capacity'] ?> kg</p>

            <p>Type: <?= $vehicle['type'] ?></p>

            <form method="POST" action="index.php?url=driver/assignVehicle">

                <input type="hidden" name="vehicle_id" value="<?= $vehicle['id'] ?>">

                <button type="submit">
                    Assign Vehicle
                </button>

            </form>

        </div>

    <?php endforeach; ?>

</div>

<!-- DELIVERIES SECTION -->
<div class="card">

    <div class="section-title">
        Assigned Deliveries
    </div>

    <?php if (empty($deliveries)): ?>

        <p>No deliveries assigned yet.</p>

    <?php endif; ?>

    <?php foreach ($deliveries as $delivery): ?>

        <div class="delivery">

            <h2>Package #<?= $delivery['id'] ?></h2>

            <p>
                <strong>Weight:</strong>
                <?= $delivery['weight'] ?> kg
            </p>

            <p>
                <strong>Priority Score:</strong>
                <?= $delivery['priority_score'] ?>
            </p>

            <p>
                <strong>Status:</strong>
                <?= $delivery['status'] ?>
            </p>

            <p>
                <strong>Destination:</strong>
                <?= $delivery['target_address'] ?>
            </p>

            <span class="status">
                <?= $delivery['delivery_status'] ?>
            </span>

        </div>

    <?php endforeach; ?>

</div>

</body>
</html>