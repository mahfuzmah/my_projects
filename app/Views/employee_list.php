<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= base_url('css/style_employee_list.css') ?>">
    <title>Employee List</title>
</head>
<body>
<div class="top-bar">
    <?php if (session()->get('logged_in')): ?>
        <div class="user-info">
            <img src="<?= base_url('images/avatar-placeholder.png') ?>" alt="Profile" class="profile-avatar">
            <span><?= esc(session()->get('username')); ?></span>
        </div>

        <!-- 👇 New Attendance link -->
        <a href="<?= base_url('attendance') ?>" class="nav-btn">Attendance</a>
        <a href="<?= base_url('attendance/report') ?>" class="nav-btn">Summary</a>
        <a href="<?= base_url('logout') ?>" class="logout-btn">Logout</a>
    <?php endif; ?>
</div>

    <div class="container">
        <h1>Employee List</h1>

        <!-- Flash Message -->
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert-success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <table border="1" cellpadding="10">
            <tr>
                <th>Serial</th>
                <th>Photo</th>
                <th>Name</th>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Job Type</th>
                <th>Joined Date</th>
                <th>Edit</th> <!-- New column for Edit button -->
            </tr>
            <?php $serial = 1; ?>
            <?php foreach($employees as $employee): ?>
            <tr>
                <td><?= $serial++; ?></td>
                <td>
                    <?php if ($employee['picture']): ?>
                    <img src="<?= base_url('uploads/' . $employee['picture']) ?>" alt="Employee Photo" width="50" height="50">
                <?php else: ?>
                    <img src="<?= base_url('images/avatar-placeholder.png') ?>" alt="No Photo" width="50" height="50">
                <?php endif; ?>
                </td>
                <td><?= esc($employee['name']); ?></td>
                <td><?= str_pad($employee['id'], 4, '0', STR_PAD_LEFT); ?></td>
                <td><?= esc($employee['username']); ?></td>
                <td><?= esc($employee['email']); ?></td>
                <td><?= esc(ucfirst($employee['gender'])); ?></td>
                <td><?= esc($employee['job_type']); ?></td>
                <td><?= esc($employee['joined_date']); ?></td>
                <td>
                    <a href="<?= base_url('employees/edit/' . $employee['id']) ?>" class="edit-btn"> &#x270D; </a>
                    <a href="<?= base_url('employees/delete/' . $employee['id']) ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this employee?');"> 🗑️ </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div class="bottom-actions">
            <a href="<?= base_url('employees/register') ?>" class="create-btn">+ Create Employee</a>
        </div>
    </div>
</body>
</html>
