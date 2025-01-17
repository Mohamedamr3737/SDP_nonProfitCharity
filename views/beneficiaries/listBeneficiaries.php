
    <h1>Beneficiaries</h1>
    <a href="/admin/add_beneficiary">Add Beneficiary</a>
    <table border="1">
        <thead>
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
                    <form action="/admin/delete_beneficiary" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $beneficiary['id']; ?>">
                        <button type="submit">Delete</button>
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