<?php
 include("../../../cgi-bin/db_functions.php");
 $tab_id=$_POST["tabtitle"];
 $query1 = " SELECT * FROM criteria WHERE id IN ( SELECT criteria FROM eform2criteria WHERE eform=".$tab_id." )";
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
 ?><select name="id_criteria" id="id_criteria"> 
 <?
  $first = true;
 while($row = mysql_fetch_assoc($result))
 {
   $ID=$row['id'];
   $paramtitle=$row['title']; 
   $paramtype=$row['type'];
   $paramfield=$row['field'];
   $tab=$row['tab'];
 $message='Дотримуйтесь типу параметру';
 switch($type)
 { case 'date': $message='Дата'; break;
   case 'char': $message='Текст'; break;
   case 'int': $message='Ціле значення'; break;
   case 'uint': $message='Ціле невід\'ємне значення'; break;
   case 'float': $message='Дійсне значення'; break;
   case 'ufloat': $message='Дійсне невід\'ємне значення'; break;
   case 'percent': $message='Відсотки'; break;
   case 'permile': $message='Перміле'; break;   
   default: $message=''; break;   
 }

 if ($first)
 {
	 echo "<option value='".$ID."' selected='selected'>".$paramtitle."</option>";
	 $first = false;
 }
 else
   	 echo "<option value='".$ID."'>".$paramtitle."</option>";
 }?></select> 
 <?
 mysql_free_result($result);
 mysql_close($con);
?>