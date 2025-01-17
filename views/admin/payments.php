
    <h1>Manage Payments</h1>
    <table border="1">
        <thead>
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
                    <td><?= $payment['id']; ?></td>
                    <td><?= htmlspecialchars($payment['donor_name']); ?></td>
                    <td><?= htmlspecialchars($payment['donation_type']); ?></td>
                    <td><?= htmlspecialchars($payment['amount']); ?></td>
                    <td><?= htmlspecialchars($payment['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/admin/dashboard">Back to Dashboard</a>

    <?php
$content = ob_get_clean();
$pageTitle = "Manage Donations";
include '../views/layouts/admin_layout.php';
?>
