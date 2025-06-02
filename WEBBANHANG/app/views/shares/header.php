<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            --danger-gradient: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            --warning-gradient: linear-gradient(135deg, #f39c12 0%, #f1c40f 100%);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #2c3e50;
            min-height: 100vh;
        }

        .navbar-custom {
            background: var(--primary-gradient);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1rem;
        }

        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: 600;
        }

        .navbar-brand {
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }

        .nav-link {
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .nav-link i {
            margin-right: 5px;
        }

        .container-main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .product-image {
            max-width: 100px;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        .btn-custom {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: var(--primary-gradient);
        }

        .btn-danger {
            background: var(--danger-gradient);
        }

        .btn-warning {
            background: var(--warning-gradient);
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .table-custom {
            margin-top: 1.5rem;
            border-radius: 10px;
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom thead th {
            background: var(--primary-gradient);
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem;
        }

        .table-custom tbody tr {
            transition: all 0.2s ease;
        }

        .table-custom tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table-custom tbody tr:hover {
            background-color: #f1f3ff;
        }

        .table-custom td {
            vertical-align: middle;
            padding: 1rem;
            border-top: 1px solid #dee2e6;
        }

        .welcome-message {
            font-weight: 600;
            color: white !important;
            display: flex;
            align-items: center;
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            .nav-link {
                padding: 0.5rem;
                font-size: 0.9rem;
            }
            .content-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-box-open"></i> Quản lý sản phẩm
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/">
                            <i class="fas fa-list"></i> Danh sách
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/add">
                            <i class="fas fa-plus-circle"></i> Thêm mới
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php if(isset($_SESSION['username'])): ?>
                            <span class="nav-link welcome-message">
                                <i class="fas fa-user-circle me-1"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </span>
                        <?php else: ?>
                            <a class="nav-link" href="/webbanhang/account/login">
                                <i class="fas fa-sign-in-alt"></i> Đăng nhập
                            </a>
                        <?php endif; ?>
                    </li>
                    <?php if(isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/logout">
                            <i class="fas fa-sign-out-alt"></i> Đăng xuất
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-main">
        <div class="content-card">
            <?php 
            if(isset($view)) {
                include $view; 
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>