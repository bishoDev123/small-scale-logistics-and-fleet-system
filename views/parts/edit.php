<h1>Edit Part</h1>
<form method="POST" action="index.php?url=part/edit">
    <input type="hidden" name="id" value="<?= $part['id'] ?>">
    
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= $part['name'] ?>" required><br><br>
    
    <label>Max Life:</label><br>
    <input type="number" name="max_life" value="<?= $part['max_life'] ?>" required><br><br>
    
    <label>Current Usage:</label><br>
    <input type="number" name="current_usage" value="<?= $part['current_usage'] ?>" required><br><br>
    
    <button type="submit">Update Part</button>
</form>