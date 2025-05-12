<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm | Thêm mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .form-container {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }
        .form-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .form-footer {
            border-top: 1px solid #eee;
            padding-top: 20px;
            margin-top: 25px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="form-container">
            <div class="form-header">
                <h1 class="h3 fw-bold">
                    <i class="bi bi-plus-circle text-primary me-2"></i>Thêm sản phẩm mới
                </h1>
                <p class="text-muted mb-0">Nhập thông tin sản phẩm vào form bên dưới</p>
            </div>

            <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <form method="POST" action="/project1/Product/add" onsubmit="return validateForm()">
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg" id="name" name="name" required>
                    <div class="form-text">Tên sản phẩm phải từ 10-100 ký tự</div>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-bold">Mô tả sản phẩm <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="price" class="form-label fw-bold">Giá bán <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" class="form-control form-control-lg" id="price" name="price" step="1000" min="0" required>
                        <span class="input-group-text">₫</span>
                    </div>
                    <div class="form-text">Nhập giá bán lớn hơn 0</div>
                </div>

                <div class="form-footer d-flex justify-content-between">
                    <a href="/project1/Product/list" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-1"></i>Lưu sản phẩm
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function validateForm() {
        const name = document.getElementById('name').value;
        const price = document.getElementById('price').value;
        const errors = [];
        
        if (name.length < 10 || name.length > 100) {
            errors.push('Tên sản phẩm phải có từ 10 đến 100 ký tự');
        }
        
        if (price <= 0 || isNaN(price)) {
            errors.push('Giá bán phải là số dương lớn hơn 0');
        }
        
        if (errors.length > 0) {
            alert('Lỗi:\n' + errors.join('\n'));
            return false;
        }
        
        return true;
    }
    </script>
</body>
</html>