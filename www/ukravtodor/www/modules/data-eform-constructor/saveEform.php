<?php
//(1) save eform to xml file on server
//required:
// $_POST["content"];
// $_POST["id"];
// projectpath - defined string
include("../../../cgi-bin/db_functions.php"); 
$fn = projectpath."/eforms/eform".$_POST["id"].".xml";
/*echo $fn."<br>".$_POST["content"];
*/
$fp = fopen($fn, 'w') or die("can't open file");
fwrite($fp, $_POST["content"]);
fclose($fp);

?>
