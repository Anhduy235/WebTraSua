<?php
require_once __DIR__ . "/autoload/autoload.php";
if (!isset($_SESSION['user_id'])) {
    // Set a session variable to indicate that login is required
    $_SESSION['login_required'] = true;
    header("Location: dathang.php"); // Redirect back to the product page
    exit();
}
if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    // Thêm sản phẩm vào giỏ hàng
    $cart_item = $db->fetchOne("cart", "user_id = $user_id AND product_id = $product_id");

    if ($cart_item) {
        // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng
        $new_quantity = $cart_item['soluong'] + 1;

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $conditions = [
            'user_id' => $user_id,
            'product_id' => $product_id
        ];

        if ($db->update("cart", ["soluong" => $new_quantity], $conditions) === 0) {
            die("Error updating cart: " . mysqli_error($db->link));
        }
    } else {
        // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
        if (!$db->insert("cart", ["user_id" => $user_id, "product_id" => $product_id, "soluong" => 1])) {
            die("Error inserting into cart: " . mysqli_error($db->link));
        }
    }
    // Cập nhật giỏ hàng trong phiên
    $_SESSION['cart'] = $db->fetchAll("cart", "user_id = $user_id");
    // Cập nhật tổng số tiền
    $_SESSION['total_amount'] = $db->calculateTotalAmount($db->fetchAll("cart", "user_id = $user_id"));

    // Chuyển hướng về trang sản phẩm hoặc giỏ hàng
    header("Location: dathang.php");
    exit();
}
