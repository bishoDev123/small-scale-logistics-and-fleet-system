<h1>Spare Parts Inventory</h1>
<a href="index.php?url=part/create">Add New Part</a>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Max Life</th>
        <th>Current Usage</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($parts as $part): ?>
    <tr>
        <td><?= $part['id'] ?></td>
        <td><?= $part['name'] ?></td>
        <td><?= $part['max_life'] ?></td>
        <td><?= $part['current_usage'] ?></td>
        <td>
            <a href="index.php?url=part/edit&id=<?= $part['id'] ?>">Edit</a> | 
            <a href="index.php?url=part/delete&id=<?= $part['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>