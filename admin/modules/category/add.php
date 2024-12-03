<?php
$open = "category";
require_once __DIR__ . "/../../autoload/autoload.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data =
        [
            "name" => postInput('name')
        ];
    $error = [];
    if (postInput('name') == '') {
        $error['name'] = "Mời bạn nhập đầy đủ tên danh mục";
    }

    // code lỗi 

    $isset = $db->fetchOne("category", "name = '" . $data['name'] . "' ");
    if ($isset) { // Kiểm tra nếu $isset không phải là null
        $_SESSION['error'] = "Tên danh mục đã có ";
    } else {
        $id_insert = $db->insert("category", $data);
        if ($id_insert > 0) {
            $_SESSION['success'] = "Thêm mới thành công";
            redirectAdmin("category");
        } else {
            $_SESSION['error'] = "Thêm mới thất bại";
        }
    }
}
?>


<?php
require_once __DIR__ . "/../../layouts/header.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 ">
            <h1 class="mt-4 " style="text-align: center">Thêm Mới Danh Mục</h1>
        </div>
        <div class="clearfix">
            <?php
            if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']) ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <form class="form-horizontal" action="" method="POST">
                    <div class="form-group text-center">
                        <label for="inputEmail3" class="col-sm-20 control-label  ">Tên danh mục</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Tên danh mục" name="name" style="width: 70%; margin-left: 350px;">
                            <?php
                            if (isset($error['name'])):  ?>
                                <p class="text-danger"> <?php echo $error['name'] ?></p>
                            <?php endif ?>

                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-sm-offset-2 col-sm-20">
                            <button type="submit" class="btn btn-success">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php
    require_once __DIR__ . "/../../layouts/footer.php"
    ?>