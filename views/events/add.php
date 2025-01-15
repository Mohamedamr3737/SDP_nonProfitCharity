<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
</head>
<body>
    <h1>Add Event</h1>
    <form action="/events/create" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>
        <br>
        <button type="submit">Add Event</button>
    </form>
    <a href="/events/list">Back to List</a>
</body>
</html>
