<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }

        .container {
            width: 320px;
            margin: 100px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
        }

        input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
        }

        .hidden {
            display: none;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Login</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">

        <input
            type="email"
            name="email"
            placeholder="Email"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >

        <label>
            <input
                type="checkbox"
                id="staffCheckbox"
                name="is_staff"
                style="width:auto;"
            >
            Staff Member
        </label>

        <div id="staffSection" class="hidden">

            <input
                type="text"
                name="employee_code"
                placeholder="Employee Code"
            >

        </div>

        <button type="submit">
            Login
        </button>

    </form>

</div>

<script>
    const checkbox = document.getElementById('staffCheckbox');
    const staffSection = document.getElementById('staffSection');

    checkbox.addEventListener('change', function () {

        if (this.checked) {
            staffSection.classList.remove('hidden');
        } else {
            staffSection.classList.add('hidden');
        }

    });
</script>

</body>
</html>