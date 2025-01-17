<?php
$event = $eventController->getEvent($_GET['id']);
?>

<div class="container mt-4">
    <h1 class="mb-4">Edit Event</h1>
    <form action="/events/update" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?= htmlspecialchars($event['id']??''); ?>">
        
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($event['name']??''); ?>" required>
            <div class="invalid-feedback">Please enter the event name.</div>
        </div>
        
        <div class="mb-3">
            <label for="date" class="form-label">Date:</label>
            <input type="date" id="date" name="date" class="form-control" value="<?= htmlspecialchars($event['date']??''); ?>" required>
            <div class="invalid-feedback">Please select a valid date.</div>
        </div>
        
        <div class="mb-3">
            <label for="location" class="form-label">Location:</label>
            <input type="text" id="location" name="location" class="form-control" value="<?= htmlspecialchars($event['location']??''); ?>" required>
            <div class="invalid-feedback">Please enter the event location.</div>
        </div>
        
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="/events/list" class="btn btn-secondary ms-2">Back to List</a>
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
$pageTitle = "Edit Event";
include '../views/layouts/admin_layout.php';
?>
