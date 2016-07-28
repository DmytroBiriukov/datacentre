<?php
 include("../../../cgi-bin/db_functions.php");
 $tableName="users";
 $fieldValues=array(
        "username"     => $_POST['username'],
		"userprf"     => $_POST['userprf'],
        "memo"   => $_POST['memo'],
		"telephone"     => $_POST['telephone'],
        "email"   => $_POST['email'],		
		"userlgn"   => $_POST['userlgn'],		
		"userpwd"   => md5($_POST['userpwd'])
		);
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);
// ID 	userlgn 	userpwd 	userprf 	username 	telephone 	email 	IP 	memo
 $query = " INSERT INTO ukravtodor.users  VALUES (NULL, '".$_POST['userlgn']."', '".md5($_POST['userpwd'])."', '".$_POST['userprf']."', '".$_POST['username']."', '".$_POST['telephone']."', '".$_POST['email']."', '', '".$_POST['memo']."'); ";
 mysql_query($query,$con);
 $id=mysql_insert_id($con);
 echo "<div id='info'><img src=\"images/info.png\"/>В таблицю даних про облікові записи користувачів було створено новий обліковий запис. </div>"; 
 // з ідентифікаційним номером #".$id."
 mysql_close($con);
?>