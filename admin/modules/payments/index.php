<?php
require_once __DIR__ . "/../../autoload/autoload.php";

// Lấy danh sách thanh toán từ cơ sở dữ liệu
$payments = $db->fetchAll("payments");

require_once __DIR__ . "/../../layouts/header.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container mt-5">
            <h1 class="mb-4">Danh Sách Đặt Hàng</h1>
            <?php if (empty($payments)): ?>
                <div class="alert alert-warning">Không có đơn hàng nào.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>STT</th>
                                <th>Tên Khách Hàng</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Địa Chỉ</th>
                                <th>Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Tổng Giá</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 1; ?>
                            <?php foreach ($payments as $item): ?>
                                <tr>
                                    <td><?php echo $stt; ?></td>
                                    <td><?php echo htmlspecialchars($item['buyer_name']); ?></td>
                                    <td><?php echo htmlspecialchars($item['buyer_email']); ?></td>
                                    <td><?php echo htmlspecialchars($item['buyer_phone']); ?></td>
                                    <td><?php echo htmlspecialchars($item['buyer_address']); ?></td>
                                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                    <td><?php echo intval($item['quantity']); ?></td>
                                    <td><?php echo number_format($item['total_price'], 0, ',', '.'); ?> VNĐ</td>
                                    <td>
                                        <button class="btn btn-xs btn-info" onclick="toggleProductInfo(<?php echo $item['id']; ?>)">View</button>
                                        <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>">Xóa</a>
                                    </td>
                                </tr>
                                <!-- xử lý view product info -->
                                <tr id="product-info-<?php echo $item['id']; ?>" style="display: none;">
                                    <td colspan="9">
                                        <div>
                                            <strong>Thông Tin Sản Phẩm Đã Đặt:</strong>
                                            <ul>
                                                <?php
                                                // Lấy thông tin sản phẩm từ đơn hàng
                                                $order_id = $item['id']; // ID của đơn hàng
                                                $ordered_products = $db->fetchAll("payments", "id = $order_id"); // Lấy thông tin sản phẩm từ bảng payments
                                                foreach ($ordered_products as $ordered_item):
                                                ?>
                                                    <li>
                                                        Tên sản phẩm: <?php echo htmlspecialchars($ordered_item['product_name']); ?> -
                                                        Số lượng: <?php echo intval($ordered_item['quantity']); ?> -
                                                        Tổng giá: <?php echo number_format($ordered_item['total_price'], 0, ',', '.'); ?> VNĐ
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php $stt++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <?php require_once __DIR__ . "/../../layouts/footer.php"; ?>
</div>

<style>
    /* CSS tùy chỉnh để cải thiện giao diện */
    body {
        background-color: #f8f9fa;
    }

    .table {
        background-color: white;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .table th {
        background-color: #343a40;
        color: white;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .alert {
        margin-top: 20px;
    }
</style>
<script>
    function toggleProductInfo(id) {
        var productInfoRow = document.getElementById('product-info-' + id);
        if (productInfoRow.style.display === 'none') {
            productInfoRow.style.display = 'table-row';
        } else {
            productInfoRow.style.display = 'none';
        }
    }
</script>