<?php $task = $taskController->getTask($_GET['id']); ?>

<div class="container mt-4">
    <h1 class="mb-4">Edit Task</h1>
    <form action="/tasks/update" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?= $task['id']; ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Task Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($task['name']); ?>" required>
            <div class="invalid-feedback">Please enter the task name.</div>
        </div>

        <div class="mb-3">
            <label for="required_skill" class="form-label">Required Skill:</label>
            <input type="text" id="required_skill" name="required_skill" class="form-control" value="<?= htmlspecialchars($task['required_skill']); ?>" required>
            <div class="invalid-feedback">Please enter the required skill.</div>
        </div>

        <div class="mb-3">
            <label for="hours" class="form-label">Hours:</label>
            <input type="number" id="hours" name="hours" class="form-control" value="<?= htmlspecialchars($task['hours']); ?>" required>
            <div class="invalid-feedback">Please enter the estimated hours.</div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" id="is_completed" name="is_completed" class="form-check-input" <?= $task['is_completed'] ? 'checked' : ''; ?>>
            <label for="is_completed" class="form-check-label">Is Completed</label>
        </div>

        <div class="d-flex">
            <button type="submit" class="btn btn-primary me-3">Save Changes</button>
            <a href="/events/edit/<?= $task['event_id']; ?>" class="btn btn-secondary">Back to Event</a>
        </div>
    </form>
</div>

<script>
    // Bootstrap form validation script
    (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>

<?php
$content = ob_get_clean();
$pageTitle = "Edit Task";
include '../views/layouts/admin_layout.php';
?>
