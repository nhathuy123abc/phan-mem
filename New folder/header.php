<?php
// header.php

// Khởi session nếu chưa được khởi
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý sinh viên</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>QUẢN LÝ SINH VIÊN</h1>
    <nav>
      <?php
        // Lấy URI hiện tại (ví dụ "course.php?page=2") để redirect về sau logout
        $current = ltrim($_SERVER['REQUEST_URI'], '/');
      ?>
      <a href="index.php">Sinh viên</a> |
      <a href="course.php">Học phần</a> |
      <a href="checkout.php">Đã đăng ký</a> |
      <?php if (isset($_SESSION['user'])): ?>
        <span>Xin chào, <?= htmlspecialchars($_SESSION['user']) ?></span> |
        <a href="logout.php?redirect=<?= urlencode($current) ?>">Đăng xuất</a>
      <?php else: ?>
        <a href="login.php">Đăng nhập</a> |
        <a href="register.php">Đăng ký</a>
      <?php endif; ?>
    </nav>
  </header>
  <main>
