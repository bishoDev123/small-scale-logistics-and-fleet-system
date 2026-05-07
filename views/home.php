<h1>Users</h1>

<?php foreach ($users as $user): ?>

    <p>
        <?= $user['name'] ?>
    </p>

    <ul>
        <li>
            Email:
            <?= $user['email'] ?>
        </li>

        <li>
            Role:
            <?= $user['role_name'] ?>
        </li>
    </ul>

<?php endforeach; ?>

<br>

<a href="index.php?url=auth/login">
    <button>
        Login
    </button>
</a>

<br><br>

<a href="index.php?url=auth/logout">
    <button>
        Logout
    </button>
</a>