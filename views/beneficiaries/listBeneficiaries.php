<div class="container mt-4">
    <h1 class="mb-4">Beneficiaries</h1>
    <a href="/admin/add_beneficiary" class="btn btn-primary mb-3">Add Beneficiary</a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($beneficiaries as $beneficiary): ?>
                    <tr>
                        <td><?= htmlspecialchars($beneficiary['id']); ?></td>
                        <td><?= htmlspecialchars($beneficiary['firstName']); ?></td>
                        <td><?= htmlspecialchars($beneficiary['lastName']); ?></td>
                        <td><?= htmlspecialchars($beneficiary['phone']); ?></td>
                        <td>
                            <form action="/admin/delete_beneficiary" method="post" onsubmit="return confirm('Are you sure you want to delete this beneficiary?')" class="d-inline">
                                <input type="hidden" name="id" value="<?= $beneficiary['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$pageTitle = "Manage Beneficiaries";
include '../views/layouts/admin_layout.php';
?>
