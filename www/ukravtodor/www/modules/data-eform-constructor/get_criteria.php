<?php
 include("../../../cgi-bin/db_functions.php");

 $criteria_id = $_GET["criteria_id"];
 $criteria_id = (int)$criteria_id;
 $query1 = " SELECT * FROM criteria WHERE id=".$criteria_id;
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
// var_dump($row);
	$restext['field'] 		= $row['field'];
	$restext['tab']	  		= $row['tab'];
	$restext['type']  		= $row['type'];
	$restext['format'] 		= $row['format'];	
	$restext['decimals']	= $row['decimals'];
	$restext['separator']	= $row['separator'];
	$restext['title']		= $row['title'];
	$restext['measure']		= $row['measure'];
	switch($row['type'])
	{
		case 'date': $restext['texttype']='Дата'; break;
   		case 'char': $restext['texttype']='Текст'; break;
   		case 'int': $restext['texttype']='Ціле значення'; break;
   		case 'uint': $restext['texttype']='Ціле невід\'ємне значення'; break;
   		case 'float': $restext['texttype']='Дійсне значення'; break;
   		case 'ufloat': $restext['texttype']='Дійсне невід\'ємне значення'; break;
   		case 'percent': $restext['texttype']='Відсотки'; break;
   		case 'permile': $restext['texttype']='Перміле'; break;   
   		default: $restext['texttype']=''; break;   
 	}
	
	
	echo json_encode($restext);
 }
 else
 	echo "ERROR!";
 	
 mysql_free_result($result);
 mysql_close($con);
?>