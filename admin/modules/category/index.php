<?php
$open = "category";
require_once __DIR__ . "/../../autoload/autoload.php";


$category = $db->fetchAll("category");
?>


<?php
require_once __DIR__ . "/../../layouts/header.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Danh Sách Danh Mục</h1>
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
                    Bảng danh mục
                    <a href="index.php"></a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                                <th>Created_at</th>
                                <th>Update_at</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $stt = 1;
                            foreach ($category as $item):  ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $item['id'] ?></td>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['created_at'] ?></td>
                                    <td><?php echo $item['updated_at'] ?></td>
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