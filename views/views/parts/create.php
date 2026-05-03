<h1>Add New Part</h1>
<form method="POST" action="index.php?url=part/create">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>
    
    <label>Max Life:</label><br>
    <input type="number" name="max_life" required><br><br>
    
    <label>Current Usage:</label><br>
    <input type="number" name="current_usage" required><br><br>
    
    <button type="submit">Save Part</button>
</form>