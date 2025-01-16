<?php $task = $taskController->getTask($_GET['id']); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form action="/tasks/update" method="post">
        <input type="hidden" name="id" value="<?= $task['id']; ?>">
        <label for="name">Task Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($task['name']); ?>" required>
        <br>
        <label for="required_skill">Required Skill:</label>
        <input type="text" id="required_skill" name="required_skill" value="<?= htmlspecialchars($task['required_skill']); ?>" required>
        <br>
        <label for="is_completed">Is Completed:</label>
        <input type="checkbox" id="is_completed" name="is_completed" <?= $task['is_completed'] ? 'checked' : ''; ?>>
        <br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="/events/edit/<?= $task['event_id']; ?>">Back to Event</a>
</body>
</html>
