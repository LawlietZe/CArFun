<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>咔方网 - ( ゜- ゜)つロ  乾杯~  - CArFun!</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/carousel.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/car.ico" /> 
  </head>
  <body>
<?php
    session_start();    // 开启  
    $title   = $_POST['noteTitle'];
    $content = $_POST['noteContent'];
    $auth    = $_SESSION['username'];
    $file    = $_FILES['pubimg'];//得到传输的数据
    $name    = $file['name'];    //得到文件名称
    $pubimg = "img/".$name;
    $type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
    $allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
    //判断文件类型是否被允许上传
    if(!in_array($type, $allow_type)){
      //如果不被允许，则直接停止程序运行
      return ;
    }
    //判断是否是通过HTTP POST上传的
    if(!is_uploaded_file($file['tmp_name'])){
      //如果不是通过HTTP POST上传的
      return ;
    }
    $upload_path = "/Users/chriswong/Desktop/CArFun/img/"; //上传文件的存放路径
    //开始移动文件到相应的文件夹
    if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){  
    }else{
      echo "<script>alert('文件导入失败')</script>";
    }
    //链接数据库
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cfDB";
    // PDO链接数据库方法
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->query('SET NAMES utf8'); //设置字符编码
    //对数据库进行查找
    $sql = "insert into Notes(notetitle, content, auth, img) values ('" . $title . "', '" . $content . "', '" . $auth . "', '". $pubimg ."')";        //添加数据
    $conn->exec($sql);
    echo "<div class='alert alert-success'>
          <a href='diss.php'>发帖成功,跳转中</a>
          </div>";
    echo "<script language='javascript'>
            function doReload()
            {
            location.href='diss.php';
            }
            setTimeout('doReload()',1500);
          </script>";
?>
  </body>
</html>  

