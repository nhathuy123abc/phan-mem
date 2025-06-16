<?php
include('db.php');

// Lấy mã sinh viên từ GET
$id = $_GET['id'];

// Hiển thị thông tin sinh viên trước khi xóa
$stmt = $conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
$stmt->bind_param("s", $id);
$stmt->execute();

$res = $stmt->get_result();

if ($res->num_rows == 0) {
    echo "<p>Không tìm thấy sinh viên</p>";
    echo "<a href='index.php'>Trở về</a>";
    exit;
}

$row = $res->fetch_assoc();

$stmt->close();

if (isset($_POST['confirm'])) {
    // 1) Xóa tất cả ChiTietDangKy của sinh viên này
    $sql1 = "
      DELETE ck 
      FROM ChiTietDangKy ck
      JOIN DangKy dk ON ck.MaDK = dk.MaDK
      WHERE dk.MaSV = ?
    ";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("s", $id);
    $stmt1->execute();
    $stmt1->close();

    // 2) Xóa tất cả DangKy của sinh viên này
    $sql2 = "DELETE FROM DangKy WHERE MaSV = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $id);
    $stmt2->execute();
    $stmt2->close();

    // 3) Cuối cùng, xóa SinhVien
    $sql3 = "DELETE FROM SinhVien WHERE MaSV = ?";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param("s", $id);
    if ($stmt3->execute()) {
        header("Location: index.php");

        exit;
    } else {
        echo "Lỗi xóa sinh viên: " . $stmt3->error;
    }
    $stmt3->close();

}

include('header.php'); ?>
<h2>Xóa sinh viên</h2>

<ul>
    <li><strong>Mã sinh viên:</strong> <?= htmlspecialchars($row['MaSV']); ?> </li>
    <li><strong>Họ tên:</strong> <?= htmlspecialchars($row['HoTen']); ?> </li>
    <li><strong>Phái:</strong> <?= htmlspecialchars($row['GioiTinh']); ?> </li>
    <li><strong>Ngày sinh:</strong> <?= htmlspecialchars($row['NgaySinh']); ?> </li>
    <li><strong>Ngành học:</strong> <?= htmlspecialchars($row['MaNganh']); ?> </li>
    <li><strong>Hình ảnh:</strong> <img src="<?= htmlspecialchars($row['Hinh']); ?>" width="100" alt=""> </li>
</ul>

<p>Bạn có thật sự muốn xóa sinh viên này không?</p>

<form method="POST">
    <button name="confirm">Xóa</button>
    <a href="index.php">Hủy</a>
</form>

<?php include('footer.php'); ?>
