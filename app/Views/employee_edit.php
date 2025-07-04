<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="<?= base_url('css/style_employee_edit.css') ?>">
</head>
<body>
    <div class="container">
        <h1>Edit Employee</h1>
        <form action="<?= base_url('employees/update/' . $employee['id']) ?>" method="post">
            <label>Name:</label>
            <input type="text" name="name" value="<?= esc($employee['name']) ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= esc($employee['email']) ?>" required>

            <label>Position:</label>
            <input type="text" name="position" value="<?= esc($employee['position']) ?>" required>

            <button type="submit">Update Employee</button>
        </form>

        <a href="<?= base_url('employees') ?>">← Back to List</a>
    </div>
</body>
</html>
