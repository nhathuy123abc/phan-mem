<?php include 'app/views/shares/header.php'; ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
    color: #34495e;
    margin: 0; padding: 0;
  }

  h1.text-center {
    font-weight: 900;
    font-size: 2.8rem;
    background: linear-gradient(90deg, #6a11cb, #2575fc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    letter-spacing: 3px;
    margin-bottom: 40px;
    text-transform: uppercase;
    text-shadow: 1px 1px 6px rgba(101, 32, 194, 0.4);
  }

  .card {
    border-radius: 18px;
    box-shadow:
      0 16px 28px rgba(101, 32, 194, 0.12),
      0 8px 14px rgba(37, 117, 252, 0.12);
    background: #fff;
    padding: 30px 35px;
    transition: box-shadow 0.3s ease;
  }

  .card:hover {
    box-shadow:
      0 24px 48px rgba(101, 32, 194, 0.24),
      0 12px 24px rgba(37, 117, 252, 0.24);
  }

  label {
    font-weight: 700;
    font-size: 1rem;
    color: #4a4a4a;
    margin-bottom: 8px;
    display: inline-block;
  }

  input[type="text"],
  input[type="number"],
  select,
  textarea {
    width: 100%;
    padding: 12px 16px;
    border-radius: 12px;
    border: 1.8px solid #d1d9e6;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    color: #34495e;
    box-shadow: inset 0 2px 6px rgba(0,0,0,0.06);
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    resize: vertical;
  }

  input[type="text"]:focus,
  input[type="number"]:focus,
  select:focus,
  textarea:focus {
    outline: none;
    border-color: #6a11cb;
    box-shadow: 0 0 8px 0 rgba(106, 17, 203, 0.4);
    background-color: #faf9ff;
  }

  textarea {
    min-height: 100px;
  }

  input.form-control-file {
    padding: 8px 0;
  }

  #image-preview {
    max-height: 180px;
    max-width: 100%;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(37, 117, 252, 0.2);
    object-fit: cover;
  }

  button.btn-success {
    width: 100%;
    padding: 14px 0;
    border-radius: 50px;
    background: linear-gradient(145deg, #7928ca, #ff0080);
    border: none;
    font-weight: 700;
    font-size: 1.15rem;
    color: #fff;
    letter-spacing: 1.3px;
    box-shadow:
      0 8px 25px rgba(255, 0, 128, 0.6),
      0 4px 12px rgba(121, 40, 202, 0.5);
    cursor: pointer;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
  }

  button.btn-success:hover {
    background: linear-gradient(145deg, #ff0080, #7928ca);
    box-shadow:
      0 12px 38px rgba(255, 0, 128, 0.9),
      0 6px 20px rgba(121, 40, 202, 0.9);
    transform: translateY(-4px) scale(1.05);
  }

  .alert-danger {
    max-width: 650px;
    margin: 0 auto 30px;
    border-radius: 15px;
    background-color: #fdecea;
    color: #d93025;
    border: 1px solid #f5c6cb;
    box-shadow: 0 4px 12px rgba(217, 48, 37, 0.3);
    font-weight: 600;
  }

  .alert-danger ul {
    margin-bottom: 0;
  }

  .text-center.mt-4 a.btn-secondary {
    display: inline-block;
    padding: 12px 32px;
    border-radius: 40px;
    background: #95a5a6;
    border: none;
    color: white;
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 1.1px;
    text-decoration: none;
    transition: background-color 0.3s ease;
  }

  .text-center.mt-4 a.btn-secondary:hover {
    background: #7f8c8d;
    text-decoration: none;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .card {
      padding: 25px 20px;
    }
  }
</style>

<h1 class="text-center mb-5 text-uppercase">Thêm sản phẩm mới</h1>

<?php if (!empty($errors)): ?>
  <div class="alert alert-danger fade show" role="alert">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="POST" action="/webbanhang/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card">
          <div class="card-body">
            <!-- Tên sản phẩm -->
            <div class="form-group mb-4">
              <label for="name">Tên sản phẩm:</label>
              <input type="text" id="name" name="name" placeholder="Nhập tên sản phẩm" required>
            </div>

            <!-- Mô tả -->
            <div class="form-group mb-4">
              <label for="description">Mô tả:</label>
              <textarea id="description" name="description" placeholder="Nhập mô tả sản phẩm" required></textarea>
            </div>

            <!-- Giá -->
            <div class="form-group mb-4">
              <label for="price">Giá:</label>
              <input type="number" id="price" name="price" step="0.01" placeholder="Nhập giá sản phẩm" required>
            </div>

            <!-- Số lượng -->
            <div class="form-group mb-4">
              <label for="SoLuong">Số lượng:</label>
              <input type="number" id="SoLuong" name="SoLuong" placeholder="Nhập số lượng sản phẩm trong kho" required min="0">
            </div>

            <!-- Danh mục -->
            <div class="form-group mb-4">
              <label for="category_id">Danh mục:</label>
              <select id="category_id" name="category_id" required>
                <option value="" disabled selected>Chọn danh mục</option>
                <?php foreach ($categories as $category): ?>
                  <option value="<?php echo $category->id; ?>">
                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <!-- Hình ảnh -->
            <div class="form-group mb-3">
              <label for="image">Hình ảnh:</label>
              <input type="file" id="image" name="image" onchange="previewImage(event)" accept="image/*">
              <div class="mt-3" id="image-preview-container" style="display: none; text-align:center;">
                <img id="image-preview" src="" alt="Preview Image" class="img-fluid rounded">
              </div>
            </div>

            <button type="submit" class="btn btn-success mt-4">Thêm sản phẩm</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- Quay lại danh sách -->
<div class="text-center mt-4">
  <a href="/webbanhang/Product/list" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
</div>

<script>
  function previewImage(event) {
    const imagePreview = document.getElementById('image-preview');
    const imagePreviewContainer = document.getElementById('image-preview-container');
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreviewContainer.style.display = 'block';
      };
      reader.readAsDataURL(file);
    } else {
      imagePreviewContainer.style.display = 'none';
      imagePreview.src = '';
    }
  }

  // Bạn có thể thêm validateForm() nếu muốn validate thêm trước khi submit
</script>

<?php include 'app/views/shares/footer.php'; ?>
