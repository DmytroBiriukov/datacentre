<?php
 include("../../../cgi-bin/db_functions.php");
 $tab_id=$_POST["tabtitle"];
 $paramtitle=$_POST["title"];
// $paramfield=$_POST["pfield"];  
 $paramtype=$_POST["ptype"]; 
 $query1 = " SELECT tab FROM eform WHERE ID=".$tab_id." ";
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
 $tab="";
 if($row = mysql_fetch_assoc($result)) $tab=$row['tab'];
 mysql_free_result($result);
 
 
 $paramfield="";
 $query2 = " INSERT INTO ukravtodor.eform2params (ID, eform, paramtitle, paramfield, paramtype) VALUES (NULL, '".$tab_id."', '".$paramtitle."', '".$paramfield."', '".$paramtype."'); ";
 mysql_query($query2,$con);
 $paramfield_id=mysql_insert_id($con);
 $paramfield="p_".$paramfield_id;
 $query4 = " UPDATE ukravtodor.eform2params SET paramfield='".$paramfield."' WHERE ID=".$paramfield_id." "; 
 mysql_query($query4,$con); 
 $types=array('region'=> 'TINYINT','year'=>'YEAR','int'=>'INT','uint'=>'INT','date'=>'DATE','percent'=>'TINYINT','permile'=>'SMALLINT','char'=>'VARCHAR(127)');
 $field_type=$types[$paramtype]; 
 $query3 = " ALTER TABLE ".$tab." ADD ".$paramfield." ".$field_type." NOT NULL; ";
 mysql_query($query3,$con);
 echo "<img src=\"images/info.png\"/>В таблицю даних про параметри звітньої форми внесено дані про параметр ".$paramtitle.". В таблиці даних ".$tab." було створено повий стовпчик для параметру ".$paramtitle.". </p>";
 mysql_close($con);
?>