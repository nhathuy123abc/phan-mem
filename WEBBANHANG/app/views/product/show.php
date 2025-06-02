<?php include 'app/views/shares/header.php'; ?>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9f9f9;
  }

  .card {
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    border: none;
    background-color: #ffffff;
  }

  .card-header {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
    padding: 1.5rem;
    border-radius: 15px 15px 0 0;
  }

  .card-body {
    padding: 2rem;
  }

  .card-title {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
  }

  .card-text {
    color: #555;
    line-height: 1.6;
    font-size: 1rem;
  }

  .h4 {
    font-size: 1.75rem;
    color: #e74c3c;
  }

  .btn {
    border-radius: 50px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    font-size: 1.1rem;
    transition: background 0.3s ease;
  }

  .btn-success {
    background-color: #28a745;
    border: none;
  }

  .btn-success:hover {
    background-color: #218838;
  }

  .btn-secondary {
    background-color: #6c757d;
    border: none;
  }

  .btn-secondary:hover {
    background-color: #5a6268;
  }

  .badge {
    font-weight: 600;
    padding: 0.5rem 1rem;
  }

  .img-fluid {
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }

  .col-md-6 img {
    width: 100%;
  }

  .mt-4 {
    margin-top: 2rem;
  }

  .alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border-radius: 12px;
    padding: 1.5rem;
  }
</style>

<div class="container mt-4">
  <div class="card shadow-lg">
    <div class="card-header text-center">
      <h2 class="mb-0">Chi tiết sản phẩm</h2>
    </div>
    <div class="card-body">
      <?php if ($product): ?>
        <div class="row">
          <div class="col-md-6">
            <?php if ($product->image): ?>
              <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
            <?php else: ?>
              <img src="/webbanhang/images/no-image.png" class="img-fluid rounded" alt="Không có ảnh">
            <?php endif; ?>
          </div>
          <div class="col-md-6">
            <h3 class="card-title text-dark font-weight-bold">
              <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
            </h3>
            <p class="card-text">
              <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
            </p>
            <p class="text-danger font-weight-bold h4">
              💰 <?php echo number_format($product->price, 0, ',', '.'); ?> VND
            </p>
            <p><strong>Danh mục:</strong>
              <span class="badge bg-info text-white">
                <?php echo !empty($product->category_name) ? htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') : 'Chưa có danh mục'; ?>
              </span>
            </p>
            <div class="mt-4">
              <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-success px-4">➕ Thêm vào giỏ hàng</a>
              <a href="/webbanhang/Product/list" class="btn btn-secondary px-4 ml-2">Quay lại danh sách</a>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="alert alert-danger text-center">
          <h4>Không tìm thấy sản phẩm!</h4>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
