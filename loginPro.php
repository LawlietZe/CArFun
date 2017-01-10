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
      body{
        background-color: #95a5a6;
      }
      .box{
        position: relative;
        top: 200px;
        margin: 0 auto;
        width: 400px !important;
      }
    </style> 
  </head>
  <body>
    <?php           
    $name = $_POST['uname'];                                    
    $passwd = $_POST['pwd'];    
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cfDB";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                                                    //PDO链接
        $conn->query('SET NAMES utf8');                             //设置字符编码
        session_start();                                            //session开始
        $sql = "select userid from User where username = '".$name."' AND password = '".$passwd."'";
        $res = $conn->query($sql);                   //执行sql语句
        $rs = $res->fetch();                                    //获取查询结果
        if ($rs) {
            $_SESSION['username'] = $name;
            echo $_SESSION['username']."恭喜你进入咔方系统";
            echo '<script>window.location.href = "diss.php"</script>';
        }
        else{
            echo '<div class="alert alert-danger box">
                  <a href="login.html" class="alert-link">用户信息输入错误，点击返回。</a>
                  </div>';
        }
    }
    catch(PDOException $e){
       echo $e->getMessage();
    }
    ?>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>  



  