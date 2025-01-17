
    <h1>Beneficiary Needs Management</h1>
    <a href="/admin/add_needs">Add Needs</a>

    <table border="1">
        <tr>
            <th>Need ID</th>
            <th>Beneficiary ID</th>
            <th>Description</th>
            <th>Current State</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($needs as $need): ?>
        <tr>
            <td><?= htmlspecialchars($need['id']); ?></td>
            <td><?= htmlspecialchars($need['beneficiary_id']); ?></td>
            <td><?= htmlspecialchars($need['description']); ?></td>
            <td><?= htmlspecialchars($need['state']); ?></td>
            <td>
                <form action="/beneficiaries/change_need_state" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $need['id']; ?>">
                    <button type="submit" name="action" value="next">Next State</button>
                    <button type="submit" name="action" value="back">Previous State</button>
                    <button type="submit" name="action" value="cancel">Cancel State</button>
                    <button type="submit" name="action" value="noCancel">Remove Cancel State</button>
                </form>
                <form action="/beneficiaries/delete_need" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $need['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php
$content = ob_get_clean();
$pageTitle = "Manage Donations";
include '../views/layouts/admin_layout.php';
?>
