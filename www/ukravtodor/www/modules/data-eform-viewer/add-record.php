<?php
 include("../../../cgi-bin/db_functions.php");
 $fieldValues=array();
 //print_r( $_POST);
 foreach($_POST as $k => $v) if ($k != "tab") $fieldValues[$k]=$v;
 sqlInsertQuery($_POST["tab"], $fieldValues);     
 echo "<div id='info'><img src=\"images/info.png\"/>Додано новий запис в форму звітності.</div>"; 
 sleep(3); 
?>