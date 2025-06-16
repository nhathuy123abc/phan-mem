<?php
include('db.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");

}

$masv = $_SESSION['user'];

$stmt = $conn->prepare("SELECT DangKy.MaDK, HocPhan.MaHP, HocPhan.TenHP FROM ChiTietDangKy 
    JOIN DangKy ON ChiTietDangKy.MaDK = DangKy.MaDK 
    JOIN HocPhan ON ChiTietDangKy.MaHP = HocPhan.MaHP 
    WHERE DangKy.MaSV = ?");
$stmt->bind_param("s", $masv);
$stmt->execute();

$results = $stmt->get_result();

include('header.php'); ?>
<h2>Các học phần bạn đăng kí</h2>

<table>
    <thead>
        <tr>
            <th>Mã đăng kí</th>
            <th>Mã học phần</th>
            <th>Tên học phần</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($item = $results->fetch_assoc()) { ?>
            <tr>
                <td><?= $item['MaDK'] ?> </td>
                <td><?= $item['MaHP'] ?> </td>
                <td><?= $item['TenHP'] ?> </td>
                <td><a href='checkout.php?id=<?= $item['MaHP'] ?>&madk=<?= $item['MaDK'] ?>' onclick='return confirm("Xóa?")'>Xóa</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $madk = $_GET['madk'];

    $stmt = $conn->prepare("DELETE FROM ChiTietDangKy WHERE MaDK = ? AND MaHP = ?");
    $stmt->bind_param("is", $madk, $id);
    if ($stmt->execute()) {
        header("Location: checkout.php");

    } else {
        echo "Lỗi khi xóa.";
    }
}

include('footer.php'); ?>
