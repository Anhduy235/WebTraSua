<?php
require_once __DIR__ . "/autoload/autoload.php";
$product = $db->fetchAll("product");
?>

<?php
require_once __DIR__ . "/layouts/header.php";
?>
<!-- header section end -->
<!-- coffee section start -->
<!-- coffee section start -->
<div class="coffee_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="coffee_title">Chào Mừng Đến Với Doze Cafe</h1>
                <p class="coffee_description">
                    Doze Cafe là một điểm đến lý tưởng cho những tín đồ yêu thích cà phê. Tại đây, bạn sẽ được thưởng thức những ly cà phê được pha chế từ những hạt cà phê chất lượng nhất, mang đến hương vị đậm đà và tinh tế. Không gian của chúng tôi được thiết kế hiện đại nhưng vẫn ấm cúng, tạo điều kiện thuận lợi cho những buổi gặp gỡ bạn bè hay những giây phút thư giãn một mình.
                </p>
                <p class="coffee_description">
                    Chúng tôi không chỉ cung cấp cà phê, mà còn có nhiều loại thức uống khác như trà, sinh tố và bánh ngọt, phục vụ cho mọi nhu cầu của bạn. Hãy đến với Doze Cafe để tận hưởng những khoảnh khắc tuyệt vời bên những người thân yêu.
                </p>
                <div class="coffee_image">
                    <img src="/public/user/images/coffee.png" alt="MilkTea" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- coffee section end -->
<!-- coffee section end -->
<!-- about section start -->



<!-- contact section start -->

<!-- contact section end -->
<?php
require_once __DIR__ . "/layouts/footer.php";
?>