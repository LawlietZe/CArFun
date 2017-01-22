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
      .uname a{
        font-weight: 10px;
        font-size: 20px !important;
        color: #1abc9c !important;
      }
      .noteList{
        position: relative;
        top: 100px;
      }
      .pubtime{
        font-size: 15px !important;
        color: #999;
      }
      .strict{
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
      }
      .warp{
        margin-top: 80px;
      }
      .contentSize{
        font-size: 20px !important;
        text-align: center;
      }
      .reply{
        border: 1px solid red;
        width: 100%;
        background-color: #fff;
      }
      body{
        background-color: #ecf0f1;
      }
      .ewidth{
        width: 80%;
        margin: 0 auto;
      }
      .replyBG{
        background-color: #bdc3c7;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <!--    导航条    -->  
      <div class="navbar-wrapper">
        <div class="container">
          <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                </button>
                <a class="navbar-brand" href="index.html">咔方</a>
              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">主页</a></li>
                  <li><a href="regist.html">注册</a></li>
                  <li><a href="diss.php">玩家讨论区</a></li>
                  <li><a href="pub.html">发布帖子</a></li>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">更多 <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">联系我们</a></li>
                    <li><a href="#">线下活动</a></li>
                  </ul>
                 <?php
                  session_start();
                  echo '<li class="uname"><a href="#">欢迎您：'.$_SESSION['username'].'</a></li>';
                 ?>
                  <li><a href="loginout.php">注销</a></li>
                </ul>
              </div>
            </div>
          </nav>
        </div>
      </div>
<!--     根据制定id渲染页面   --> 
    <?php           
      $noteID = $_GET['noteid'];
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $dbname = "cfDB";
      // PDO链接数据库方法
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->query('SET NAMES utf8'); //设置字符编码
      $sql = "SELECT * FROM Notes WHERE noteid = '" . $noteID . "'";  
      $result = $conn->query($sql); 
      $re = $result->fetch();
        echo    "<div class='col-sm-12 col-md-12 warp'>";
        echo      "<div class='thumbnail'>";
        echo             "<h2 class='strict title'>主题:  ".$re['notetitle']."</h2>";
        echo        "<img data-src='holder.js/300x300' src='".$re['img']."' width=500px height=300px>";
        echo          "<div class='caption'>";
        echo             "<p class='pubtime'>发布时间:".$re['pubtime']."</p>";
        echo             "<p>作者:".$re['auth']."</p>"; 
        echo             "<p class='strict contentSize'>".$re['content']."</p>";
        echo       "</div>";
        echo    "</div>";
        echo  "</div>";
        echo  "</div>";  
        echo "</div>";
          //回复内容显示区域
          $query = $conn->prepare("SELECT * FROM Reply WHERE noteid = '" . $noteID . "'");
          $conn->query('SET NAMES utf8'); //设置字符编码
          $query->execute();
          $rs2 = $query->fetchAll();
                        echo "<div class='row'>";
              foreach ($rs2 as  $value) {
                        echo    "<div class='col-sm-12 col-md-12'>";
                        echo      "<div class='thumbnail  replyBG'>";
                        echo          "<div class='caption'>";
                        echo             "<p>>>:".$value['auth']."</p>"; 
                        echo             "<p class='strict'>".$value[repcontent]."</p>";
                        echo             "<p class='pubtime'>回复时间:".$value[reptime]."</p>";
                        echo       "</div>";
                        echo    "</div>";
                        echo  "</div>";
              }
                        echo  "</div>";  
                        echo "</div>";
         // 回复表单 
            echo "<form method='post' action='reply.php?auth=".$_SESSION['username']."&repid=".$noteID."' enctype='multipart/form-data' class='ewidth'>";
            echo "<label>回复</label>";  
            echo "<input id='repContent' type='text' name='repContent' class='form-control' id='repContent' placeholder='回复内容...'>";  
            echo "<input type='submit' value='回复'' class='btn btn-info bnt'><br>
            </form>";  
            echo "</div>";
            ?> 
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>  



  