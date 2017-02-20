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
    <style type="text/css">
    </style>
  </head>
  <body>
  <?php   
  $auth = $_GET['auth'];    //获取发布者名称
  $repid = $_GET['repid'];  //获取回复帖子id
  $content = $_POST['repContent'];
    //链接数据库
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cfDB";
    // PDO链接数据库方法
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->query('SET NAMES utf8'); //设置字符编码
    //对数据库进行查找
    $sql = "insert into Reply(noteid, repcontent, auth) values ('" . $repid . "', '" . $content . "', '". $auth ."')";        //添加数据
    $conn->exec($sql);
    echo "<div class='alert alert-success'>
          <a href='detail.php?noteid=".$repid."'>回复成功,跳转中</a>
          </div>";
    echo "<script language='javascript'>
            function doReload()
            {
            location.href='detail.php?noteid=".$repid."';
            }
            setTimeout('doReload()',1500);
          </script>";    
  ?>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>  



  