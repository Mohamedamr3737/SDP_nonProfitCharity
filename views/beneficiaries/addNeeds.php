<div class="container mt-4">
    <h1 class="mb-4">Assign Needs to Beneficiary</h1>
    
    <form action="/admin/assign_needs" method="post" class="needs-assignment-form">
        <!-- Beneficiary Selection -->
        <div class="mb-3">
            <label for="beneficiary_id" class="form-label">Beneficiary:</label>
            <select name="beneficiary_id" id="beneficiary_id" class="form-select" required>
                <option value="" disabled selected>Select a Beneficiary</option>
                <?php foreach ($beneficiariess as $beneficiary): ?>
                    <option value="<?= $beneficiary['id']; ?>">
                        <?= htmlspecialchars($beneficiary['firstName'] . ' ' . $beneficiary['lastName']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Needs Input Fields -->
        <div class="mb-3">
            <label for="needs" class="form-label">Needs:</label>
            
            <div class="input-group mb-2">
                <span class="input-group-text">Vegetables (kg)</span>
                <input type="number" name="vegetables" class="form-control" min="0" step="1" placeholder="Enter quantity">
            </div>

            <div class="input-group mb-2">
                <span class="input-group-text">Meat (kg)</span>
                <input type="number" name="meat" class="form-control" min="0" step="1" placeholder="Enter quantity">
            </div>

            <div class="input-group mb-2">
                <span class="input-group-text">Money (EGP)</span>
                <input type="number" name="money" class="form-control" min="0" step="1" placeholder="Enter amount">
            </div>

            <div class="input-group mb-2">
                <span class="input-group-text">Service</span>
                <input type="text" name="service" class="form-control" placeholder="e.g., Doctor">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Assign Needs</button>
            <a href="/admin/manage_needs" class="btn btn-secondary">Back to Manage Needs</a>
        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
$pageTitle = "Assign Needs to Beneficiary";
include '../views/layouts/admin_layout.php';
?>
