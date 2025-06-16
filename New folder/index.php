<?php
include('db.php');

// phân trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 4;
$start = ($page - 1) * $perPage;

// tổng số bản ghi
$total = $conn->query("SELECT COUNT(*) FROM SinhVien")->fetch_row()[0];
$totalPages = ceil($total / $perPage);

$start = (int)$start;
$perPage = (int)$perPage;

// KHÔNG DÙNG prepare với LIMIT
$stmt = $conn->query("SELECT * FROM SinhVien LIMIT $start, $perPage");

include('header.php'); ?>
<h2>Danh sách sinh viên</h2>

<table>
  <thead>
    <tr>
      <th>Mã</th>
      <th>Họ tên</th>
      <th>Phái</th>
      <th>Ngày sinh</th>
      <th>Ngành</th>
      <th>Hình ảnh</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($item = $stmt->fetch_assoc()) { ?>
      <tr>
        <td><?= $item['MaSV'] ?> </td>
        <td><?= $item['HoTen'] ?> </td>
        <td><?= $item['GioiTinh'] ?> </td>
        <td><?= $item['NgaySinh'] ?> </td>
        <td><?= $item['MaNganh'] ?> </td>
        <td><img src="<?= $item['Hinh'] ?>" width="100" alt=""> </td>
        <td>
          <a href='detail.php?id=<?= $item['MaSV'] ?>'>Chi tiết</a> |
          <a href='edit.php?id=<?= $item['MaSV'] ?>'>Sửa</a> |
          <a href='delete.php?id=<?= $item['MaSV'] ?>' onclick='return confirm("Xóa?")'>Xóa</a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<ul class="pagination">
  <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
    <li><a href="?page=<?= $i ?>"><?= $i ?> </a></li>
  <?php endfor ?>
</ul>

<a href='add.php'>Thêm sinh viên</a>

<?php include('footer.php'); ?>
