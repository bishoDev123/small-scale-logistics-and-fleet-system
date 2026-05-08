<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleeter Register</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        html, body { height: 100%; }
        body {
            display: flex; justify-content: center; align-items: center;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?q=80&w=1920&auto=format&fit=crop');
            background-size: cover; background-position: center; background-attachment: fixed;
            color: white; padding: 20px;
        }
        .login-container {
            width: 100%; max-width: 420px; background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(14px); border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
        }
        .logo { text-align: center; font-size: 42px; font-weight: bold; margin-bottom: 10px; letter-spacing: 1px; }
        .subtitle { text-align: center; color: rgba(255, 255, 255, 0.75); margin-bottom: 35px; line-height: 1.6; }
        .form-group { margin-bottom: 20px; }
        
        input[type="email"], input[type="password"], input[type="text"], select {
            width: 100%; padding: 14px; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.08); color: white; outline: none; transition: 0.25s;
        }
        select option { color: black; }
        input::placeholder { color: rgba(255, 255, 255, 0.55); }
        input:focus, select:focus { border-color: #3b82f6; background: rgba(255, 255, 255, 0.12); }
        
        button {
            width: 100%; padding: 14px; border: none; border-radius: 10px;
            background: #2563eb; color: white; font-size: 16px; font-weight: bold;
            cursor: pointer; transition: 0.25s;
        }
        button:hover { background: #1d4ed8; transform: translateY(-2px); }
        .back-home { display: block; text-align: center; margin-top: 25px; text-decoration: none; color: rgba(255, 255, 255, 0.7); transition: 0.2s; }
        .back-home:hover { color: white; }

        @media (max-width: 500px) { .login-container { padding: 30px 25px; } .logo { font-size: 34px; } }
    </style>
</head>
<body>

<div class="login-container">
    <div class="logo">Register</div>
    <div class="subtitle">Join Fleeter logistics and manage your deliveries.</div>

    <form method="POST" action="index.php?url=auth/register">
        <div class="form-group">
            <input type="text" name="name" placeholder="Full Name" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email Address" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <select name="role_id" required>
                <option value="4">Customer</option>
                <option value="3">Driver</option>
                <option value="2">Dispatcher</option>
            </select>
        </div>
        <button type="submit">Create Account</button>
    </form>

    <a href="index.php?url=auth/login" class="back-home">Already have an account? Login</a>
</div>

</body>
</html>