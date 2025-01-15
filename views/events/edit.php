<?php
$event = $eventController->getEvent($_GET['id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Event</h1>
    <form action="/events/update" method="post">
        <input type="hidden" name="id" value="<?= $event['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($event['name']); ?>" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?= htmlspecialchars($event['date']); ?>" required>
        <br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?= htmlspecialchars($event['location']); ?>" required>
        <br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="/events/list">Back to List</a>
</body>
</html>
