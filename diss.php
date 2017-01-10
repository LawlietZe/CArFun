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
        font-size: 8px;
        color: #999;
      }
      .strict{
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
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
                  <li><a href="#about">玩家讨论区</a></li>
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
      <!-- 帖子内容显示区域      -->
      <?php
          echo "<div class='noteList'>";
          $servername = "localhost";
          $username = "root";
          $password = "root";
          $dbname = "cfDB";
          // PDO链接数据库方法
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $query = $conn->prepare('select * from Notes');
          $conn->query('SET NAMES utf8'); //设置字符编码
          $query->execute();
          $rs = $query->fetchAll();
          echo "<div class='row'>";
          foreach ($rs as  $value) {
                    echo    "<div class='col-sm-6 col-md-6'>";
                    echo      "<div class='thumbnail'>";
                    echo        "<img data-src='holder.js/300x300' src='".$value[img]."' width=500px height=300px>";
                    echo          "<div class='caption'>";
                    echo             "<p>作者:".$value[auth]."</p>"; 
                    echo             "<h3 class='strict'>".$value[notetitle]."</h3>";
                    echo             "<p class='strict'>".$value[content]."</p>";
                    echo             "<p class='pubtime'>发布时间:".$value[pubtime]."</p>";
                    echo             "<p><a href='detail.php?noteid=".$value[noteid]."' class='btn btn-info' role='button'>评论</a> <a href='#' class='btn btn-danger like' role='button' rel='".$value[noteid]."'>点赞 <span class='badge'>".$value[like]."</span></a></p>";
                    echo       "</div>";
                    echo    "</div>";
                    echo  "</div>";
          }
                    echo  "</div>";  
                    echo "</div>";
      ?>
    </div>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(function(){
        $(".like").click(function(){
          var like = $(this);
          var id   = like.attr("rel"); //对应id
          like.fadeOut(300);
          $.ajax({
            type:"POST",
            url:"like.php",
            data:"id="+id,
            cache:false,
            success:function(data){
              like.html(data);
              like.fadeIn(300);
            },
            error: function (jqXHR, textStatus, errorThrown) {
              alert("失败");
            }
          });
          return false;
        });
      });
    </script>
  </body>
</html>  



  