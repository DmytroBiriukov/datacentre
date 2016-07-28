<?php include("../../../cgi-bin/db_functions.php"); 
 $id_eform=$_POST["tabtitle"];
 $id_user=$_POST["user"];
 $start_date=$_POST["startdate"];
 $end_date=$_POST["enddate"]; 
 $title=$_POST["title"];
//  
  
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);
 
 $query2 = " INSERT INTO ukravtodor.module2user (userprf, module, start_date, end_date, title) VALUES ( '".$id_user."', '5', '".$start_date."', '".$end_date."','". $title."'); "; 
 mysql_query($query2,$con);
 $id=mysql_insert_id($con);
 $query3 = " INSERT INTO ukravtodor.module2user2param (ID_share, userprf, module, param, value) VALUES ('".$id."', '".$id_user."', '5', '1', '".$id_eform."'),";
 $query3 .= " ('".$id."', '".$id_user."', '5', '12', '".$id."'),";
 $query3 .= " ('".$id."', '".$id_user."', '5', '2', '".$start_date."'),";
 $query3 .= " ('".$id."', '".$id_user."', '5', '3', '".$end_date."'); "; 
 mysql_query($query3,$con); 
 $query1 = " INSERT INTO ukravtodor.eform2user2param (ID_share, param, 	value) VALUES ";
 $i=0;
 foreach ($_POST as $k => $v)
 {  $i++;
    if($k != "tabtitle" && $k != "user" && $k != "startdate" && $k != "enddate" && $k != "title")
    { $query1 .="('".$id."', '".substr($k, 2)."', '".$v."'), "; 
	}
	
 }
 $query1=substr($query1, 0, -2); 
 $query1.=";";
 if($i>0) mysql_query($query1,$con);
 mysql_close($con);
 echo "<div id='info'><img src='images/info.png'/>Зроблено запис про надання доступу до електронної форми звітності.</div>"; 

 ?>