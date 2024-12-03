<?php
require_once __DIR__ . "/autoload/autoload.php";

// Kiểm tra nếu là yêu cầu POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kiểm tra xem email và password có tồn tại trong $_POST không
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Bảo mật email
    $emailEscaped = mysqli_real_escape_string($db->link, $email);
    $admin = $db->fetchOne("admin", "email = '$emailEscaped'");
    $user = $db->fetchOne("user", "email = '$emailEscaped'");

    if ($admin) {
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            header("Location:/admin/index.php");
            exit();
        } else {
            $error = "Mật khẩu không đúng!";
        }
    } elseif ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            // Kiểm tra xem có trang trở về không
            if (isset($_SESSION['redirect_to'])) {
                $redirect_url = $_SESSION['redirect_to'];
                unset($_SESSION['redirect_to']); // Xóa biến session sau khi sử dụng
                header("Location: $redirect_url");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Mật khẩu không đúng!";
        }
    } else {
        $error = "Email không tồn tại!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .error {
            color: red;
            text-align: center;
        }

        .back-button {
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .back-button a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Đăng Nhập</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required> <br>
            <input type="password" name="password" placeholder="Mật khẩu" required><br>
            <button type="submit">Đăng Nhập</button>
        </form>
        <div class="back-button">
            <a href="index.php">Quay lại</a>
        </div>
    </div>
</body>

</html>