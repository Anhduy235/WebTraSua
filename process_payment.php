<?php

require_once __DIR__ . "/autoload/autoload.php";

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: dathang.php"); // Chuyển hướng nếu chưa đăng nhập
    exit();
}

// Kiểm tra giỏ hàng có tồn tại không
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Giỏ hàng trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán.");
}

// Lấy thông tin từ biểu mẫu
$user_id = $_SESSION['user_id'];
$total_price = floatval($_POST['total_price']);
$quantity = intval($_POST['quantity']);
$buyer_name = mysqli_real_escape_string($db->link, $_POST['buyer_name']);
$buyer_email = mysqli_real_escape_string($db->link, $_POST['buyer_email']);
$buyer_phone = mysqli_real_escape_string($db->link, $_POST['buyer_phone']);
$buyer_address = mysqli_real_escape_string($db->link, $_POST['buyer_address']);

// Lấy thông tin sản phẩm từ giỏ hàng
$product_id = $_SESSION['cart'][0]['product_id']; // Giả định bạn chỉ có một sản phẩm trong giỏ hàng
$product = $db->fetchOne("product", "id = " . intval($product_id));

if ($product) {
    $product_name = mysqli_real_escape_string($db->link, $product['name']); // Lấy tên sản phẩm
} else {
    die("Sản phẩm không tồn tại.");
}

// Thêm thông tin thanh toán vào cơ sở dữ liệu
$payment_data = [
    'user_id' => $user_id,
    'product_id' => $product_id,
    'product_name' => $product_name,
    'quantity' => $quantity,
    'total_price' => $total_price,
    'buyer_name' => $buyer_name,
    'buyer_email' => $buyer_email,
    'buyer_phone' => $buyer_phone,
    'buyer_address' => $buyer_address
];

if ($db->insert("payments", $payment_data)) {
    // Xóa giỏ hàng sau khi thanh toán thành công
    $db->deleteCart("cart", "user_id = $user_id");
    $_SESSION['total_amount'] = 0; // Đặt lại tổng số tiền
    header("Location: success.php"); // Chuyển hướng đến trang thành công
    exit();
} else {
    die("Error processing payment: " . mysqli_error($db->link));
}
