<?php
class OrderModel {
    private $conn;
    private $table_name = "orders";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createOrder($name, $phone, $address, $total_amount, $email, $note) {
        try {
            $this->conn->beginTransaction();

            // Insert into orders table
            $query = "INSERT INTO " . $this->table_name . " 
                     (name, phone, address, created_at, Gmail, GhiChu) 
                     VALUES (:name, :phone, :address, NOW(), :email, :note)";
            
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':note', $note);
            
            $stmt->execute();
            
            // Get the last inserted order ID
            $order_id = $this->conn->lastInsertId();
            
            // Insert order details
            foreach ($_SESSION['cart'] as $product_id => $item) {
                $query = "INSERT INTO order_details 
                         (order_id, product_id, quantity, price) 
                         VALUES (:order_id, :product_id, :quantity, :price)";
                
                $stmt = $this->conn->prepare($query);
                
                $stmt->bindParam(':order_id', $order_id);
                $stmt->bindParam(':product_id', $product_id);
                $stmt->bindParam(':quantity', $item['quantity']);
                $stmt->bindParam(':price', $item['price']);
                
                $stmt->execute();
            }
            
            $this->conn->commit();
            return $order_id;
            
        } catch (Exception $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function getOrderById($id) {
        $query = "SELECT o.*, od.product_id, od.quantity, od.price, p.name as product_name 
                 FROM " . $this->table_name . " o 
                 JOIN order_details od ON o.id = od.order_id 
                 JOIN product p ON od.product_id = p.id 
                 WHERE o.id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?> 