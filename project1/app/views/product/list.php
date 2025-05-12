<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm | Danh sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --danger-color: #f72585;
        }
        .card-product {
            transition: all 0.3s ease;
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .card-product:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .price-tag {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        .action-btns .btn {
            min-width: 80px;
        }
        .page-header {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .empty-state {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
        }
        .search-box {
            max-width: 400px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h2 fw-bold text-primary">
                    <i class="bi bi-box-seam me-2"></i>Quản lý sản phẩm
                </h1>
                <a href="/project1/Product/add" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Thêm mới
                </a>
            </div>
        </div>

        <!-- Thêm ô tìm kiếm -->
        <div class="search-box">
            <form method="GET" action="/project1/Product/list" class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm sản phẩm..." 
                       value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="bi bi-search"></i> Tìm
                </button>
                <?php if(isset($_GET['search']) && !empty($_GET['search'])): ?>
                <a href="/project1/Product/list" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Xóa tìm kiếm
                </a>
                <?php endif; ?>
            </form>
        </div>

        <?php if(count($products) > 0): ?>
        <div class="row g-4">
            <?php foreach ($products as $product): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card card-product h-100">
                    <div class="card-body">
                        <h3 class="h5 card-title mb-3"><?= htmlspecialchars($product->getName()) ?></h3>
                        <p class="card-text text-muted small mb-3"><?= htmlspecialchars($product->getDescription()) ?></p>
                        <p class="price-tag mb-0"><?= number_format($product->getPrice(), 0, ',', '.') ?> ₫</p>
                    </div>
                    <div class="card-footer bg-white border-0 pt-0">
                        <div class="d-flex action-btns">
                            <a href="/project1/Product/edit/<?= $product->getID() ?>" 
                               class="btn btn-sm btn-outline-primary me-2">
                                <i class="bi bi-pencil-square me-1"></i>Sửa
                            </a>
                            <a href="/project1/Product/delete/<?= $product->getID() ?>" 
                               class="btn btn-sm btn-outline-danger" 
                               onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?')">
                                <i class="bi bi-trash me-1"></i>Xóa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-box text-muted" style="font-size: 3rem;"></i>
            </div>
            <h3 class="h5 mt-3">
                <?= isset($_GET['search']) ? 'Không tìm thấy sản phẩm phù hợp' : 'Không có sản phẩm nào' ?>
            </h3>
            <p class="text-muted">
                <?= isset($_GET['search']) ? 'Hãy thử với từ khóa khác' : 'Hãy thêm sản phẩm mới để bắt đầu' ?>
            </p>
            <a href="/project1/Product/add" class="btn btn-primary mt-2">
                <i class="bi bi-plus-circle me-1"></i>Thêm sản phẩm
            </a>
            <?php if(isset($_GET['search'])): ?>
            <a href="/project1/Product/list" class="btn btn-outline-secondary mt-2 ms-2">
                <i class="bi bi-arrow-left me-1"></i>Xem tất cả
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>