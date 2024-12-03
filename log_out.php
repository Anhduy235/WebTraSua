<?php
session_start(); // Khởi động phiên làm việc
session_unset();
session_destroy(); // Hủy phiên làm việc
header("Location: index.php"); // Chuyển hướng về trang chủ hoặc trang đăng nhập
exit();
