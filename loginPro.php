  <?php																						
    $passwd = $_POST['pwd'];	
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "cfDB";
    try {
   		  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        //PDO链接
  			$conn->query('SET NAMES utf8'); 			//设置字符编码
        session_start(); 											//session开始
        $sql = "select userid from User where username = '".$name."' AND password = '".$passwd."'";
        $res = $conn->query($sql); 					 //执行sql语句
        $rs = $res->fetch();									//获取查询结果
        if ($rs) {
        	echo "恭喜你进入咔方系统";
        }
        else{
        	echo "登录信息有误";
        }
   	}
	  catch(PDOException $e){
		      echo $e->getMessage();
		}


?>
