<div class="container mt-4">
    <h1 class="mb-4">Beneficiary Needs Management</h1>
    <a href="/admin/add_needs" class="btn btn-primary mb-3">Add Needs</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Need ID</th>
                    <th>Beneficiary ID</th>
                    <th>Description</th>
                    <th>Current State</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($needs as $need): ?>
                    <tr>
                        <td><?= htmlspecialchars($need['id']); ?></td>
                        <td><?= htmlspecialchars($need['beneficiary_id']); ?></td>
                        <td><?= htmlspecialchars($need['description']); ?></td>
                        <td><?= htmlspecialchars(ucfirst($need['state'])); ?></td>
                        <td>
                            <div class="d-flex flex-wrap gap-2">
                                <form action="/beneficiaries/change_need_state" method="post" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $need['id']; ?>">
                                    <button type="submit" name="action" value="next" class="btn btn-success btn-sm">Next State</button>
                                    <button type="submit" name="action" value="back" class="btn btn-warning btn-sm">Previous State</button>
                                    <button type="submit" name="action" value="cancel" class="btn btn-danger btn-sm">Cancel State</button>
                                    <button type="submit" name="action" value="noCancel" class="btn btn-info btn-sm">Remove Cancel</button>
                                </form>
                                <form action="/beneficiaries/delete_need" method="post" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $need['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this need?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
$pageTitle = "Beneficiary Needs Management";
include '../views/layouts/admin_layout.php';
?>
