<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once('app/models/OrderModel.php');

class ProductController {
private $productModel;
private $orderModel;
private $db;
public function __construct() {
$this->db = (new Database())->getConnection();
$this->productModel = new ProductModel($this->db);
$this->orderModel = new OrderModel($this->db);
}
public function index() {
$products = $this->productModel->getProducts();
include 'app/views/product/list.php';
}
public function show($id) {
$product = $this->productModel->getProductById($id);
if ($product) {
include 'app/views/product/show.php';
} else {
echo "Không thấy sản phẩm.";
}
}
public function add() {
$categories = (new CategoryModel($this->db))->getCategories();
include_once 'app/views/product/add.php';
}
public function save() {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';
$category_id = $_POST['category_id'] ?? null;
$soLuong = $_POST['SoLuong'] ?? 0;
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
$image = $this->uploadImage($_FILES['image']);
} else {
$image = "";
}
$result = $this->productModel->addProduct($name, $description, $price,
$category_id, $image, $soLuong);
if (is_array($result)) {
$errors = $result;
$categories = (new CategoryModel($this->db))->getCategories();
include 'app/views/product/add.php';
} else {
header('Location: /webbanhang/Product');
}
}
}
public function edit($id) {
$product = $this->productModel->getProductById($id);
$categories = (new CategoryModel($this->db))->getCategories();
if ($product) {
include 'app/views/product/edit.php';
} else {
echo "Không thấy sản phẩm.";
}
}
public function update() {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];
$soLuong = $_POST['SoLuong'] ?? 0;
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
$image = $this->uploadImage($_FILES['image']);
} else {
$image = $_POST['existing_image'];
}
$edit = $this->productModel->updateProduct($id, $name, $description,
$price, $category_id, $image, $soLuong);
if ($edit) {
header('Location: /webbanhang/Product');
} else {
echo "Đã xảy ra lỗi khi lưu sản phẩm.";
}
}
}
public function delete($id) {
    if ($this->productModel->deleteProduct($id)) {
    header('Location: /webbanhang/Product');
    } else {
    echo "Đã xảy ra lỗi khi xóa sản phẩm.";
    }
    }
    private function uploadImage($file) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
    throw new Exception("File không phải là hình ảnh.");
    }
    if ($file["size"] > 10 * 1024 * 1024) {
    throw new Exception("Hình ảnh có kích thước quá lớn.");
    }
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
    throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF.");
    }
    if (!move_uploaded_file($file["tmp_name"], $target_file)) {
    throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh.");
    }
    return $target_file;
    }
    public function addToCart($id) {
        if (!isset($_SESSION)) {
            session_start();
        }
        
        $product = $this->productModel->getProductById($id);
        if (!$product) {    
            $_SESSION['error'] = "Không tìm thấy sản phẩm.";
            header('Location: /webbanhang/Product/list');
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        $_SESSION['success'] = "Đã thêm sản phẩm vào giỏ hàng.";
        header('Location: /webbanhang/Product/cart');
        exit();
    }
    public function list() {
        $products = $this->productModel->getProducts();
        require_once 'app/views/product/list.php';
    }
    public function removeFromCart($id) {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
            $_SESSION['success'] = "Đã xóa sản phẩm khỏi giỏ hàng.";
        } else {
            $_SESSION['error'] = "Không tìm thấy sản phẩm trong giỏ hàng.";
        }

        header('Location: /webbanhang/Product/cart');
        exit();
    }
    public function cart() {
        if (!isset($_SESSION)) {
            session_start();
        }
        
        $cart = $_SESSION['cart'] ?? [];
        include 'app/views/product/Cart.php';
    }
    public function updateCart() {
        if (!isset($_SESSION)) {
            session_start();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? null;
    
            if ($product_id !== null && $quantity !== null && is_numeric($quantity) && $quantity > 0) {
                $product = $this->productModel->getProductById($product_id);
    
                if ($product) {
                    if ($quantity <= $product->SoLuong) {
                        $_SESSION['cart'][$product_id]['quantity'] = (int) $quantity;
                        $_SESSION['success'] = "Cập nhật số lượng sản phẩm thành công!";
                    } else {
                        $_SESSION['error'] = "Số lượng sản phẩm trong kho không đủ. Chỉ còn " . $product->SoLuong . " sản phẩm.";
                    }
                } else {
                    $_SESSION['error'] = "Không tìm thấy sản phẩm.";
                }
            } else {
                $_SESSION['error'] = "Dữ liệu cập nhật không hợp lệ.";
            }
        }
    
        header('Location: /webbanhang/Product/cart');
        exit();
    }
    public function checkout() {
        if (!isset($_SESSION)) {
            session_start();
        }
        
        if (empty($_SESSION['cart'])) {
            $_SESSION['error'] = "Giỏ hàng của bạn đang trống.";
            header('Location: /webbanhang/Product/cart');
            exit();
        }
        
        include 'app/views/product/Checkout.php';
    }
    public function processCheckout() {
        if (!isset($_SESSION)) {
            session_start();
        }
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /webbanhang/Product/cart');
            exit();
        }
        
        if (empty($_SESSION['cart'])) {
            $_SESSION['error'] = "Giỏ hàng của bạn đang trống.";
            header('Location: /webbanhang/Product/cart');
            exit();
        }
        
        // Lấy thông tin từ form
        $name = $_POST['name'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $email = $_POST['email'] ?? '';
        $note = $_POST['note'] ?? '';
        
        // Kiểm tra thông tin
        if (empty($name) || empty($phone) || empty($address)) {
            $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin.";
            header('Location: /webbanhang/Product/checkout');
            exit();
        }

        try {
            // Tính tổng tiền
            $total_amount = 0;
            foreach ($_SESSION['cart'] as $item) {
                $total_amount += $item['price'] * $item['quantity'];
            }

            // Tạo đơn hàng
            $order_id = $this->orderModel->createOrder($name, $phone, $address, $total_amount, $email, $note);
            
            // Cập nhật số lượng tồn kho
            foreach ($_SESSION['cart'] as $product_id => $item) {
                $product = $this->productModel->getProductById($product_id);
                if ($product) {
                    $newQuantity = $product->SoLuong - $item['quantity'];
                    // Đảm bảo số lượng không âm
                    if ($newQuantity < 0) {
                        $newQuantity = 0;
                    }
                    $this->productModel->updateProductQuantity($product_id, $newQuantity);
                }
            }
            
            // Lưu order_id vào session để hiển thị trong trang xác nhận
            $_SESSION['last_order_id'] = $order_id;
            
            // Xóa giỏ hàng sau khi thanh toán thành công
            unset($_SESSION['cart']);
            
            // Chuyển hướng đến trang xác nhận đơn hàng
            header('Location: /webbanhang/Product/orderConfirmation');
            exit();
            
        } catch (Exception $e) {
            $_SESSION['error'] = "Có lỗi xảy ra khi xử lý đơn hàng: " . $e->getMessage();
            header('Location: /webbanhang/Product/checkout');
            exit();
        }
    }
    public function orderConfirmation() {
        if (!isset($_SESSION)) {
            session_start();
        }

        $order_id = $_SESSION['last_order_id'] ?? null;
        $order = null;
        
        if ($order_id) {
            $order = $this->orderModel->getOrderById($order_id);
            unset($_SESSION['last_order_id']); // Xóa order_id khỏi session
        }
        
        include 'app/views/product/orderConfirmation.php';
    }
}
?>