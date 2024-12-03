<?php
require_once __DIR__ . "/autoload/autoload.php";
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Thành Công</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            color: #28a745;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>

<body>
    <div>
        <h1>Thanh Toán Thành Công!</h1>
        <p>Cảm ơn bạn đã thực hiện thanh toán. Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.</p>
        <a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>
    </div>
</body>

</html>