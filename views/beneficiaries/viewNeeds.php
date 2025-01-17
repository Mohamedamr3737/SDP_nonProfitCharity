<!DOCTYPE html>
<html>
<head>
    <title>View Beneficiary Needs</title>
</head>
<body>
    <h1>Beneficiary Needs</h1>
    <table border="1">
        <tr>
            <th>Beneficiary ID</th>
            <th>Needs Description</th>
        </tr>
        <?php foreach ($needs as $need): ?>
        <tr>
            <td><?= htmlspecialchars($need['beneficiary_id']); ?></td>
            <td><?= htmlspecialchars($need['description']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="/admin/add_needs">Back to Add Needs</a>
</body>
</html>
