<?php include 'app/views/shares/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #eef2f7 0%, #d1d9e6 100%);
    color: #2c3e50;
    margin: 0; padding: 0;
  }

  h1.text-center {
    font-weight: 900;
    font-size: 3rem;
    background: linear-gradient(90deg, #6a11cb, #2575fc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 4px;
    margin-bottom: 50px;
    text-transform: uppercase;
    text-shadow: 1px 1px 6px rgba(101, 32, 194, 0.4);
  }

  a.btn-success {
    background: linear-gradient(145deg, #7928ca, #ff0080);
    border: none;
    font-weight: 700;
    padding: 14px 36px;
    box-shadow:
      0 8px 15px rgba(255, 0, 128, 0.4),
      0 4px 6px rgba(121, 40, 202, 0.4);
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 60px;
    color: white;
    letter-spacing: 1.3px;
    text-decoration: none;
    display: inline-block;
  }

  a.btn-success:hover {
    background: linear-gradient(145deg, #ff0080, #7928ca);
    box-shadow:
      0 12px 30px rgba(255, 0, 128, 0.7),
      0 6px 12px rgba(121, 40, 202, 0.7);
    transform: translateY(-4px) scale(1.05);
    color: white;
    text-decoration: none;
  }

  .container {
    max-width: 1280px;
  }

  .row {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
  }

  .col-md-4.col-lg-3 {
    flex: 0 0 23%;
    max-width: 23%;
    display: flex;
  }

  .card {
    background: #fff;
    border-radius: 20px;
    box-shadow:
      0 15px 25px rgba(101, 32, 194, 0.15),
      0 10px 10px rgba(37, 117, 252, 0.12);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    width: 100%;
    animation: fadeInUp 0.6s ease forwards;
  }

  .card:hover {
    box-shadow:
      0 25px 45px rgba(101, 32, 194, 0.35),
      0 20px 25px rgba(37, 117, 252, 0.28);
    transform: translateY(-15px) scale(1.05);
  }

  .card-img-top {
    height: 200px;
    width: 100%;
    object-fit: cover;
    border-radius: 20px 20px 0 0;
    box-shadow:
      0 10px 20px rgba(37, 117, 252, 0.25);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
  }

  .card:hover .card-img-top {
    transform: scale(1.12) rotate(1deg);
    box-shadow:
      0 20px 40px rgba(37, 117, 252, 0.5);
  }

  .card-body {
    padding: 18px 22px 28px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }

  .card-title a {
    font-weight: 900;
    font-size: 1.3rem;
    color: #6a11cb;
    background: linear-gradient(90deg, #2575fc, #7928ca);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transition: all 0.3s ease;
    letter-spacing: 1px;
    text-decoration: none;
  }

  .card-title a:hover {
    color: #ff0080;
    text-decoration: none;
    filter: drop-shadow(0 0 5px #ff0080);
  }

  .card-text.text-muted {
    font-size: 0.95rem;
    color: #555;
    line-height: 1.4;
    height: 85px;
    overflow: hidden;
    margin-bottom: 15px;
    font-style: italic;
    letter-spacing: 0.4px;
  }

  .card p.text-muted.font-weight-bold {
    font-weight: 800;
    font-size: 1.2rem;
    color: #7928ca;
    margin-bottom: 8px;
  }

  .card p.text-muted:nth-of-type(2) {
    font-size: 0.85rem;
    color: #999;
    margin-bottom: 15px;
    letter-spacing: 0.8px;
  }

  .card-text strong {
    font-weight: 700;
  }

  .card-text span {
    font-weight: 800;
    font-size: 1.1rem;
  }

  .card-text span[style*="red"] {
    color: #ff0033 !important;
    text-shadow: 0 0 6px #ff0033aa;
  }

  .d-flex.justify-content-between.mb-2 a.btn {
    border-radius: 30px;
    font-weight: 700;
    padding: 8px 20px;
    transition: all 0.3s ease;
    letter-spacing: 0.6px;
    text-decoration: none;
    color: white;
    display: inline-block;
    text-align: center;
  }

  .btn-warning {
    background: #f39c12;
    border: none;
    box-shadow: 0 8px 15px #f39c12aa;
  }

  .btn-warning:hover {
    background: #d68910;
    box-shadow: 0 12px 25px #d68910cc;
    transform: translateY(-4px);
  }

  .btn-danger {
    background: #e74c3c;
    border: none;
    box-shadow: 0 8px 15px #e74c3caa;
  }

  .btn-danger:hover {
    background: #c0392b;
    box-shadow: 0 12px 25px #c0392bcc;
    transform: translateY(-4px);
  }

  .btn-primary {
    background: linear-gradient(135deg, #2575fc 0%, #6a11cb 100%);
    border-radius: 60px;
    font-weight: 700;
    padding: 12px 0;
    transition: all 0.35s ease;
    box-shadow:
      0 10px 30px rgba(37, 117, 252, 0.6),
      0 5px 10px rgba(106, 17, 203, 0.6);
    letter-spacing: 1.2px;
    color: white;
    border: none;
    width: 100%;
    display: inline-block;
    text-align: center;
    cursor: pointer;
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
    box-shadow:
      0 18px 40px rgba(106, 17, 203, 0.8),
      0 10px 20px rgba(37, 117, 252, 0.8);
    transform: translateY(-5px) scale(1.08);
    text-decoration: none;
    color: white;
  }

  .btn-secondary {
    background: #bdc3c7;
    border-radius: 60px;
    font-weight: 700;
    padding: 12px 0;
    cursor: not-allowed;
    opacity: 0.65;
    letter-spacing: 1.1px;
    color: #7f8c8d;
    border: none;
    width: 100%;
  }

  /* FLEX để nút sửa xóa luôn đẩy xuống dưới */
  .card-body {
    display: flex;
    flex-direction: column;
  }

  .d-flex.justify-content-between.mb-2 {
    margin-top: auto;
  }

  /* ANIMATION */
  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(25px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* RESPONSIVE */
  @media (max-width: 1200px) {
    .col-md-4.col-lg-3 {
      flex: 0 0 30%;
      max-width: 30%;
    }
  }

  @media (max-width: 768px) {
    .col-md-4.col-lg-3 {
      flex: 0 0 47%;
      max-width: 47%;
    }
  }

  @media (max-width: 480px) {
    .col-md-4.col-lg-3 {
      flex: 0 0 100%;
      max-width: 100%;
    }
  }
</style>

<h1 class="text-center mb-5 text-uppercase">Danh sách sản phẩm</h1>

<div class="text-center mb-5">
  <a href="/webbanhang/Product/add" class="btn btn-success btn-lg shadow">Thêm sản phẩm mới</a>
</div>

<div class="container">
  <div class="row">
    <?php foreach ($products as $product): ?>
      <div class="col-md-4 col-lg-3 mb-4">
        <div class="card">
          <?php if ($product->image): ?>
            <img src="/webbanhang/<?php echo $product->image; ?>" alt="Product Image" class="card-img-top">
          <?php else: ?>
            <img src="https://via.placeholder.com/200x200?text=No+Image" alt="No Image" class="card-img-top">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title">
              <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
              </a>
            </h5>
            <p class="card-text text-muted">
              <?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?>
            </p>
            <p class="text-muted font-weight-bold">
              Giá: <?php echo number_format(htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'), 0, ',', '.'); ?> VND
            </p>
            <p class="text-muted">Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>

            <p class="card-text">
              <strong>Số lượng còn lại:</strong> 
              <span style="color: <?php echo ($product->SoLuong <= 10) ? 'red' : 'black'; ?>;">
                <?php echo htmlspecialchars($product->SoLuong, ENT_QUOTES, 'UTF-8'); ?>
              </span>
            </p>

            <div class="d-flex justify-content-between mb-2">
              <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-sm">Sửa</a>
              <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
            </div>

            <div class="text-center">
              <?php if ($product->SoLuong > 0): ?>
                <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary btn-sm">Thêm vào giỏ hàng</a>
              <?php else: ?>
                <button class="btn btn-secondary btn-sm" disabled>Hết hàng</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
