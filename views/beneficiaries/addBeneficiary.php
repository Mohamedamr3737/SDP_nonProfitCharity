<!DOCTYPE html>
<html>
<head>
    <title>Add Beneficiary</title>
</head>
<body>
    <h1>Add Beneficiary</h1>
    <form action="/signup" method="post">
        <input type="hidden" name="type" value="beneficiary">

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>
        <br><br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>
        <br><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>
        <br><br>

        <button type="submit">Add Beneficiary</button>
    </form>
    <a href="/admin/view_needs">Back to Beneficiary Needs</a>
</body>
</html>
