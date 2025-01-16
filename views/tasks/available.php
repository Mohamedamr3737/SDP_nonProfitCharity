<!DOCTYPE html>
<html>
<head>
    <title>Assign Task</title>
</head>
<body>
    <h1>Assign Task to User</h1>
    <form action="/tasks/assign" method="post">
        <label for="task_id">Select a Task:</label>
        <select id="task_id" name="task_id" required>
            <option value="">--Select a Task--</option>
            <?php foreach ($availableTasks as $task): ?>
                <option value="<?= $task['id']; ?>">
                    <?= htmlspecialchars($task['name']) . " (Skill: " . htmlspecialchars($task['required_skill']) . ")"; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <button type="submit">Assign Task</button>
    </form>
    <a href="/tasks/list">Back to Task List</a>
</body>
</html>
