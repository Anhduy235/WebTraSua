<?php
$open = "category";
require_once __DIR__ . "/../../autoload/autoload.php";

$id = intval(getInput('id'));

$EditCategory = $db->fetchId("category", $id);
if (empty($EditCategory)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("category");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data =
        [
            "name" => postInput('name')
        ];
    $error = [];
    if (postInput('name') == '') {
        $error['name'] = "Mời bạn nhập đầy đủ tên danh mục";
    }
    if (empty($error)) {
        $id_update = $db->update("category", $data, array("id" => $id));
        if ($id_update > 0) {
            $_SESSION['success'] = "Cập nhật thành công";
            redirectAdmin("category");
        } else {
            $_SESSION['error'] = "Cập nhật thất bại";
            redirectAdmin("category");
        }
    }
}
?>


<?php
require_once __DIR__ . "/../../layouts/header.php";
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Thêm Mới Danh Mục</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal" action="" method="POST">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-20 control-label">Tên danh mục</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Tên danh mục" name="name" value="<?php echo $EditCategory['name'] ?>">
                            <?php
                            if (isset($error['name'])):  ?>
                                <p class="text-danger"> <?php echo $error['name'] ?></p>
                            <?php endif ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
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