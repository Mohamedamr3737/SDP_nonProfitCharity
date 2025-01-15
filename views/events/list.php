<!DOCTYPE html>
<html>
<head>
    <title>Events List</title>
</head>
<body>
    <h1>Events</h1>
    <a href="/events/add">Add Event</a>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($eventController->getAllEvents() as $event): ?>
        <tr>
            <td><?= htmlspecialchars($event['name']); ?></td>
            <td><?= htmlspecialchars($event['date']); ?></td>
            <td><?= htmlspecialchars($event['location']); ?></td>
            <td>
                <a href="/events/edit/<?= $event['id']; ?>">Edit</a>
                <form action="/events/delete" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $event['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <form action="/events/undo" method="get" style="display:inline;">
        <button type="submit">Undo</button>
    </form>
    <form action="/events/redo" method="get" style="display:inline;">
        <button type="submit">Redo</button>
    </form>
</body>
</html>
