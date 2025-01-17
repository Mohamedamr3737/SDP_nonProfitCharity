<?php
$tasks = $taskController->getAllTasks(); // Retrieve all tasks with event details

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$certificateLink = $_SESSION['certificate_link'] ?? null; // Retrieve certificate link from session if available
unset($_SESSION['certificate_link']); // Clear the session after displaying the link
?>

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
            <th>Hours</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= htmlspecialchars($task['name']); ?></td>
            <td><?= htmlspecialchars($task['required_skill']); ?></td>
            <td><?= $task['is_completed'] ? 'Yes' : 'No'; ?></td>
            <td><?= htmlspecialchars($task['event_name']); ?></td>
            <td><?= htmlspecialchars($task['hours']); ?></td>
            <td>
                <a href="/tasks/edit?id=<?= $task['id']; ?>">Edit</a>
                <form action="/tasks/delete" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $task['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
                <?php if ($task['is_completed']): ?>
                    <a href="/tasks/generate_certificate?task_id=<?= $task['id']; ?>&user_id=<?= $task['assigned_to']; ?>">Generate Certificate</a>
                <?php else: ?>
                    Not Completed
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <form action="/tasks/undo" method="get" style="display:inline;">
        <button type="submit">Undo</button>
    </form>

    <a href="/events/list">Back to Events</a>

    <?php if ($certificateLink): ?>
        <h2>Download Certificate</h2>
        <a href="<?= $certificateLink; ?>" target="_blank">Download Certificate</a>
    <?php endif; ?>
    <?php
$content = ob_get_clean();
$pageTitle = "Manage Donations";
include '../views/layouts/admin_layout.php';
?>

