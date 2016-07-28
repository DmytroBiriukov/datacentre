<?php
 include("../../../cgi-bin/db_functions.php");
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);
 $arvalues=array();
 $arvalues= explode("ch_", trim($_POST['keyvalue']));
 if(count($arvalues)>1)
 { //echo count($arvalues);
 foreach ($arvalues as $arvalue)
 { //$arvalue=substr($arvalue, 3);
   if($arvalue!="")
   {
   $query = " DELETE FROM ".$_POST['table']." WHERE ".$_POST['keyfield']."=".$arvalue." ;"; 
   mysql_query($query,$con);
   
   //echo $query ;
   }
 }
 }else
 { echo "<div id='alert'><img src=\"images/alert.png\"/>Спочатку потрібно відмітити записи для видалення з бази даних!</div>"; 
 }
 mysql_close($con);
 echo "<div id='info'><img src=\"images/info.png\"/>Відмічені записи було успішно видалено з бази даних.</div>"; 
 sleep(3);
?>