<?php
include('db.php');

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
$stmt->bind_param("s", $id);
$stmt->execute();

$sv = $stmt->get_result()->fetch_assoc();

include('header.php'); ?>
<h2>Chi tiết sinh viên</h2>

<ul>
    <li>MaSV: <?= $sv['MaSV'] ?> </li>
    <li>HoTen: <?= $sv['HoTen'] ?> </li>
    <li>GioiTinh: <?= $sv['GioiTinh'] ?> </li>
    <li>NgaySinh: <?= $sv['NgaySinh'] ?> </li>
    <li>MaNganh: <?= $sv['MaNganh'] ?> </li>
    <li>Hinh: <img src="<?= $sv['Hinh'] ?>" width="100" alt=""> </li>
</ul>

<a href='index.php'>Trở về</a>

<?php include('footer.php'); ?>
