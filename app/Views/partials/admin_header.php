<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= esc($title ?? 'Admin Panel') ?></title>
  <link rel="stylesheet" href="<?= base_url('css/sidebar.css') ?>">
</head>
<body>

<!-- Toggle button for mobile -->
<button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>

<!-- Start container -->
<div class="admin-container">

  <!-- Sidebar inside the container -->
  <?= $this->include('partials/admin_sidebar') ?>
