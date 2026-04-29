<h1>Users</h1>

<?php
foreach ($users as $user): ?>
    <p><?= $user['name'] ?></p>
        <li>email: <?=$user['email']?> </li>
        <li>password: <?=$user['password']?></li>
    </ul>
<?php endforeach; ?>