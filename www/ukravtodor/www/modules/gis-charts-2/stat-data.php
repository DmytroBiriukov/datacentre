<?php 
    include("../../../cgi-bin/db_functions.php");
//	$OGR_FID=$_POST['id'];
	$OGR_FID=2;
    $query="SELECT * FROM stat WHERE id=".$OGR_FID;
    if(  $result=ExecuteQuery($query) )
    { 
        $field=array();
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        foreach($line as $key => $value)
        {
            $field[$key]=$value;
        }
        mysql_free_result($result);
		
//  формуємо datasets, наприклад,
$datasets_string=" var datasets = { ";
$datasets_string.="\"criterion_1\": {label: \"Показник 1\", ";
$datasets_string.="data: [ [1988, ".$field['W1']."], [1989, ".$field['W2']."], [1990,  ".$field['W3']."], [1991,  ".$field['W4']."], [1992,  ".$field['W5']."]";
$datasets_string.="},";
$datasets_string.="\"criterion_2\": {label: \"Показник 2\", ";
$datasets_string.=" data: [ [1988, ".$field['W6']."], [1989, ".$field['W7']."], [1990,  ".$field['W8']."], [1991,  ".$field['W9']."], [1992,  ".$field['W10']."] ";
$datasets_string.="} }; ";	
print($datasets_string); 
    }else 
    {   
      $datasets_string=" var datasets = { \"criterion_1\": {label: \"Не отримані дані з бази даних\", data: [ [0, 0] ]}}; "; 
	  print($datasets_string); 
    }
?>   