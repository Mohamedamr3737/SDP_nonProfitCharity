<?php
if (!isset($eventController)) {
    throw new Exception("EventController is not passed to the view.");
}

$registrations = $eventController->getEventRegistrations();
?>

<div class="container mt-4">
    <h1 class="mb-4">Event Registrations</h1>

    <?php if (!empty($registrations)): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Registration ID</th>
                    <th>User Email</th>
                    <th>Event Name</th>
                    <th>Attendance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registrations as $registration): ?>
                    <tr>
                        <td><?= htmlspecialchars($registration['registration_id']) ?></td>
                        <td><?= htmlspecialchars($registration['user_email'] ?? $registration['user_first_name']) ?></td>
                        <td><?= htmlspecialchars($registration['event_name']) ?></td>
                        <td><?= $registration['is_attended'] ? 'Yes' : 'No' ?></td>
                        <td>
                            <?php if (!$registration['is_attended']): ?>
                                <form action="/admin/mark_attendance" method="POST">
                                    <input type="hidden" name="registration_id" value="<?= $registration['registration_id'] ?>">
                                    <button type="submit" class="btn btn-success">Mark as Attended</button>
                                </form>
                            <?php else: ?>
                                <span class="text-success">Attended</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-danger">No registrations found.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
$pageTitle = "Manage Event Registrations";
include '../views/layouts/admin_layout.php';
?>
