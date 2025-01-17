<?php $beneficiariess = $BenefeciaryNeedsController->getAllBeneficiaries(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Assign Needs</title>
</head>
<body>
    <h1>Assign Needs to Beneficiary</h1>
    <form action="/admin/assign_needs" method="post">
        <label for="beneficiary_id">Beneficiary:</label>
        <select name="beneficiary_id" required>
            <?php foreach ($beneficiariess as $beneficiary): ?>
                <option value="<?= $beneficiary['id']; ?>"><?= htmlspecialchars($beneficiary['firstName'] . ' ' . $beneficiary['lastName']); ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Needs:</label><br>
        Vegetables (kg): <input type="number" name="vegetables" min="0" step="1"><br>
        Meat (kg): <input type="number" name="meat" min="0" step="1"><br>
        Money (EGP): <input type="number" name="money" min="0" step="1"><br>
        Service: <input type="text" name="service" placeholder="e.g., Doctor"><br>
        <br>

        <button type="submit">Assign Needs</button>
    </form>
    <br>
    <a href="/admin/manage_needs">Manage Needs</a>no
</body>
</html>
