<div class="container mt-4">
    <h1 class="mb-4">Add Beneficiary</h1>
    <form action="/signup" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="type" value="beneficiary">

        <div class="mb-3">
            <label for="firstName" class="form-label">First Name:</label>
            <input type="text" id="firstName" name="firstName" class="form-control" required>
            <div class="invalid-feedback">
                Please enter the first name.
            </div>
        </div>

        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name:</label>
            <input type="text" id="lastName" name="lastName" class="form-control" required>
            <div class="invalid-feedback">
                Please enter the last name.
            </div>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
            <div class="invalid-feedback">
                Please enter a valid phone number.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Add Beneficiary</button>
        <a href="/admin/list_beneficiaries" class="btn btn-secondary">Back to Beneficiary Needs</a>
    </form>
</div>

<script>
    // Bootstrap validation script
    (function () {
        'use strict';
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
$pageTitle = "Add Beneficiary";
include '../views/layouts/admin_layout.php';
?>
