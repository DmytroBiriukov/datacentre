<?php
 include("../../../cgi-bin/db_functions.php");
 $tab_id=$_POST["tabtitle"];
 $paramtitle=$_POST["title"];
 $parammeasure=$_POST["measure"]; 
// $paramfield=$_POST["field"];  
 $paramtype=$_POST["type"]; 
 $paramformat=$_POST["format"];  
 
  $paramdecimals=$_POST["decimals"];  
   $paramseparator=$_POST["separator"];  
    $parambound_low=$_POST["bound_low"];  
	 $parambound_upper=$_POST["bound_upper"];  
	  $paramopt=$_POST["opt"];  

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

 $types=array('float'=> 'FLOAT', 'ufloat'=> 'FLOAT', 'int'=>'INT','uint'=>'INT', 'date'=>'DATE','percent'=>'TINYINT','permile'=>'SMALLINT','char'=>'VARCHAR( 127 )');
 $field_type=$types[$paramtype]; 


 $paramfield="";
 $query2 = " INSERT INTO ukravtodor.criteria  VALUES (NULL, '', '".$paramtitle."', '".$parammeasure."', 'Y', '".$tab."', '".$paramfield."', '".$paramtype."', '".$paramformat."', '".intval($paramdecimals)."', '".$paramseparator."', '".intval($parambound_low)."', '".intval($parambound_upper)."', '".$paramopt."'); ";
 
 mysql_query($query2,$con);
 $criteria_id=mysql_insert_id($con);

 $query4 = " INSERT INTO ukravtodor.eform2criteria (ID, eform, criteria) VALUES (NULL, '".$tab_id."', '".$criteria_id."'); ";
// echo  $query4;
 
 mysql_query($query4,$con);
 $paramfield="W_".$criteria_id;
 $query5 = " UPDATE ukravtodor.criteria SET field='".$paramfield."' WHERE id=".$criteria_id." "; 
 mysql_query($query5,$con); 
  $query3 = " ALTER TABLE ".$tab." ADD ".$paramfield." ".$field_type." NOT NULL; ";
 mysql_query($query3,$con);
 echo "<img src=\"images/info.png\"/>В таблицю даних про показники звітньої форми внесено дані про показник ".$paramtitle.". </br>В таблиці даних ".$tab." було створено новий стовпчик для показника ".$paramtitle.". ";
 mysql_close($con);
?>