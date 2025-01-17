<div class="container mt-4">
    <h1 class="mb-4">Manage Users</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
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
                        <td><?= htmlspecialchars($user['id']??''); ?></td>
                        <td><?= htmlspecialchars($user['firstName']??'' . ' ' . $user['lastName']??''); ?></td>
                        <td><?= htmlspecialchars($user['email']??''); ?></td>
                        <td>
                            <span class="badge bg-<?= $user['role'] === 'super_admin' ? 'primary' : ($user['role'] === 'donations_admin' ? 'success' : ($user['role'] === 'payment_admin' ? 'warning' : 'secondary')); ?>">
                                <?= ucfirst(htmlspecialchars($user['role'])); ?>
                            </span>
                        </td>
                        <td>
                            <form action="/admin/assign_role" method="post" class="d-flex align-items-center">
                                <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                <select name="role" class="form-select form-select-sm me-2">
                                    <option value="super_admin" <?= $user['role'] === 'super_admin' ? 'selected' : ''; ?>>Super Admin</option>
                                    <option value="donations_admin" <?= $user['role'] === 'donations_admin' ? 'selected' : ''; ?>>Donations Admin</option>
                                    <option value="payment_admin" <?= $user['role'] === 'payment_admin' ? 'selected' : ''; ?>>Payment Admin</option>
                                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
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
$pageTitle = "Manage Users";
include '../views/layouts/admin_layout.php';
?>
