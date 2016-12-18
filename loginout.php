<?php 
header("Content-Type: text/html;charset=UTF-8");
session_start();
session_destroy();
echo "<script>alert('已经退出登陆！');location.href='login.html';</script>";
 ?>