<?php
session_start();
require_once __DIR__ . "/autoload/autoload.php";

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Lấy thông tin sản phẩm trong giỏ hàng
        $cart_item = $db->fetchOne("cart", "user_id = $user_id AND product_id = $product_id");

        if ($cart_item) {
            // Nếu sản phẩm tồn tại trong giỏ hàng, giảm số lượng
            $new_quantity = intval($cart_item['soluong']) - 1; // Giảm số lượng đi 1

            if ($new_quantity > 0) {
                // Cập nhật số lượng sản phẩm trong giỏ hàng
                $data = ['soluong' => $new_quantity];
                $conditions = ['user_id' => $user_id, 'product_id' => $product_id];
                $db->update("cart", $data, $conditions);
                $_SESSION['message'] = "Số lượng sản phẩm đã giảm.";
            } else {
                // Nếu số lượng bằng 0, xóa sản phẩm khỏi giỏ hàng
                $db->deleteCart("cart", "user_id = $user_id AND product_id = $product_id");
                $_SESSION['message'] = "Sản phẩm đã được xóa khỏi giỏ hàng.";
            }
        } else {
            $_SESSION['message'] = "Sản phẩm không tồn tại trong giỏ hàng.";
        }
    } else {
        $_SESSION['message'] = "Bạn cần đăng nhập để xóa sản phẩm.";
    }
} else {
    $_SESSION['message'] = "ID sản phẩm không hợp lệ.";
}

// Cập nhật tổng số tiền sau khi xóa
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $_SESSION['total_amount'] = $db->calculateTotalAmount($db->fetchAll("cart", "user_id = $user_id"));
}

// Chuyển hướng về trang giỏ hàng
header("Location: dathang.php");
exit();
