<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/style_auth.css') ?>">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <form method="post" action="<?= base_url('process-login') ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? </p>
        <p><a href="<?= base_url('/register') ?>">Register here</a></p>

    </div>
</body>
</html>
