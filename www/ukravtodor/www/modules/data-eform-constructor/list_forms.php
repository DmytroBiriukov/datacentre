<?php
 include("../../../cgi-bin/db_functions.php");
 
 $query1 = " SELECT id, title, description FROM eform ";
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
 ?><select name="id_eform" id="id_eform"> 
 <?
 while($row = mysql_fetch_assoc($result))
 {
   $ID=$row['id'];
   $title=$row['title']; 
   $descr=$row['description'];
   echo "<option id='id_eform' value='".$ID."' selected='selected'>".$title."</option>";
   /*   <!-- <div id="Eform_info"><? echo $descr;?></div>
 -->
   */
 }?></select> 
 <button id="" onclick="load_xml_form(document.getElementById('id_eform').value); document.getElementById('forms_list_panel').style.display='none';">Відкрити</button>
 <?
 mysql_free_result($result);
 mysql_close($con);
?>