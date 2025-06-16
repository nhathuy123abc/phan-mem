<?php
include('db.php');

// Khởi session nếu chưa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = "";

// Xử lý form đăng nhập
if (isset($_POST['login'])) {
    $masv = trim($_POST['username']);
    $pw   = $_POST['password'];

    // Lấy MaNganh từ SinhVien
    $stmt = $conn->prepare("
        SELECT MaNganh 
        FROM SinhVien 
        WHERE MaSV = ?
    ");
    $stmt->bind_param("s", $masv);
    $stmt->execute();
    $stmt->bind_result($manganh);
    if ($stmt->fetch()) {
        // So khớp input password với MaNganh
        if ($pw === $manganh) {
            $_SESSION['user'] = $masv;
            header("Location: index.php");
            exit;
        }
    }
    $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
    $stmt->close();
}

include('header.php');
?>

<h2>Đăng nhập</h2>
<?php if ($error): ?>
  <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="post">
  <input name="username" placeholder="Mã sinh viên" required>
  <input name="password" type="password" placeholder="Mật khẩu" required>
  <button type="submit" name="login">Đăng nhập</button>
</form>

<?php include('footer.php'); ?>
