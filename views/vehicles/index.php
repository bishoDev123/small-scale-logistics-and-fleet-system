<h1>Vehicles Management</h1>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Capacity</th>
        <th>Type</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php foreach ($vehicles as $vehicle): ?>
    <tr>
        <td><?= $vehicle['id'] ?></td>
        <td><?= $vehicle['capacity'] ?></td>
        <td><?= $vehicle['type'] ?></td>
        <td>
            <strong><?= $vehicle['status'] ?: 'Active' ?></strong>
        </td>
        <td>
            <?php if ($vehicle['status'] !== 'Out-of-Service'): ?>
                <a href="index.php?url=vehicle/lock&id=<?= $vehicle['id'] ?>" onclick="return confirm('Mark as Out-of-Service?')">Mark Unavailable</a>
            <?php else: ?>
                Locked
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>