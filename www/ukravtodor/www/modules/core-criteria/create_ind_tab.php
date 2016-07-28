<?php
 include("../../../cgi-bin/db_functions.php");
 
 $tabtitle=$_POST["title"];
 $description=$_POST["description"];
 $query2 = " INSERT INTO ukravtodor.eform (ID ,title, tab ,description, IDfield) VALUES ( NULL, '".$tabtitle."', '".$tab."', '".$description."', 'ID'); "; 
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);
 mysql_query($query2,$con);
 $tab_id=mysql_insert_id($con);
 $tab="data_".$tab_id;
 $query1 = " CREATE TABLE IF NOT EXISTS ".$tab." (ID bigint(20) NOT NULL AUTO_INCREMENT, PRIMARY KEY (ID) ) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1;";
 mysql_query($query1,$con);
 $query3 = " UPDATE ukravtodor.eform SET tab='".$tab."' WHERE ID=".$tab_id." "; 
 mysql_query($query3,$con); 
 mysql_close($con);
 echo "<img src=\"images/info.png\"/>В базі даних створено нову таблицю - ".$tab." для зберігання показників звітніх форм ".$tabtitle."(".$description.").";
?>