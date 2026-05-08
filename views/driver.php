<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <title>
        Driver Dashboard
    </title>

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

            max-width: 700px;

            margin: auto;
        }

        h1 {
            margin-bottom: 25px;
        }

        .vehicle {

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

    </style>

</head>

<body>

<div class="card">

    <h1>
        Available Vehicles
    </h1>

    <?php if (count($vehicles) === 0): ?>

        <p>
            No vehicles available for your license class.
        </p>

    <?php endif; ?>

    <?php foreach ($vehicles as $vehicle): ?>

        <div class="vehicle">

            <h2>
                Vehicle #<?= $vehicle['id'] ?>
            </h2>

            <p>
                Capacity:
                <?= $vehicle['capacity'] ?> kg
            </p>

            <p>
                Type:
                <?= $vehicle['type'] ?>
            </p>

            <form
                    method="POST"
                    action="index.php?url=driver/assignVehicle"
            >

                <input
                        type="hidden"
                        name="vehicle_id"
                        value="<?= $vehicle['id'] ?>"
                >

                <button type="submit">
                    Assign Vehicle
                </button>

            </form>

        </div>

    <?php endforeach; ?>

</div>

</body>
</html>