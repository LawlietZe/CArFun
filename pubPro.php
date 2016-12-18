<?php
    // 获取发帖信息  
    session_start();  
    $title   = $_POST['noteTitle'];
    $content = $_POST['noteContent'];
    $auth    = $_SESSION['username']; 
    // echo "发帖人是".$auth."，他的标题是".$title.",内容：".$content;
    // 链接数据库
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cfDB";
    // PDO链接数据库方法
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->query('SET NAMES utf8'); //设置字符编码
    //对数据库进行查找
    $sql = "insert into Notes(notetitle, content, auth) values ('" . $title . "', '" . $content . "', '" . $auth . "')";        //添加数据
    $conn->exec($sql);
    echo "发帖成功 <br /><a href='diss.php'>返回玩家讨论区</a>";
?>
