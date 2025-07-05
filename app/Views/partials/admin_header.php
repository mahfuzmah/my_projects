<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= esc($title ?? 'Admin Panel') ?></title>
  <link rel="stylesheet" href="<?= base_url('css/sidebar.css') ?>">
</head>
<body>

<button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>

<div class="admin-container">

  <?= $this->include('partials/admin_sidebar') ?>
