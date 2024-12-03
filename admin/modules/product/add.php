<?php
$open = "category";
require_once __DIR__ . "/../../autoload/autoload.php";

//Lay ds danh mục sp
$category = $db->fetchAll("category");




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data =
        [
            "name" => postInput('name'),
            "category_id" => postInput("category_id"),
            "price" => postInput("price"),
            "number" => postInput("number"),
            "size" => postInput('size'),
            "content" => postInput("content")
        ];
    $error = [];
    if (postInput('name') == '') {
        $error['name'] = "Mời bạn nhập đầy đủ tên danh mục";
    }
    if (postInput('category_id') == '') {
        $error['category_id'] = "Mời bạn chọn tên danh mục";
    }
    if (postInput('price') == '') {
        $error['price'] = "Mời bạn nhập giá sản phẩm";
    }
    if (postInput('content') == '') {
        $error['content'] = "Mời bạn nhập nội dung sản phẩm";
    }
    if (postInput('number') == '') {
        $error['number'] = "Mời bạn nhập số lượng sản phẩm";
    }
    if (postInput('size') == '') {
        $error['size'] = "Mời bạn nhập size sản phẩm";
    }
    if (! isset($_FILES['thunbar'])) {
        $error['thunbar'] = "Hãy chọn hình ảnh";
    }

    // code lỗi 
    if (empty($error)) {
        if (isset($_FILES['thunbar'])) {
            $file_name = $_FILES['thunbar']['name'];
            $file_tmp = $_FILES['thunbar']['tmp_name'];
            $file_type = $_FILES['thunbar']['type'];
            $file_erro = $_FILES['thunbar']['error'];

            if ($file_erro == 0) {
                $part = ROOT . "product/";
                $data['thunbar'] = $file_name;
            }
        }
        $id_insert = $db->insert("product", $data);
        if ($id_insert) {
            move_uploaded_file($file_tmp, $part . $file_name);
            $_SESSION['success'] = "Thêm mới thành công";
            redirectAdmin("product");
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
            <h1 class="mt-4 " style="text-align: center">Thêm Mới Sản phẩm</h1>
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
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group text-center">
                        <label for="inputEmail3" class="col-sm-20 control-label  ">Danh mục sản phẩm</label>
                        <div class="col-sm-8">
                            <select class="form-control col-md-8" name="category_id" style="width: 70%; margin-left: 350px;">
                                <option value="">Hãy chọn danh mục sản phẩm</option>
                                <?php foreach ($category as $item): ?>
                                    <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                                <?php endforeach  ?>
                            </select>
                            <?php
                            if (isset($error['category_id'])):  ?>
                                <p class="text-danger"> <?php echo $error['category_id'] ?></p>
                            <?php endif ?>

                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label for="inputEmail3" class="col-sm-20 control-label  ">Tên sản phẩm</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="Tên san pham" name="name" style="width: 70%; margin-left: 350px;">
                            <?php
                            if (isset($error['name'])):  ?>
                                <p class="text-danger"> <?php echo $error['name'] ?></p>
                            <?php endif ?>

                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label for="inputEmail3" class="col-sm-20 control-label  ">Giá sản phẩm</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="inputEmail3" placeholder="9.000.000" name="price" style="width: 70%; margin-left: 350px;">
                            <?php
                            if (isset($error['price'])):  ?>
                                <p class="text-danger"> <?php echo $error['price'] ?></p>
                            <?php endif ?>

                        </div>

                    </div>
                    <div class="form-group text-center">
                        <label for="inputEmail3" class="col-sm-20 control-label  ">Giảm giá</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputEmail3" placeholder="10 %" name="sale" value="0" style="width: 70%; margin-left: 530px;">
                        </div>

                        <label for="inputEmail3" class="col-sm-20 control-label  ">Hình ảnh</label>
                        <div class="col-sm-3">
                            <input type="file" class="form-control" id="inputEmail3" name="thunbar" style="width: 100%; margin-left: 450px;">
                            <?php
                            if (isset($error['thunbar'])):  ?>
                                <p class="text-danger"> <?php echo $error['thunbar'] ?></p>
                            <?php endif ?>
                        </div>
                        <label for="inputEmail3" class="col-sm-20 control-label  ">Size</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="" name="size" style="width: 20%; margin-left: 550px;">
                            <?php
                            if (isset($error['size'])):  ?>
                                <p class="text-danger"> <?php echo $error['size'] ?></p>
                            <?php endif ?>

                        </div>



                        <div class="form-group text-center">
                            <label for="inputEmail3" class="col-sm-20 control-label  ">Nội dung</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="=content" style="width: 70%; margin-left: 350px;" rows="4"></textarea>
                                <?php
                                if (isset($error['content'])):  ?>
                                    <p class="text-danger"> <?php echo $error['content'] ?></p>
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