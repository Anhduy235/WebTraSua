<?php
require_once __DIR__ . "/autoload/autoload.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $role = $_POST['role']; // 'user' hoặc 'admin'

    // Kiểm tra xem email đã tồn tại hay chưa
    if ($role === 'admin') {
        $existingAdmin = $db->fetchOne("admin", "email = '" . mysqli_real_escape_string($db->link, $email) . "'");
        if ($existingAdmin) {
            $error = "Email đã tồn tại!";
        } else {
            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Chèn dữ liệu vào bảng admin
            $data = [
                'email' => $email,
                'password' => $hashedPassword,
                'name' => $name
            ];
            $db->insert("admin", $data);
            $success = "Đăng ký thành công cho admin!";
        }
    } else {
        $existingUser  = $db->fetchOne("user", "email = '" . mysqli_real_escape_string($db->link, $email) . "'");
        if ($existingUser) {
            $error = "Email đã tồn tại!";
        } else {
            // Mã hóa mật khẩu
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Chèn dữ liệu vào bảng user
            $data = [
                'email' => $email,
                'password' => $hashedPassword,
                'name' => $name
            ];
            $db->insert("user", $data);
            $success = "Đăng ký thành công cho user!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
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

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .error {
            color: red;
            text-align: center;
        }

        .success {
            color: green;
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
    <div class="container">
        <h1>Đăng Ký</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="text" name="name" placeholder="Tên" required> <br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Mật khẩu" required><br>
            <select name="role" required>
                <option value="user">Người dùng</option>
                <option value="admin">Quản trị viên</option>
            </select>
            <button type="submit">Đăng Ký</button>
        </form>
        <div class="back-button">
            <a href="index.php">Quay lại</a>
        </div>
    </div>
</body>

</html>