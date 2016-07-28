<?php
 include("../../../cgi-bin/db_functions.php");
 $tableName="usergroups";
 $fieldValues=array(
        "title"     => $_POST['title'],
        "description"   => $_POST['description']);
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);
 $query = " INSERT INTO ukravtodor.usergroups  VALUES (NULL, '".$_POST['title']."', '".$_POST['description']."'); ";
 mysql_query($query,$con);
 $id=mysql_insert_id($con);
 echo "<div id='info'><img src=\"images/info.png\"/>В таблиці даних про групи користувачів було створено новий запис. </div>";
 // з ідентифікаційним номером #".$id.". "; 
 mysql_close($con);
?>