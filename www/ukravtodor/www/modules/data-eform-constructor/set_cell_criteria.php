<?php
 include("../../../cgi-bin/db_functions.php");
 $id=$_POST["id"];
 $query1 = " SELECT * FROM criteria WHERE id=".$id." ";
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
 { $ID=$row['id'];
   $type=$row['type'];
   $field=$row['field'];
   $tab=$row['tab'];
   $size=$row['format'];
   $format=$row['format'];   
   $decimals=$row['decimals'];      
   $delimiter=$row['separator'];      
 }

 mysql_free_result($result);
 mysql_close($con);
 
 echo "Таблиця даних - ".$tab.", поле даних - ".$field. ", тип показника - ".$type.", формат - ".$format;
?>
 <script language="javascript">
 set_cell_criteria(<? echo $tab." , ".$field. " , ".$type." , ".$format. ", ".$size." , ".$decimals." , ".$delimiter; ?>);
 </script>