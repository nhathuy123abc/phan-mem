<?php
include('db.php');

// Xử lý form đăng ký
if (isset($_POST['register'])) {
    $masv     = trim($_POST['MaSV']);
    $hoten    = trim($_POST['HoTen']);
    $gioitinh = trim($_POST['GioiTinh']);
    $ngaysinh = $_POST['NgaySinh'];
    $hinh     = trim($_POST['Hinh']);
    $manganh  = trim($_POST['MaNganh']);

    // 1. Kiểm tra mã đã tồn tại chưa
    $check = $conn->prepare("SELECT MaSV FROM SinhVien WHERE MaSV = ?");
    $check->bind_param("s", $masv);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $error = "Mã sinh viên <strong>$masv</strong> đã tồn tại. Vui lòng chọn mã khác.";
    } else {
        // 2. Thêm mới
        $stmt = $conn->prepare("
            INSERT INTO SinhVien
            (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "ssssss",
            $masv, $hoten, $gioitinh,
            $ngaysinh, $hinh, $manganh
        );

        if ($stmt->execute()) {
            // Thêm thành công, chuyển về chính trang register để hiển thị
            header("Location: register.php");
            exit;
        } else {
            $error = "Lỗi hệ thống: " . $stmt->error;
        }
    }
    $check->close();
}

// Lấy danh sách tất cả sinh viên
$result = $conn->query("SELECT * FROM SinhVien ORDER BY MaSV");

include('header.php');
?>

<h2>Đăng ký sinh viên mới</h2>

<?php if (!empty($error)): ?>
  <p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form action="" method="POST">
    <input name="MaSV"     placeholder="Mã sinh viên"    required>
    <input name="HoTen"    placeholder="Họ tên"           required>
    <input name="GioiTinh" placeholder="Giới tính"        required>
    <input name="NgaySinh" type="date"                  required>
    <input name="Hinh"     placeholder="URL hình"        required>
    <input name="MaNganh"  placeholder="Mã ngành"         required>
    <button type="submit" name="register">Đăng ký</button>
</form>

<hr>

<h2>Danh sách sinh viên đã đăng ký</h2>
<table>
  <thead>
    <tr>
      <th>Mã SV</th>
      <th>Họ tên</th>
      <th>Giới tính</th>
      <th>Ngày sinh</th>
      <th>Ảnh</th>
      <th>Ngành</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['MaSV']) ?></td>
        <td><?= htmlspecialchars($row['HoTen']) ?></td>
        <td><?= htmlspecialchars($row['GioiTinh']) ?></td>
        <td><?= htmlspecialchars($row['NgaySinh']) ?></td>
        <td>
          <?php if ($row['Hinh']): ?>
            <img src="<?= htmlspecialchars($row['Hinh']) ?>" width="60" alt="">
          <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($row['MaNganh']) ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include('footer.php'); ?>
