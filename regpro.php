<?php
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
    echo "您已注册成功 <br /><a href='index.html'>返回登录页面</a>";
    // echo "<script>window.location.href='index.html';</script>";                                                                      //返回用户信息
    }else{
        echo "用户名已被注册 <br /><a href='regist.html'>返回注册页面</a>";//若有返回，返回信息
    }
?>
