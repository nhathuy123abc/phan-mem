<?php
include('db.php');

if (isset($_POST['add'])) {
    $masv     = trim($_POST['MaSV']);
    $hoten    = trim($_POST['HoTen']);
    $gioitinh = trim($_POST['GioiTinh']);
    $ngaysinh = $_POST['NgaySinh'];
    $hinh     = trim($_POST['Hinh']);
    $manganh  = trim($_POST['MaNganh']);

    // Chèn 6 trường: MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh
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
        header("Location: index.php");
        exit;
    } else {
        echo "Lỗi thêm dữ liệu: " . htmlspecialchars($stmt->error);
    }
    $stmt->close();
}

include('header.php');
?>

<h2>Thêm sinh viên</h2>

<form action="" method="POST">
    <label>Mã sinh viên:</label>
    <input name="MaSV" required>

    <label>Họ tên:</label>
    <input name="HoTen" required>

    <label>Giới tính:</label>
    <input name="GioiTinh" required>

    <label>Ngày sinh:</label>
    <input name="NgaySinh" type="date" required>

    <label>URL ảnh:</label>
    <input name="Hinh" required>

    <label>Mã ngành:</label>
    <input name="MaNganh" required>

    <button type="submit" name="add">Thêm</button>
</form>

<?php include('footer.php'); ?>
