<div class="container mt-4">
    <h1 class="mb-4">Assign Task to User</h1>
    <form action="/tasks/assign" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="task_id" class="form-label">Select a Task:</label>
            <select id="task_id" name="task_id" class="form-select" required>
                <option value="">--Select a Task--</option>
                <?php foreach ($availableTasks as $task): ?>
                    <?php if (!$task['is_completed']): ?>
                    <option value="<?= $task['id']; ?>">
                        <?= htmlspecialchars($task['name']) . " (Skill: " . htmlspecialchars($task['required_skill']) . ")"; ?>
                    </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Please select a task to assign.</div>
        </div>

        <div class="d-flex">
            <button type="submit" class="btn btn-primary me-3">Assign Task</button>
            <a href="/tasks/list" class="btn btn-secondary">Back to Task List</a>
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
$pageTitle = "Assign Task";
include '../views/layouts/admin_layout.php';
?>
