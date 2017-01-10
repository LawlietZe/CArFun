<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>咔方网 - ( ゜- ゜)つロ  乾杯~  - CArFun!</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/carousel.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/car.ico" />
    <style type="text/css">
    </style> 
  </head>
  <body> 
    <?php
    session_start(); 
    // 从表单获取用户注册信息
    $name = $_POST['uname'];
    $passwd = $_POST['pwd'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $remark = $_POST['remark'];
    $sex = $_POST['sex'];
    // 链接数据库
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cfDB";
    // PDO链接数据库方法
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->query('SET NAMES utf8'); //设置字符编码
    $sql = "SELECT * FROM User WHERE username = '" . $name . "'";        
    //定义sql语句--查询固定user_name的记录
    $result = $conn->query($sql);                                                
    //对数据库进行查找
    $re = $result->fetch();
    if(!$re){                                                                           //若无返回，
    $sql2 = "insert into User(username, password, phone, email, sex, remark) values ('" . $name . "', '" . $passwd . "', '" . $phone . "', '" . $email . "', '" . $sex . "', '" . $remark . "')";        //添加数据
    $conn->exec($sql2);
    $_SESSION['username'] = $name;
    echo "<div class='alert alert-success'>注册成功！跳转到玩家讨论版块。</div>";
    echo '<script language="javascript">
            function doReload()
            {
            location.href="diss.php";
            }
            setTimeout("doReload()",1500);
            </script>';
    }else{
        echo "用户名已被注册 <br /><a href='regist.html'>返回注册页面</a>";//若有返回，返回信息
    }
    ?>

    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>