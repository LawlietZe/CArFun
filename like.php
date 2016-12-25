<?php 
		//sql方法链接数据库
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "cfDB";
		mysql_connect($servername, $username, $password);  
		mysql_select_db($dbname);     
		$ip = $_SERVER["REMOTE_ADDR"]; //获取用户IP 
		$id = $_POST['id']; 	 //获取访问帖子id 
		if(!isset($id) || empty($id)) exit;
		$ip_sql=mysql_query("select ip from Record where noteid='$id' and ip='$ip'");   
		$count=mysql_num_rows($ip_sql); 
		if($count==0){    
		    $sql = "UPDATE `Notes` SET `like`=`like`+1 WHERE `noteid`=$id"; //更新数据  
		    mysql_query( $sql);   
		    $sql_in = "insert into Record (noteid,ip) values ('$id','$ip')"; //写入数据   
		    mysql_query( $sql_in);  
		    $sql_out =  "SELECT `like` FROM `Notes` WHERE `noteid`=$id";
		    $result = mysql_query( $sql_out); 

		    $row = mysql_fetch_array($result);   
		    $love = $row['like']; //获取赞数值   
		    echo "点赞 <span class='badge'>".$love; 
		}else{   
		    echo "已赞";   
		}  
 ?>