<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center mb-4">Giỏ hàng</h1>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php 
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

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

    <?php if (!empty($cart)): ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($cart as $id => $item): 
                        $itemTotal = $item['price'] * $item['quantity'];
                        $total += $itemTotal;
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <?php if ($item['image']): ?>
                                    <img src="/webbanhang/<?php echo $item['image']; ?>" alt="Product Image" class="product-image">
                                <?php else: ?>
                                    <img src="/webbanhang/images/no-image.png" alt="No Image" class="product-image">
                                <?php endif; ?>
                            </td>
                            <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
                            <td>
                                <form action="/webbanhang/Product/updateCart" method="POST" class="form-inline justify-content-center">
                                    <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                    <div class="form-group">
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" class="form-control form-control-sm text-center" style="width: 60px;" min="1" onchange="this.form.submit()">
                                    </div>
                                </form>
                            </td>
                            <td><?php echo number_format($itemTotal, 0, ',', '.'); ?> VND</td>
                            <td>
                                <a href="/webbanhang/Product/removeFromCart/<?php echo $id; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-right"><strong>Tổng cộng:</strong></td>
                        <td colspan="2"><strong><?php echo number_format($total, 0, ',', '.'); ?> VND</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="/webbanhang/Product" class="btn btn-secondary">Tiếp tục mua sắm</a>
            <a href="/webbanhang/Product/checkout" class="btn btn-primary">Thanh Toán</a>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            <h4>Giỏ hàng của bạn đang trống.</h4>
            <a href="/webbanhang/Product" class="btn btn-primary mt-3">Tiếp tục mua sắm</a>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f5f5f5;
    color: #333;
    transition: all 0.3s ease;
  }

  .container {
    max-width: 900px;
    margin: 0 auto;
  }

  .alert {
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .alert-success {
    background-color: #e6f4ea;
    color: #2e7d32;
    border: 1.5px solid #81c784;
  }

  .alert-danger {
    background-color: #fbeaea;
    color: #c62828;
    border: 1.5px solid #ef5350;
  }

  table.table {
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(37, 117, 252, 0.2), 0 4px 12px rgba(106, 17, 203, 0.1);
    transition: all 0.3s ease;
  }

  thead.thead-dark {
    background: linear-gradient(90deg, #6a11cb, #2575fc);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  thead.thead-dark th {
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    padding: 16px 18px;
  }

  tbody tr:hover {
    background-color: #f1f5fe;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
  }

  tbody td {
    vertical-align: middle;
    padding: 12px 18px;
    color: #34495e;
    transition: all 0.3s ease;
  }

  tbody td img {
    border-radius: 10px;
    max-width: 100px;
  }

  .product-image {
    max-width: 120px;
    border-radius: 12px;
    transition: transform 0.3s ease;
  }

  .product-image:hover {
    transform: scale(1.1);
  }

  .btn {
    border-radius: 50px;
    padding: 12px 30px;
    font-weight: 600;
    letter-spacing: 1px;
    box-shadow: 0 8px 24px rgba(37, 117, 252, 0.2), 0 4px 12px rgba(106, 17, 203, 0.15);
    transition: all 0.3s ease;
  }

  .btn-danger {
    background: linear-gradient(145deg, #ff416c, #ff4b2b);
    border: none;
    color: white;
  }

  .btn-danger:hover {
    background: linear-gradient(145deg, #ff4b2b, #ff416c);
    box-shadow: 0 8px 30px rgba(255, 75, 43, 0.8), 0 4px 18px rgba(255, 65, 108, 0.8);
    transform: translateY(-3px);
  }

  .btn-secondary {
    background: #95a5a6;
    color: white;
    border: none;
  }

  .btn-secondary:hover {
    background: #7f8c8d;
    color: white;
  }

  .btn-primary {
    background: linear-gradient(145deg, #6a11cb, #2575fc);
    border: none;
    color: white;
  }

  .btn-primary:hover {
    background: linear-gradient(145deg, #2575fc, #6a11cb);
    box-shadow: 0 8px 30px rgba(37, 117
