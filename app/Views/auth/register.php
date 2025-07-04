<!-- app/Views/auth/register.php -->
<?= $this->include('partials/header') ?>

<head>
    <link rel="stylesheet" href="<?= base_url('css/style_register.css') ?>">
</head>

<div class="container">
    <h2>Register New Employee</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="error">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('employees/process-register') ?>" method="post" enctype="multipart/form-data">
        
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="text" name="email" required>

        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>
        
        <label>Gender:</label>
        <select name="gender" required>
            <option value="" disabled selected>Select gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>

        <label for="job_type">Job Type:</label>
        <select name="job_type" id="job_type" required>
            <option value="Full Time">Full Time</option>
            <option value="Part Time">Part Time</option>
        </select>

        <label>Joined Date:</label>
        <input type="date" name="joined_date" required>

        <label>Picture:</label>
        <input type="file" name="picture">

        <button type="submit">Register</button>
    </form>
</div>

<?= $this->include('partials/footer') ?>
