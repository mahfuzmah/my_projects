<!DOCTYPE html>
<html>
<head>
    <title>Create New Employee</title>
    <link rel="stylesheet" href="<?= base_url('css/style_employee_create.css') ?>">
</head>
<body>
    <div class="container">
        <h1>Create New Employee</h1>
        <form action="<?= base_url('employees/store') ?>" method="post">
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Position:</label>
            <input type="text" name="position" required>

            <button type="submit">Save Employee</button>
        </form>

        <a href="<?= base_url('employees') ?>">← Back to List</a>
    </div>
</body>
</html>
