<?php include 'app/views/shares/header.php'; ?>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f7f9fc;
  }
  h1 {
    color: #5a189a;
    font-weight: 700;
    margin-bottom: 2rem;
  }
  .card {
    border-radius: 20px;
    box-shadow: 0 12px 30px rgba(90, 24, 154, 0.15);
    border: none;
  }
  .card-body {
    padding: 2.5rem 3rem;
  }
  label {
    font-weight: 600;
    color: #4a148c;
  }
  .form-control, .form-control-lg {
    border-radius: 12px;
    border: 1.5px solid #d1c4e9;
    transition: all 0.3s ease;
  }
  .form-control:focus, .form-control-lg:focus {
    border-color: #7b1fa2;
    box-shadow: 0 0 8px rgba(123, 31, 162, 0.3);
  }
  .form-control-file {
    border-radius: 12px;
  }
  button.btn-primary {
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    border: none;
    font-weight: 700;
    font-size: 1.2rem;
    border-radius: 14px;
    padding: 0.75rem;
    transition: background 0.4s ease;
    box-shadow: 0 6px 15px rgba(106, 17, 203, 0.4);
  }
  button.btn-primary:hover {
    background: linear-gradient(45deg, #2575fc, #6a11cb);
    box-shadow: 0 8px 20px rgba(37, 117, 252, 0.5);
  }
  button.btn-secondary {
    background: #9c27b0;
    border: none;
    font-weight: 600;
    border-radius: 14px;
    padding: 0.7rem 1.5rem;
    color: white;
    transition: background 0.3s ease;
  }
  button.btn-secondary:hover {
    background: #6a1b9a;
    color: #fff;
  }
  #image-preview-container {
    margin-top: 15px;
    text-align: center;
  }
  #image-preview {
    max-width: 300px;
    max-height: 200px;
    border-radius: 15px;
    border: 3px solid #7b1fa2;
    object-fit: cover;
    box-shadow: 0 6px 18px rgba(123, 31, 162, 0.3);
    transition: all 0.3s ease;
  }
  #image-preview:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 30px rgba(123, 31, 162, 0.5);
  }
  .alert-danger {
    border-radius: 12px;
    background-color: #fce4ec;
    color: #880e4f;
    border: 1.5px solid #f48fb1;
    font-weight: 600;
  }
</style>

<h1 class="text-center">Sửa sản phẩm</h1>

<?php if (!empty($errors)): ?>
  <div class="alert alert-danger mx-auto col-md-8 col-lg-6">
    <ul class="mb-0">
      <?php foreach ($errors as $error): ?>
        <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="POST" action="/webbanhang/Product/update" enctype="multipart/form-data" onsubmit="return validateForm();">
  <input type="hidden" name="id" value="<?php echo $product->id; ?>">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <div class="card shadow-lg border-light rounded">
          <div class="card-body">

            <div class="form-group">
              <label for="name">Tên sản phẩm:</label>
              <input type="text" id="name" name="name" class="form-control form-control-lg"
                value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group">
              <label for="description">Mô tả:</label>
              <textarea id="description" name="description" class="form-control form-control-lg" rows="4"
                required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" class="form-control form-control-lg" step="0.01"
                  value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="SoLuong">Số lượng:</label>
                <input type="number" id="SoLuong" name="SoLuong" class="form-control form-control-lg" min="0"
                  value="<?php echo htmlspecialchars($product->SoLuong, ENT_QUOTES, 'UTF-8'); ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label for="category_id">Danh mục:</label>
              <select id="category_id" name="category_id" class="form-control form-control-lg" required>
                <?php foreach ($categories as $category): ?>
                  <option value="<?php echo $category->id; ?>" <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="image">Hình ảnh:</label>
              <input type="file" id="image" name="image" class="form-control-file" onchange="previewImage(event)">
              <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>">
              <div id="image-preview-container">
                <?php if ($product->image): ?>
                  <img id="image-preview" src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" alt="Ảnh sản phẩm">
                <?php else: ?>
                  <img id="image-preview" src="" alt="Preview Image" style="display:none;">
                <?php endif; ?>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg mt-4">Lưu thay đổi</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<div class="text-center mt-4">
  <a href="/webbanhang/Product/list" class="btn btn-secondary btn-lg">Quay lại danh sách sản phẩm</a>
</div>

<script>
  function previewImage(event) {
    const preview = document.getElementById('image-preview');
    const file = event.target.files[0];
    if (file) {
      preview.src = URL.createObjectURL(file);
      preview.style.display = 'block';
    } else {
      preview.src = '';
      preview.style.display = 'none';
    }
  }

  // Bạn có thể thêm validateForm nếu muốn custom validation
  function validateForm() {
    return true; // tạm thời bỏ qua
  }
</script>

<?php include 'app/views/shares/footer.php'; ?>
