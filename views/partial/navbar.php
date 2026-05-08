<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isAuthenticated = isset($_SESSION['user']);
?>

<head>
    <link rel="stylesheet" href="http://localhost/SmallScaleLogisticsFleetManager/index.php?url=public/styles.css">
</head>

<header>

    <div class="logo">
        Fleeter
    </div>

    <div class="nav-buttons">

        <?php if (!$isAuthenticated): ?>

            <a href="index.php?url=auth/login" class="btn btn-login">
                Login
            </a>

        <?php else: ?>

            <a href="index.php?url=auth/logout" class="btn btn-logout">
                Logout
            </a>

        <?php endif; ?>

    </div>

</header>