<?php
include('db.php');

$id = $_GET['id'];

// Lấy thông tin sinh viên
$stmt = $conn->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
$stmt->bind_param("s", $id);
$stmt->execute();

$sv = $stmt->get_result()->fetch_assoc();

if (isset($_POST['update'])) {
    $hoten = $_POST['HoTen'];
    $gioitinh = $_POST['GioiTinh'];
    $ngaysinh = $_POST['NgaySinh'];
    $manganh = $_POST['MaNganh'];

    // xử lý ảnh nếu có
    if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == 0) {
        $file_name = basename($_FILES['Hinh']['name']);
        $file_tmp = $_FILES['Hinh']['tmp_name'];
        $folder = "Content/images/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $path = $folder . $file_name;

        move_uploaded_file($file_tmp, $path);
        $hinh = $path;
    } else {
        // nếu chưa thay ảnh thì vẫn dùng ảnh cũ
        $hinh = $sv['Hinh'];
    }

    $stmt = $conn->prepare("UPDATE SinhVien SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? WHERE MaSV = ?");
    $stmt->bind_param("ssssss", $hoten, $gioitinh, $ngaysinh, $hinh, $manganh, $id);
    
    if ($stmt->execute()) {
        header("Location: index.php");

    } else {
        echo "Lỗi sửa dữ kiện.";
    }
}

include('header.php'); ?>
<h2>Sửa sinh viên</h2>

<form action="" method="POST" enctype="multipart/form-data">
    <input name="HoTen" value="<?= $sv['HoTen'] ?>"> 
    <input name="GioiTinh" value="<?= $sv['GioiTinh'] ?>"> 
    <input name="NgaySinh" type="date" value="<?= $sv['NgaySinh'] ?>"> 
    <input name="MaNganh" value="<?= $sv['MaNganh'] ?>"> 
    <img src="<?= $sv['Hinh'] ?>" width="100"><br>
    <input name="Hinh" type="file"><br>
    <input type="submit" name="update" value="Cập nhật">
</form>

<?php include('footer.php'); ?>
