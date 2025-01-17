
    <h1>Manage Donations</h1>
    <table border="1">
        <thead>
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
                    <td><?= $donation['id']; ?></td>
                    <td><?= $donation['donor_name']; ?></td>
                    <td><?= $donation['donation_type']; ?></td>
                    <td><?= $donation['amount']; ?></td>
                    <td><?= ucfirst($donation['state']); ?></td>
                    <td>
                        <form action="/admin/change_donation_state" method="post">
                            <input type="hidden" name="donation_id" value="<?= $donation['id']; ?>">
                            <select name="state">
                                <option value="pending" <?= $donation['state'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="approved" <?= $donation['state'] === 'approved' ? 'selected' : ''; ?>>Approved</option>
                                <option value="rejected" <?= $donation['state'] === 'rejected' ? 'selected' : ''; ?>>Rejected</option>
                            </select>
                            <button type="submit">Update State</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php
$content = ob_get_clean();
$pageTitle = "Manage Donations";
include '../views/layouts/admin_layout.php';
?>

