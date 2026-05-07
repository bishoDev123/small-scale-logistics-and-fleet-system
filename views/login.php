<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

<h1>Login</h1>

<form method="POST">

    <input
        type="email"
        name="email"
        placeholder="Email"
        required
    >

    <br><br>

    <input
        type="password"
        name="password"
        placeholder="Password"
        required
    >

    <br><br>

    <label>
        <input
            type="checkbox"
            id="staffCheckbox"
            name="is_staff"
        >
        Staff Member
    </label>

    <br><br>

    <div
        id="staffSection"
        class="hidden"
    >

        <input
            type="text"
            name="employee_code"
            placeholder="Employee Code"
        >

    </div>

    <br>

    <button type="submit">
        Login
    </button>

</form>

<script>

    const checkbox =
        document.getElementById(
            'staffCheckbox'
        );

    const staffSection =
        document.getElementById(
            'staffSection'
        );

    checkbox.addEventListener(
        'change',
        function () {

            if (this.checked) {
                staffSection
                    .classList
                    .remove('hidden');
            }
            else {
                staffSection
                    .classList
                    .add('hidden');
            }
        }
    );

</script>

</body>
</html>