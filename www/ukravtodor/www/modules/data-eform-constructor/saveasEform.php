<?php
//(2) "save as" eform to xml file on server
//required:
// $_POST["content"];
// $_POST["id"];
// $_POST['title'] $_POST['tab'] $_POST['description'] $_POST['IDfield']
// projectpath - defined string
  include("../../../cgi-bin/db_functions.php"); 
// 2-1 Create new eform record in DB
 $query="INSERT INTO eform (id, title, tab, description, IDfield) VALUES (NULL, '".$_POST['title']."', '".$_POST['tab']."', '".$_POST['description']."', '".$_POST['IDfield']."');";
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);

// $aQResult= mysql_query($aSQL, $link);
// if($aQResult == true) $aResult=mysql_insert_id($link);
 
// 2-2 save eform to file on server if record successfuly created
 if($aResult>0)
 { $fn = projectpath."/eforms/eform".$aResult.".xml";
   $fp = fopen($fn, 'w') or die("can't open file");
   fwrite($fp, $_POST["content"]);
   fclose($fp);
 }

?>
