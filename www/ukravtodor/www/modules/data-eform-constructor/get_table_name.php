<?php
 include("../../../cgi-bin/db_functions.php");
 $tab_id=$_GET["tab_id"];
 $tab_id=(int)$tab_id;
 $query1 = "SELECT * FROM eform WHERE id = ".$tab_id;
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);
 $result = mysql_query($query1,$con);
 if(!$result) 
 {  $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
 }
 
if($row = mysql_fetch_assoc($result))
 {
   $f_tab["table"]=$row['tab'];
 }
 else
 	$f_tab["table"]="undefined";
 	
    echo json_encode($f_tab);
 ?>