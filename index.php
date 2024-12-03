<?php
require_once __DIR__ . "/autoload/autoload.php";
$product = $db->fetchAll("product");
?>

<?php
require_once __DIR__ . "/layouts/header.php";
?>
<!-- header section end -->
<!-- coffee section start -->
<div class="coffee_section layout_padding">
    <div class="container">
        <div class="row">
            <h1 class="coffee_taital">Milk Tea DV</h1>
        </div>
    </div>
    <div class="coffee_section_2">
        <div id="main_slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container-fluid">
                        <div class="row ">
                            <!-- Hiển thị danh sách sản phẩm -->
                            <?php foreach ($product as $item): ?>
                                <div class="col-lg-3 col-md-6">
                                    <div class="coffee_img">
                                        <img src="<?php echo uploads() ?>/product/<?php echo $item['thunbar']; ?>" alt="<?php echo $item['name']; ?>" class="product-image">
                                    </div>
                                    <h3 class="types_text"><?php echo $item['name']; ?></h3>
                                    <p class="looking_text">Giá: <?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</p>
                                    <p class="card-text">Size: <?php echo ($item['size']) ?></p>
                                    <div class="read_bt"><a href="#">Đặt Hàng</a></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!-- Phần carousel-item khác có thể giữ nguyên hoặc bỏ đi -->
            </div>

        </div>
    </div>
</div>
<!-- coffee section end -->
<!-- about section start -->

<style>
    .about_image {
        width: 700px;
        /* hoặc bạn có thể sử dụng % */
        height: auto;
        /* tự động điều chỉnh chiều cao */
    }
</style>

<div class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="about_taital">About Our shop</h1>
                <div class="bulit_icon">
                    <img src="/public/user/images/ourshop.jpg" class="about_image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about section end -->
<!-- client section start -->
<div class="client_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="about_taital">Where does milk tea originate?</h1>
            </div>
        </div>
        <div class="client_section_2">
            <div class="client_taital_main">
                <div class="client_left">
                    <div class="client_img">
                        <img src="/public/user/images/tgmilk.jpg" alt="Milk Tea">
                    </div>
                </div>
                <div class="client_right">
                    <h3 class="moark_text">Liu Han-Chieh</h3>
                    <p class="client_text">Ông Liu Han-Chieh được coi là người đặt nền móng cho trà sữa.</p>
                    <p class="client_text">Vào những năm 1980, chủ của quán trà ô long Chun Shui Tang ở Đài Trung (Đài Loan), ông Liu Han-Chieh, muốn thay đổi cách uống trà của mọi người nên đã cho trà sữa truyền thống vào bình lắc cocktail cùng với đá rồi uống thử và thấy hương vị rất ngon.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- client section end -->
<!-- blog section start -->
<div class="blog_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="about_taital">Our Blog</h1>
                <div class="bulit_icon"><img src="/public/user/images/bulit-icon.png"></div>
            </div>
        </div>
        <div class="blog_section_2">
            <div class="row">
                <div class="col-md-6">
                    <div class="blog_box">
                        <div class="blog_img"><img src="/public/user/images/our3.jpg"></div>
                        <h4 class="prep_text">Cách làm trà sữa ca cao béo ngọt thơm ngon, đậm vị</h4>
                        <p class="lorem_text">Với một người yêu thích trà sữa, nhất là những loại trà sữa đậm vị, ấn tượng thì không thể nào bỏ qua được cách làm trà...</p>
                    </div>
                    <div class="read_bt"><a href="https://trasuadodo.vn/cach-lam-tra-sua-ca-cao/">Read More</a></div>
                </div>
                <div class="col-md-6">
                    <div class="blog_box">
                        <div class="blog_img"><img src="/public/user/images/our.jpg"></div>
                        <h4 class="prep_text">Cách làm trà sữa trân châu đường đen tại nhà ngon, đơn giản</h4>
                        <p class="lorem_text">Cách làm trà sữa trân châu đường đen ngon đang được rất nhiều người dùng mạng tìm kiếm, đặc biệt là các “team...</p>
                    </div>
                    <div class="read_bt"><a href="https://trasuadodo.vn/cach-lam-tra-sua-tran-chau-duong-den/">Read More</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog section end -->
<!-- contact section start -->

<!-- contact section end -->
<?php
require_once __DIR__ . "/layouts/footer.php";
?>