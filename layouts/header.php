<!DOCTYPE html>
<html>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Duy Milk Tea</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="/public/user/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="/public/user/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="/public/user/css/responsive.css">
    <!-- font css -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="/public/user/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">


    <style>
        .user-menu {
            position: relative;
            display: inline-block;
            font-size: 25px;
        }

        .user_icon {
            cursor: pointer;
            margin-left: 50px;
        }

        .user_icon:hover {
            color: #97FFFF;
        }

        .dropdown-content {
            display: none;
            /* Ẩn dropdown ban đầu */
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 15px;

        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .show {
            display: block;
            /* Hiển thị dropdown khi có class "show" */
        }
    </style>
</head>

<body>
    <div class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="index.php"><img src="/public/user/images/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dathang.php">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#footer">Contact</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">

                        <div class="login_cart_container">
                            <div class="user-menu">
                                <span class="user_icon" onclick="toggleDropdown()">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <?php if (isset($_SESSION['user_name'])):  ?>
                                        <span class="user_name"> <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                                    <?php endif; ?>
                                </span>
                                <div class="dropdown-content" id="dropdown">
                                    <a href="/login.php">Login</a>
                                    <a href="/register.php">Register</a>
                                    <a href="/log_out.php">Logout</a>
                                </div>

                            </div>
                            <ul style="display: inline;">
                                <li style="display: inline;">
                                    <a href="dathang.php" class="nav-link">
                                        <i class="fa fa-shopping-cart"></i> Giỏ hàng
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </form>
                </div>
            </nav>
        </div>

        <!-- banner section start -->
        <!-- banner section start -->
        <div class="banner_section layout_padding">
            <div id="bannerCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($product as $index => $item): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="<?php echo uploads() ?>/product/<?php echo $item['thunbar']; ?>" alt="<?php echo $item['name']; ?>" class="img-fluid smaller-image">
                                    </div>
                                    <div class="col-md-6">
                                        <h1 class="banner_title"><?php echo $item['name']; ?></h1>

                                        <div class="read_bt  "><a href="/dathang.php" class="btn btn-default">Đặt Hàng</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#bannerCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!-- banner section end -->
        <!-- banner section end -->
        <!-- banner section end -->
    </div>
    <script>
        function toggleDropdown() {
            document.getElementById("dropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.user_icon')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>