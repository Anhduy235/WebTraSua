<?php
require_once __DIR__ . "/../../autoload/autoload.php";

// Kiểm tra xem có ID được truyền vào không
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Chuyển đổi ID thành số nguyên

    // Kiểm tra xem bản ghi có tồn tại không
    $payment = $db->fetchOne("payments", "id = $id");
    if ($payment) {
        // Thực hiện xóa bản ghi
        $db->delete("payments", $id);

        // Thông báo thành công
        $_SESSION['success'] = "Xóa đơn hàng thành công!";
    } else {
        // Thông báo lỗi nếu không tìm thấy bản ghi
        $_SESSION['error'] = "Đơn hàng không tồn tại!";
    }
} else {
    $_SESSION['error'] = "ID không hợp lệ!";
}

// Chuyển hướng về trang danh sách thanh toán
header("Location: index.php");
exit();
