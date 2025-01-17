<div class="container mt-4">
    <h1 class="mb-4">Manage Events</h1>
    <a href="/events/add" class="btn btn-primary mb-3">Add Event</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($eventController->getAllEvents() as $event): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['name']??''); ?></td>
                        <td><?= htmlspecialchars($event['date']??''); ?></td>
                        <td><?= htmlspecialchars($event['location']??''); ?></td>
                        <td>
                            <a href="/events/edit/<?= $event['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                            <form action="/events/delete" method="post" class="d-inline">
                                <input type="hidden" name="id" value="<?= $event['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <form action="/events/undo" method="get" class="mt-3">
        <button type="submit" class="btn btn-secondary">Undo</button>
    </form>
</div>

<?php
$content = ob_get_clean();
$pageTitle = "Manage Events";
include '../views/layouts/admin_layout.php';
?>
