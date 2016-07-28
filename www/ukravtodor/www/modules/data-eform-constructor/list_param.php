<?php
 include("../../../cgi-bin/db_functions.php");
 $tab_id=$_POST["tabtitle"];
 $query1 = " SELECT * FROM eform2params WHERE eform=".$tab_id." ";
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
?>
<script language="javascript">
 ParamsNum=0; CriterionNum=0;
</script>
<? 
 while($row = mysql_fetch_assoc($result))
 {
   $ID=$row['ID'];
   $paramtitle=$row['paramtitle']; 
   $paramtype=$row['paramtype'];
   $paramfield=$row['paramfield'];
 ?>  
 <p>  <label for="<? echo "param_".$ID; ?>"><? echo $paramtitle; ?></label><br>
 <?

 switch($paramtype)
 { case 'date': echo "<input type=\"text\" id='param_".$ID."' value='2012' size='4'/>"; break;
   case 'char': echo "<input type=\"text\" id='param_".$ID."' value='текст' size='100'/>"; break;
   case 'int': echo "<input type=\"text\" id='param_".$ID."' value='ціле значення' size='10'/>"; break;
   case 'uint': $message='Ціле невід\'ємне значення'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='10'/>"; break;
   case 'float': $message='Дійсне значення'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='20'/>"; break;
   case 'ufloat': $message='Дійсне невід\'ємне значення'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='20'/>"; break;
   case 'percent': $message='Відсотки'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='20'/>";break;
   case 'permile': $message='Перміле'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='20'/>"; break; 
   case 'region':  RegionList($ID); break;
   case 'fin_source':  FinSourceList($ID); break;   
   default: echo "Невизначений параметр"; break;   
 }
 ?>
<script language="javascript">AddParam(<? echo "'".$paramfield."', 'param_".$ID."' "; ?>);</script>
 </p>
 <?
 }
 mysql_free_result($result);
 mysql_close($con); 

 $query2 = " SELECT * FROM criteria WHERE id IN (SELECT criteria FROM eform2criteria WHERE eform=".$tab_id.")";
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);
 $result2 = mysql_query($query2,$con);
 if(!$result2) 
 {  $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query2;
    die($message);
 }

 while($row = mysql_fetch_assoc($result2))
 {
   $c_ID=$row['id'];
   $c_title=$row['title']; 
   $c_type=$row['type'];
   $c_field=$row['field'];
   $c_tab=$row['tab'];
 ?>
  <script language="javascript">AddCriteion(<? echo "'".$c_ID."', '".$c_title."', '".$c_type."' , '".$c_field."' , '".$c_tab."'"; ?>);</script>

 <?   
 }
 mysql_free_result($result2);
 mysql_close($con); 
 
$query3 = " SELECT * FROM eform WHERE id = ".$tab_id." ";
$con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);
 $result3 = mysql_query($query3,$con);
 if(!$result3) 
 {  $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query3;
    die($message);
 }
 $f_tab="";
 while($row = mysql_fetch_assoc($result3))
 {
   $f_tab=$row['tab'];
 }
 ?>
  <script language="javascript">
    eform_table = '<? echo $f_tab;?>';
	QueryString='SELECT ';/*
	for(var i=0; i<CriterionNum; i+=5)
	{ if(i>0) QueryString+=', ';
 	  QueryString+=CriterionArr[i+3];	  
	}*/
	QueryString+=' FROM '+eform_table+' WHERE ';
	/*
	for(var i=0; i<ParamsNum;i+=2)
	{ if(i>0) QueryString+=' AND ';
 	  QueryString+=ParamsArr[i];
	  QueryString+=' = ';
 	  QueryString+=document.getElementById (ParamsArr[i+1]).value;	  
	}*/

	document.getElementById('forms_list_panel').innerHTML=QueryString;
	document.getElementById('forms_list_panel').style.display="block";
  </script>
 <?    
 mysql_free_result($result3);
 mysql_close($con); 
?>