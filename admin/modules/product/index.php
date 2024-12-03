<?php
$open = "product";
require_once __DIR__ . "/../../autoload/autoload.php";


$product = $db->fetchAll("product");
?>


<?php
require_once __DIR__ . "/../../layouts/header.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Danh Sách Sản Phẩm</h1>
            <a href="add.php" class="btn btn-success">Thêm</a>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"></li>
            </ol>
            <div class="clearfix"></div>
            <?php
            if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success'];
                    unset($_SESSION['success']) ?>
                </div>
            <?php endif; ?>

            <?php
            if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Bảng sản phẩm
                    <a href="index.php"></a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Danh Mục</th>
                                <th>Thunbar</th>
                                <th>Info</th>
                                <th>Created_at</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php $stt = 1;
                            foreach ($product as $item):  ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['category_id'] ?></td>
                                    <td>
                                        <img src="<?php echo uploads() ?>/product/<?php echo $item['thunbar'] ?>" width="80px" height="80px">
                                    </td>
                                    <td>
                                        <ul>
                                            <li>Giá: <?php echo $item['price'] ?></li>
                                            <li>Size: <?php echo $item['size'] ?></li>
                                        </ul>
                                    </td>
                                    <td><?php echo $item['created_at'] ?></td>
                                    <td>
                                        <a class="btn btn-xs btn-info" href="edit.php?id=<?php echo $item['id'] ?>">Sửa</a>
                                        <a class="btn btn-xs btn-danger" href="delete.php?id=<?php echo $item['id'] ?>">Xóa</a>
                                    </td>
                                </tr>
                            <?php $stt++;
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <?php
    require_once __DIR__ . "/../../layouts/footer.php"
    ?>