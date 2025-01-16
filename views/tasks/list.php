<?php
$tasks = $taskController->getAllTasks(); // Retrieve all tasks with event details
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Tasks</title>
</head>
<body>
    <h1>All Tasks</h1>
    <a href="/tasks/add">Add Task</a>
    <table border="1">
        <tr>
            <th>Task Name</th>
            <th>Required Skill</th>
            <th>Is Completed</th>
            <th>Event Name</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= htmlspecialchars($task['name']); ?></td>
            <td><?= htmlspecialchars($task['required_skill']); ?></td>
            <td><?= $task['is_completed'] ? 'Yes' : 'No'; ?></td>
            <td><?= htmlspecialchars($task['event_name']); ?></td>
            <td>
                <a href="/tasks/edit?id=<?= $task['id']; ?>">Edit</a>
                <form action="/tasks/delete" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $task['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <form action="/tasks/undo" method="get" style="display:inline;">
        <button type="submit">Undo</button>
    </form>

    <a href="/events/list">Back to Events</a>
</body>
</html>
