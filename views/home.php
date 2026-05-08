<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0"
    >

    <title>
        User Dashboard
    </title>

    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
    >

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        html,
        body {
            height: 100%;
        }

        body {
            color: white;
            display: flex;
            flex-direction: column;

            background-image:
                    linear-gradient(
                            rgba(0,0,0,0.65),
                            rgba(0,0,0,0.65)
                    ),
                    url('https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?q=80&w=1920&auto=format&fit=crop');

            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .content-wrapper {
            flex: 1 0 auto;
        }

        header {
            width: 100%;
            padding: 20px 8%;

            background: rgba(255,255,255,0.08);

            backdrop-filter: blur(10px);

            display: flex;
            justify-content: space-between;
            align-items: center;

            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo {
            font-size: 30px;
            font-weight: bold;
            color: white;
            letter-spacing: 1px;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.2s;
            font-weight: bold;
        }

        .btn-login {
            background: #2563eb;
            color: white;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }

        .btn-logout {
            background: #ef4444;
            color: white;
        }

        .btn-logout:hover {
            background: #dc2626;
        }

        .hero {
            width: 100%;
            min-height: calc(100vh - 140px);

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            text-align: center;
            padding: 80px 20px;
        }

        .hero h1 {
            font-size: 64px;
            margin-bottom: 20px;
            text-shadow: 0 4px 15px rgba(0,0,0,0.4);
        }

        .hero p {
            max-width: 800px;
            line-height: 1.8;
            font-size: 20px;
            color: rgba(255,255,255,0.9);
        }

        .hero-buttons {
            margin-top: 35px;

            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .hero-btn {
            padding: 14px 28px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.25s;
        }

        .primary-btn {
            background: #2563eb;
            color: white;
        }

        .primary-btn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        .secondary-btn {
            background: rgba(255,255,255,0.12);
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .secondary-btn:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }

        footer {
            flex-shrink: 0;

            padding: 25px;

            text-align: center;

            background: rgba(0,0,0,0.4);

            backdrop-filter: blur(8px);

            color: rgba(255,255,255,0.85);
        }

        @media (max-width: 768px) {

            .hero h1 {
                font-size: 42px;
            }

            .hero p {
                font-size: 18px;
            }

            header {
                padding: 18px 5%;
            }

        }

    </style>
</head>

<body>

<main class="content-wrapper">

    <header>

        <div class="logo">
            Fleeter
        </div>

        <div class="nav-buttons">

            <a
                    href="index.php?url=auth/login"
                    class="btn btn-login"
            >
                Login
            </a>

            <a
                    href="index.php?url=auth/logout"
                    class="btn btn-logout"
            >
                Logout
            </a>

        </div>

    </header>

    <section class="hero">

        <h1>
            Welcome to Fleeter
        </h1>

        <p>
            Manage packages, coordinate fleets,
            track shipments, and monitor logistics
            operations through one powerful platform
            designed for modern transportation businesses.
        </p>

        <div class="hero-buttons">

            <a
                    href="index.php?url=auth/login"
                    class="hero-btn primary-btn"
            >
                Get Started
            </a>

            <a
                    href="#"
                    class="hero-btn secondary-btn"
            >
                Learn More
            </a>

        </div>

    </section>

</main>

<footer>

    © <?= date('Y') ?> Fleeter.
    All rights reserved.

</footer>

</body>
</html>