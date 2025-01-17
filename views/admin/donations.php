<h1 class="mb-4">Manage Donations</h1>
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Donor Name</th>
                <th>Type</th>
                <th>Amount</th>
                <th>State</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($donations as $donation): ?>
                <tr>
                    <td><?= htmlspecialchars($donation['id']??''); ?></td>
                    <td><?= htmlspecialchars($donation['donor_name']??''); ?></td>
                    <td><?= htmlspecialchars($donation['donation_type']??''); ?></td>
                    <td><?= htmlspecialchars($donation['amount']??''); ?></td>
                    <td>
                        <span class="badge bg-<?= $donation['state'] === 'approved' ? 'success' : ($donation['state'] === 'rejected' ? 'danger' : 'warning'); ?>">
                            <?= ucfirst(htmlspecialchars($donation['state'])); ?>
                        </span>
                    </td>
                    <td>
                        <form action="/admin/change_donation_state" method="post" class="d-flex align-items-center">
                            <input type="hidden" name="donation_id" value="<?= $donation['id']; ?>">
                            <select name="state" class="form-select form-select-sm me-2">
                                <option value="pending" <?= $donation['state'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="approved" <?= $donation['state'] === 'approved' ? 'selected' : ''; ?>>Approved</option>
                                <option value="rejected" <?= $donation['state'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
$pageTitle = "Manage Donations";
include '../views/layouts/admin_layout.php';
?>
