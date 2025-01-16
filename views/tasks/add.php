<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
</head>
<body>
    <h1>Add Task</h1>
    <form action="/tasks/create" method="post">
        <label for="event_id">Event:</label>
        <select id="event_id" name="event_id" required>
            <option value="">Select an Event</option>
            <?php foreach ($eventController->getAllEvents() as $event): ?>
                <option value="<?= $event['id']; ?>">
                    <?= htmlspecialchars($event['name']); ?> (<?= htmlspecialchars($event['date']); ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="name">Task Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="required_skill">Required Skill:</label>
        <input type="text" id="required_skill" name="required_skill" required>
        <br>
        <label for="is_completed">Is Completed:</label>
        <input type="checkbox" id="is_completed" name="is_completed">
        <br>
        <button type="submit">Add Task</button>
    </form>
    <a href="/tasks/list">Back to Tasks</a>
</body>
</html>
