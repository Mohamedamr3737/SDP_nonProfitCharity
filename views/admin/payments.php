<div class="container mt-4">
    <h1 class="mb-4">Manage Payments</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Donor Name</th>
                    <th>Donation Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?= htmlspecialchars($payment['id']??''); ?></td>
                        <td><?= htmlspecialchars($payment['donor_name']??''); ?></td>
                        <td>
                            <span class="badge bg-<?= $payment['donation_type'] === 'online' ? 'primary' : ($payment['donation_type'] === 'check' ? 'success' : 'warning'); ?>">
                                <?= htmlspecialchars(ucfirst($payment['donation_type'])); ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($payment['amount']??''); ?></td>
                        <td><?= htmlspecialchars($payment['created_at']??''); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="/admin/dashboard" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>

<?php
$content = ob_get_clean();
$pageTitle = "Manage Payments";
include '../views/layouts/admin_layout.php';
?>
