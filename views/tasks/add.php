<div class="container mt-4">
    <h1 class="mb-4">Add Task</h1>
    <form action="/tasks/create" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="event_id" class="form-label">Event:</label>
            <select id="event_id" name="event_id" class="form-select" required>
                <option value="">Select an Event</option>
                <?php foreach ($eventController->getAllEvents() as $event): ?>
                    <option value="<?= $event['id']; ?>">
                        <?= htmlspecialchars($event['name']); ?> (<?= htmlspecialchars($event['date']); ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select an event.</div>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Task Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
            <div class="invalid-feedback">Please enter the task name.</div>
        </div>

        <div class="mb-3">
            <label for="required_skill" class="form-label">Required Skill:</label>
            <input type="text" id="required_skill" name="required_skill" class="form-control" required>
            <div class="invalid-feedback">Please enter the required skill.</div>
        </div>

        <div class="mb-3">
            <label for="hours" class="form-label">Hours:</label>
            <input type="number" id="hours" name="hours" class="form-control" required>
            <div class="invalid-feedback">Please enter the number of hours.</div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" id="is_completed" name="is_completed" class="form-check-input">
            <label for="is_completed" class="form-check-label">Is Completed:</label>
        </div>

        <button type="submit" class="btn btn-primary">Add Task</button>
        <a href="/tasks/list" class="btn btn-secondary ms-2">Back to Tasks</a>
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
$pageTitle = "Add Task";
include '../views/layouts/admin_layout.php';
?>
