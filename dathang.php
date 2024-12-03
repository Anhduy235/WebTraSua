<?php
require_once __DIR__ . "/autoload/autoload.php";

// Lấy danh sách danh mục
$category = $db->fetchAll("category");

// Lấy danh sách sản phẩm
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($category_id > 0) {
    // Lọc sản phẩm theo category_id và từ khóa tìm kiếm
    $product = $db->fetchAll("product", "category_id = $category_id" . ($search ? " AND name LIKE '%" . $db->escape($search) . "%'" : ""));
} else {
    // Lấy tất cả sản phẩm nếu không có danh mục, kèm theo từ khóa tìm kiếm
    $product = $db->fetchAll("product", $search ? "name LIKE '%" . $db->escape($search) . "%'" : "");
}

// Lấy giỏ hàng từ cơ sở dữ liệu
$cart = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $cart = $db->fetchAll("cart", "user_id = $user_id");

    // Kiểm tra xem $cart có phải là mảng không
    if (!is_array($cart)) {
        $cart = []; // Đặt lại thành mảng rỗng nếu không phải là mảng
    }

    // Cập nhật tổng số tiền từ giỏ hàng
    $_SESSION['total_amount'] = $db->calculateTotalAmount($cart); // Gọi hàm từ đối tượng $db
} else {
    // Nếu người dùng chưa đăng nhập, khởi tạo giỏ hàng rỗng
    $_SESSION['total_amount'] = 0;
}
// Hiển thị thông báo nếu có
if (isset($_SESSION['login_required'])) {
    echo '<div class="alert alert-warning">Bạn cần đăng nhập để đặt hàng.</div>';
    unset($_SESSION['login_required']); // Clear the session variable
}

require_once __DIR__ . "/layouts/header.php";
?>

<div class="order_section layout_padding">
    <div class="container">
        <div class="row">
            <h1 class="order_taital ">Danh Sách Sản Phẩm</h1>
            <div class="bulit_icon"><img src="/public/user/images/bulit-icon.png"></div>
        </div>
    </div>

    <div class="order_section_2 d-flex">
        <div class="col-md-3">
            <h2>Danh Mục</h2>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="dathang.php" class="category-link">Tất cả</a>
                </li>
                <?php foreach ($category as $item): ?>
                    <li class="list-group-item">
                        <a href="dathang.php?category_id=<?php echo $item['id']; ?>" class="category-link"><?php echo htmlspecialchars($item['name']); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="me-3">Sản Phẩm</h2>
                <form class="d-none d-md-inline-block form-inline my-2 my-md-0" method="GET" action="">
                    <div class="input-group">
                        <input class="form-control" type="text" name="search" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="row">
                <?php if (empty($product)): ?>
                    <div class="col-12">
                        <p>Không có sản phẩm nào trong danh mục này.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($product as $item): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card">
                                <img src="<?php echo uploads() ?>/product/<?php echo htmlspecialchars($item['thunbar']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="card-img-top product-image">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                    <p class="card-text">Giá: <?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</p>
                                    <p class="card-text">Size : <?php echo htmlspecialchars($item['size']); ?></p>
                                    <?php if (!isset($_SESSION['user_id'])): ?>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#loginModal" onclick="setRedirectUrl()">Add Cart</button>
                                    <?php else: ?>
                                        <a href="add_to_cart.php?id=<?php echo $item['id']; ?>" class="btn btn-primary">Add Cart</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Giỏ hàng -->
        <div id="cart-sidenav" class="sidenav">
            <div class="sidenav-header">
                <h2>Giỏ hàng của tôi</h2>
                <!-- <span id="close-sidenav" class="close-btn">&times;</span> -->
            </div>
            <div class="sidenav-content">
                <?php if (!isset($cart) || !is_array($cart) || empty($cart)): ?>
                    <p>Giỏ hàng của bạn đang trống.</p>
                <?php else: ?>
                    <ul class="list-group" id="cart-items">
                        <?php foreach ($cart as $item): ?>
                            <?php
                            // Lấy thông tin sản phẩm dựa trên product_id
                            $product = $db->fetchOne("product", "id = " . intval($item['product_id']));
                            if ($product):
                            ?>
                                <li class="list-group-item d-flex align-items-center">
                                    <img src="<?php echo uploads() ?>/product/<?php echo htmlspecialchars($product['thunbar']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 10px;">
                                    <div class="flex-grow-1">
                                        <strong><?php echo htmlspecialchars($product['name']); ?></strong><br>
                                        <span><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ (Số lượng: <?php echo intval($item['soluong']); ?>)</span>
                                    </div>
                                    <a href="remove_from_cart.php?id=<?php echo $item['product_id']; ?>" class="btn btn-danger btn-sm">Xóa</a>
                                </li>
                            <?php else: ?>
                                <li class="list-group-item">Sản phẩm không tồn tại.</li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="sidenav-footer">
                <div class="total-price">
                    <strong>Tổng: </strong>
                    <span id="total-amount"><?php echo number_format($_SESSION['total_amount'], 0, ',', '.'); ?> VNĐ</span>
                </div>
                <a href="payments.php" class="btn btn-primary">Thanh toán</a>
            </div>
        </div>
    </div>
</div>
<!-- HTML Modal Đăng Nhập -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Đăng Nhập Để Đặt Hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="loginForm" action="login.php" method="POST">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function setRedirectUrl() {
        $.ajax({
            url: 'set_redirect_url.php',
            type: 'POST',
            data: {
                redirect_url: window.location.href
            }
        });
    }

    function adjustCartHeight() {
        var sidenavContent = document.querySelector('.sidenav-content');
        var cartItems = document.querySelectorAll('#cart-items .list-group-item');
        var itemHeight = 60; // Chiều cao trung bình của một sản phẩm (có thể điều chỉnh)

        // Tính chiều cao mới dựa trên số sản phẩm
        var newHeight = Math.min(cartItems.length * itemHeight, 300); // Giới hạn chiều cao tối đa là 300px
        sidenavContent.style.maxHeight = newHeight + 'px';
    }
</script>
<?php
require_once __DIR__ . "/layouts/footer.php";
?>