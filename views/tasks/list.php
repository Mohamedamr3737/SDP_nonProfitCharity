<?php
$tasks = $taskController->getAllTasks(); // Retrieve all tasks with event details

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$certificateLink = $_SESSION['certificate_link'] ?? null; // Retrieve certificate link from session if available
unset($_SESSION['certificate_link']); // Clear the session after displaying the link
?>

<div class="container mt-4">
    <h1 class="mb-4">All Tasks</h1>
    <a href="/tasks/add" class="btn btn-primary mb-3">Add Task</a>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Task Name</th>
                <th>Required Skill</th>
                <th>Is Completed</th>
                <th>Event Name</th>
                <th>Hours</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= htmlspecialchars($task['name']); ?></td>
                    <td><?= htmlspecialchars($task['required_skill']); ?></td>
                    <td><?= $task['is_completed'] ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>'; ?></td>
                    <td><?= htmlspecialchars($task['event_name']); ?></td>
                    <td><?= htmlspecialchars($task['hours']); ?></td>
                    <td>
                        <a href="/tasks/edit?id=<?= $task['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/tasks/delete" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $task['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <?php if ($task['is_completed']): ?>
                            <a href="/tasks/generate_certificate?task_id=<?= $task['id']; ?>&user_id=<?= $task['assigned_to']; ?>" class="btn btn-info btn-sm">Generate Certificate</a>
                        <?php else: ?>
                            <span class="text-muted">Not Completed</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form action="/tasks/undo" method="get" class="d-inline">
        <button type="submit" class="btn btn-secondary">Undo</button>
    </form>

    <a href="/events/list" class="btn btn-secondary">Back to Events</a>

    <?php if ($certificateLink): ?>
        <div class="mt-4">
            <h2>Download Certificate</h2>
            <a href="<?= $certificateLink; ?>" class="btn btn-success" target="_blank">Download Certificate</a>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
$pageTitle = "All Tasks";
include '../views/layouts/admin_layout.php';
?>
