
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['id']; ?></td>
                    <td><?= $user['firstName'] . ' ' . $user['lastName']; ?></td>
                    <td><?= $user['email']; ?></td>
                    <td><?= ucfirst($user['role']); ?></td>
                    <td>
                        <form action="/admin/assign_role" method="post">
                            <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                            <select name="role">
                                <option value="super_admin" <?= $user['role'] === 'super_admin' ? 'selected' : ''; ?>>Super Admin</option>
                                <option value="donations_admin" <?= $user['role'] === 'donations_admin' ? 'selected' : ''; ?>>Donations Admin</option>
                                <option value="payment_admin" <?= $user['role'] === 'payment_admin' ? 'selected' : ''; ?>>Payment Admin</option>
                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                            </select>
                            <button type="submit">Update Role</button>
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