<?php include 'app/views/shares/header.php'; ?>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f5f7fa;
    }
    .card {
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .card-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        font-weight: 700;
        font-size: 1.8rem;
        letter-spacing: 1px;
    }
    .form-control:focus {
        border-color: #6a11cb;
        box-shadow: 0 0 8px rgba(106, 17, 203, 0.4);
    }
    .btn-primary {
        background: #6a11cb;
        border: none;
        transition: background 0.3s ease;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .btn-primary:hover {
        background: #2575fc;
    }
    .btn-secondary {
        background: #888;
        border: none;
        transition: background 0.3s ease;
    }
    .btn-secondary:hover {
        background: #555;
    }
    label {
        font-weight: 600;
        color: #333;
    }
    .table thead {
        background-color: #6a11cb;
        color: #fff;
    }
    .alert-danger {
        border-radius: 8px;
        animation: fadeIn 0.5s ease;
    }
    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }
</style>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-center text-white">
                    Thanh Toán
                </div>
                <div class="card-body px-5 py-4">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/webbanhang/Product/processCheckout" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label for="name">Họ và tên:</label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập họ và tên
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="tel" id="phone" name="phone" class="form-control form-control-lg" pattern="[0-9]{10}" required>
                            <div class="invalid-feedback">
                                Vui lòng nhập số điện thoại hợp lệ (10 số)
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Địa chỉ giao hàng:</label>
                            <textarea id="address" name="address" class="form-control form-control-lg" rows="3" required></textarea>
                            <div class="invalid-feedback">
                                Vui lòng nhập địa chỉ giao hàng
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email (tùy chọn):</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Nhập địa chỉ email">
                        </div>

                        <div class="form-group">
                            <label for="note">Ghi chú (tùy chọn):</label>
                            <textarea id="note" name="note" class="form-control form-control-lg" rows="3" placeholder="Nhập ghi chú cho đơn hàng"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Tổng quan đơn hàng:</label>
                            <div class="table-responsive rounded">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $total = 0;
                                        foreach ($_SESSION['cart'] as $item): 
                                            $itemTotal = $item['price'] * $item['quantity'];
                                            $total += $itemTotal;
                                        ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo $item['quantity']; ?></td>
                                                <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
                                                <td><?php echo number_format($itemTotal, 0, ',', '.'); ?> VND</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right font-weight-bold">Tổng cộng:</td>
                                            <td class="font-weight-bold"><?php echo number_format($total, 0, ',', '.'); ?> VND</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Xác nhận đặt hàng</button>
                            <a href="/webbanhang/Product/cart" class="btn btn-secondary btn-lg px-5 ml-2">Quay lại giỏ hàng</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation remains the same
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

<?php include 'app/views/shares/footer.php'; ?>
