<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <title>
        Dispatcher Dashboard
    </title>

    <style>

        body {

            background: #0f172a;
            color: white;

            font-family: Arial;

            padding: 40px;
        }

        .package {

            background: #1e293b;

            padding: 25px;

            border-radius: 14px;

            margin-bottom: 20px;
        }

        a {

            display: inline-block;

            margin-top: 15px;

            padding: 10px 20px;

            background: #2563eb;

            color: white;

            text-decoration: none;

            border-radius: 8px;
        }

    </style>

</head>

<body>

<h1>
    Packages
</h1>

<?php foreach ($packages as $package): ?>

    <div class="package">

        <h2>
            Package #<?= $package['id'] ?>
        </h2>

        <p>
            Weight:
            <?= $package['weight'] ?> kg
        </p>

        <p>
            Priority:
            <?= $package['priority_score'] ?>
        </p>

        <a href="index.php?url=dispatcher/checkLoad&package_id=<?= $package['id'] ?>">
            Check Load
        </a>

    </div>

<?php endforeach; ?>

</body>
</html>