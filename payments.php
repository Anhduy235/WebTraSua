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

// Lấy tổng số tiền từ giỏ hàng
$total_amount = $_SESSION['total_amount'];

$product = $db->fetchAll('product');
require_once __DIR__ . "/layouts/header.php";
?>


<style>
    body {
        background-color: #f8f9fa;
        /* Màu nền nhẹ nhàng */
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 10px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: background-color 0.3s, border-color 0.3s, transform 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-2px);
        /* Hiệu ứng nhấc nút */
    }

    .form-group {
        display: flex;
        align-items: center;
        /* Căn giữa theo chiều dọc */
        margin-bottom: 1rem;
        /* Khoảng cách giữa các nhóm */
    }

    .form-group label {
        margin-left: -50px;
        /* Khoảng cách giữa label và input */
        width: 150px;
        /* Chiều rộng cố định cho label */
        font-weight: bold;
        /* Làm cho label nổi bật */
    }

    .form-text {
        font-size: 0.9rem;
        /* Kích thước chữ nhỏ hơn cho hướng dẫn */
        color: #6c757d;
        /* Màu chữ nhạt hơn */
    }

    .h1 {
        margin: auto;
    }
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Thanh Toán</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="process_payment.php" method="POST">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="form-group">
                            <label for="buyer_name" class="mb-0">Họ và Tên:</label>
                            <input type="text" name="buyer_name" id="buyer_name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="buyer_email" class="mb-0">Email:</label>
                            <input type="email" name="buyer_email" id="buyer_email" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="buyer_phone" class="mb-0">Số Điện Thoại:</label>
                            <input type="text" name="buyer_phone" id="buyer_phone" required class="form-control" pattern="[0-9]{10,12}" title="Số điện thoại phải từ 10 đến 12 chữ số">
                        </div>
                        <div class="form-group">
                            <label for="buyer_address" class="mb-0">Địa Chỉ:</label>
                            <input type="text" name="buyer_address" id="buyer_address" required class="form-control">
                        </div>
                        <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($total_amount); ?>">
                        <input type="hidden" name="quantity" value="<?php echo count($_SESSION['cart']); ?>">
                        <button type="submit" class="btn btn-primary btn-block">Thanh Toán</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="/public/user/js/bootstrap.bundle.min.js"></script> <!-- Đường dẫn đến file JS Bootstrap -->
<?php
require_once __DIR__ . "/layouts/footer.php";
?>