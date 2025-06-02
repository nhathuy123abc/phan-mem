<?php include 'app/views/shares/header.php'; ?>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f3f4f6;
  }
  .card {
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    border: none;
    background: #ffffff;
  }
  .card-body {
    padding: 3rem;
  }
  .card-title {
    font-weight: 700;
    color: #6a1b9a;
    font-size: 2rem;
    margin-bottom: 2rem;
  }
  .lead {
    font-size: 1.2rem;
    color: #333;
  }
  .btn-primary {
    background: linear-gradient(45deg, #6a11cb, #2575fc);
    border: none;
    font-weight: 700;
    font-size: 1.1rem;
    border-radius: 14px;
    padding: 0.75rem 2rem;
    transition: background 0.3s ease;
    box-shadow: 0 4px 10px rgba(123, 31, 162, 0.2);
  }
  .btn-primary:hover {
    background: linear-gradient(45deg, #2575fc, #6a11cb);
    box-shadow: 0 6px 18px rgba(37, 117, 252, 0.3);
  }
  .alert-info {
    background-color: #e8f5e9;
    color: #388e3c;
    border-radius: 12px;
    padding: 1.5rem;
    font-size: 1rem;
    font-weight: 600;
  }
  .table th, .table td {
    text-align: center;
    vertical-align: middle;
  }
  .table th {
    background-color: #f3f4f6;
  }
  .table-bordered th, .table-bordered td {
    border: 1px solid #ddd;
  }
  .fa-check-circle {
    color: #4caf50;
  }
  .mt-4 {
    margin-top: 3rem;
  }
  .text-left {
    text-align: left;
  }
  .card-text {
    color: #333;
    font-size: 1.1rem;
  }
  .mb-4 {
    margin-bottom: 2rem;
  }
  .table thead th {
    font-weight: 600;
    color: #6a1b9a;
  }
  .table tbody tr td {
    font-size: 1rem;
    color: #555;
  }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h1 class="card-title mb-4">Đặt Hàng Thành Công!</h1>

                    <?php if ($order && !empty($order)): ?>
                        <div class="alert alert-info text-left mb-4">
                            <h5 class="alert-heading">Thông tin đơn hàng #<?php echo $order[0]->id; ?></h5>
                            <hr>
                            <p class="mb-1"><strong>Ngày đặt:</strong> <?php echo date('d/m/Y H:i', strtotime($order[0]->created_at)); ?></p>
                            <p class="mb-1"><strong>Khách hàng:</strong> <?php echo htmlspecialchars($order[0]->name, ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="mb-1"><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($order[0]->phone, ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="mb-1"><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($order[0]->address, ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $calculated_total = 0;
                                    foreach ($order as $item): 
                                        $itemTotal = $item->price * $item->quantity;
                                        $calculated_total += $itemTotal;
                                    ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($item->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?php echo $item->quantity; ?></td>
                                            <td><?php echo number_format($item->price, 0, ',', '.'); ?> VND</td>
                                            <td><?php echo number_format($itemTotal, 0, ',', '.'); ?> VND</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Tổng cộng:</strong></td>
                                        <td><strong><?php echo number_format($calculated_total, 0, ',', '.'); ?> VND</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php endif; ?>

                    <p class="card-text lead mb-4">
                        Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được xử lý thành công.
                    </p>
                    <p class="card-text mb-4">
                        Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất để xác nhận đơn hàng.
                    </p>
                    <div class="mt-4">
                        <a href="/webbanhang/Product/list" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-shopping-cart mr-2"></i>Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
