<? 
//echo "Hello ".$_POST['ID'];

 include("../../../cgi-bin/db_functions.php");
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con) {  die('Could not connect: ' . mysql_error()); }
 mysql_select_db(database, $con);
 $query3 = " SELECT * FROM users WHERE ID=".$_POST['ID']." "; 
 $result3 = ExecuteQuery($query3);
 if( mysql_num_rows($result3)>0)
 { if($line3=mysql_fetch_array($result3, MYSQL_ASSOC))
   { echo   "<p>User name:".$line3['username']."</p><p>User login:".$line3['userlgn']."</p><p>Memo:".$line3['memo']."</p><p>Tel.:".$line3['telephone']."</p><p>E-mail:".$line3['email']."</p>";
   }		 
 }
 mysql_free_result($result3);		   
 mysql_close($con);
?>