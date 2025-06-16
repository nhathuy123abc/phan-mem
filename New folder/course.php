<?php
include('db.php');
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$masv = $_SESSION['user'];
$message = "";

// Xử lý khi submit đăng ký học phần
if (isset($_POST['add'])) {
    $mahp   = $_POST['MaHP'];
    $ngaydk = date("Y-m-d");

    // 0) Kiểm tra số lượng còn chỗ
    $stmt = $conn->prepare("SELECT SoLuong FROM HocPhan WHERE MaHP = ?");
    $stmt->bind_param("s", $mahp);
    $stmt->execute();
    $stmt->bind_result($soLuong);
    $stmt->fetch();
    $stmt->close();

    if ($soLuong <= 0) {
        $message = "Học phần này đã hết chỗ.";
    } else {
        // 1) Lấy hoặc thêm bản ghi DangKy
        $stmt = $conn->prepare("SELECT MaDK FROM DangKy WHERE MaSV = ?");
        $stmt->bind_param("s", $masv);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 0) {
            $ins = $conn->prepare("INSERT INTO DangKy (NgayDK, MaSV) VALUES (?, ?)");
            $ins->bind_param("ss", $ngaydk, $masv);
            $ins->execute();
            $madk = $conn->insert_id;
            $ins->close();
        } else {
            $madk = $res->fetch_assoc()['MaDK'];
        }

        $stmt->close();

        // 2) Kiểm tra nếu chưa đăng kí học phần này
        $chk = $conn->prepare("SELECT 1 FROM ChiTietDangKy WHERE MaDK = ? AND MaHP = ?");
        $chk->bind_param("is", $madk, $mahp);
        $chk->execute();
        $chk->store_result();

        if ($chk->num_rows > 0) {
            $message = "Bạn đã đăng ký học phần này rồi.";
        } else {
            // 3) Thực sự chèn nếu chưa có
            $ins2 = $conn->prepare("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)");
            $ins2->bind_param("is", $madk, $mahp);
            $ins2->execute();

            // Giảm số chỗ còn trống
            $upd = $conn->prepare("UPDATE HocPhan SET SoLuong = SoLuong - 1 WHERE MaHP = ?");
            $upd->bind_param("s", $mahp);
            $upd->execute();

            $upd->close();
            $ins2->close();

            $message = "Đăng ký thành công!";
        }
        $chk->close();

    }
    // tránh resubmit form
    header("Location: course.php?msg=" . urlencode($message));

    exit;
}

// Xử lý xóa từng học phần
if (isset($_GET['madk'], $_GET['mahp'])) {
    // Tăng số chỗ lên nếu xóa đăng kí
    $del = $conn->prepare("DELETE FROM ChiTietDangKy WHERE MaDK = ? AND MaHP = ?");
    $del->bind_param("is", $_GET['madk'], $_GET['mahp']);
    if ($del->execute()) {
        $upd = $conn->prepare("UPDATE HocPhan SET SoLuong = SoLuong + 1 WHERE MaHP = ?");
        $upd->bind_param("s", $_GET['mahp']);
        $upd->execute();
        $upd->close();
    }
    $del->close();

    header("Location: course.php");

    exit;
}

// Xử lý xóa tất cả học phần
if (isset($_POST['delete_all'])) {
    // Lấy MaDK của sinh viên
    $stmt = $conn->prepare("SELECT MaDK FROM DangKy WHERE MaSV = ?");
    $stmt->bind_param("s", $masv);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $madk = $res->fetch_assoc()['MaDK'];

        // Tăng số chỗ lên trước khi xóa
        $sel = $conn->prepare("SELECT MaHP FROM ChiTietDangKy WHERE MaDK = ?");
        $sel->bind_param("i", $madk);
        $sel->execute();
        $selres = $sel->get_result();

        while ($item = $selres->fetch_assoc()) {
            $mahp = $item['MaHP'];
            $upd = $conn->prepare("UPDATE HocPhan SET SoLuong = SoLuong + 1 WHERE MaHP = ?");
            $upd->bind_param("s", $mahp);
            $upd->execute();
            $upd->close();
        }
        $sel->close();

        // Xóa tất cả đăng kí
        $del = $conn->prepare("DELETE FROM ChiTietDangKy WHERE MaDK = ?");
        $del->bind_param("i", $madk);
        $del->execute();
        $del->close();

        $message = "Tất cả học phần của bạn đã được xóa.";
    } else {
        $message = "Bạn chưa đăng kí học phần nào.";
    }
    $stmt->close();

    header("Location: course.php?msg=" . urlencode($message));

    exit;
}

// Lấy danh sách học phần để chọn
$hpList = $conn->query("SELECT * FROM HocPhan");


// Lấy danh sách các học phần mà sinh viên đang đăng kí
$stmt = $conn->prepare("
  SELECT 
    dk.MaDK, dk.NgayDK, hp.MaHP, hp.TenHP, hp.SoTinChi
  FROM ChiTietDangKy ck
  JOIN DangKy dk ON ck.MaDK = dk.MaDK
  JOIN HocPhan hp ON ck.MaHP = hp.MaHP
  WHERE dk.MaSV = ?
  ORDER BY dk.NgayDK DESC, hp.MaHP
");

$stmt->bind_param("s", $masv);
$stmt->execute();

$regList = $stmt->get_result();

$stmt->close();


// Tính tổng số tín chỉ mà sinh viên đang đăng kí
$stmt = $conn->prepare("
  SELECT SUM(SoTinChi) AS total
  FROM ChiTietDangKy ck
  JOIN DangKy dk ON ck.MaDK = dk.MaDK
  JOIN HocPhan hp ON ck.MaHP = hp.MaHP
  WHERE dk.MaSV = ?
");

$stmt->bind_param("s", $masv);
$stmt->execute();

$stmt->bind_result($totalCredits);
$stmt->fetch();
$stmt->close();

if ($totalCredits == NULL) {
    $totalCredits = 0;
}

include('header.php');
?>

<h2>Đăng ký học phần</h2>

<?php if (!empty($_GET['msg'])): ?>
  <p style="color: green;"><?= htmlspecialchars($_GET['msg']) ?> </p>
<?php endif; ?>
<p><strong>Tổng số tín chỉ bạn đang đăng kí: <?= $totalCredits ?> </strong></p>

<form method="POST">
  <label>Chọn học phần:</label>
  <select name="MaHP" required>
    <option value="">-- Chọn --</option>
    <?php while ($hp = $hpList->fetch_assoc()): ?>
      <option value="<?= htmlspecialchars($hp['MaHP']) ?>" <?= $hp['SoLuong']==0 ? 'disabled' : '' ?>>
        <?= htmlspecialchars($hp['TenHP']) ?> 
        (<?= $hp['SoTinChi'] ?> tín chỉ) 
        - Còn <?= $hp['SoLuong'] ?> chỗ
      </option>
    <?php endwhile; ?>
  </select>
  <button type="submit" name="add">Đăng ký</button>
</form>

<hr>

<h2>Các học phần bạn đang đăng ký</h2>

<form method="POST">
    <button name="delete_all" onclick="return confirm('Bạn thật sự muốn xóa tất cả học phần?')">
      Xóa tất cả
    </button>
</form>

<table>
  <thead>
    <tr>
      <th>Mã ĐK</th>
      <th>Ngày ĐK</th>
      <th>Mã HP</th>
      <th>Tên HP</th>
      <th>Số tín chỉ</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $regList->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['MaDK']) ?></td>
        <td><?= htmlspecialchars($row['NgayDK']) ?></td>
        <td><?= htmlspecialchars($row['MaHP']) ?></td>
        <td><?= htmlspecialchars($row['TenHP']) ?></td>
        <td><?= htmlspecialchars($row['SoTinChi']) ?> tín chỉ</td>
        <td>
          <a href="course.php?madk=<?= $row['MaDK'] ?>&mahp=<?= urlencode($row['MaHP']) ?>" 
             onclick="return confirm('Bạn có chắc muốn xóa học phần này?')">
            Xóa
          </a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include('footer.php'); ?>
