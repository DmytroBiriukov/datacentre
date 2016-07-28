<?php
 include("../../../cgi-bin/db_functions.php");
 $tab_id=$_POST["tabtitle"];
 $condition="";
 $par_condition="";
 $jQueryConstructors="";
 $query1 = " SELECT * FROM module2param WHERE module=".$tab_id." ";
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
 <em>Параметри доступу до програмного модуля:</em></br>
 <?
 while($row = mysql_fetch_assoc($result))
 {
   $ID=$row['ID'];
   $paramtitle=$row['param']; 
   $paramtype=$row['paramtype'];
//   $paramfield=$row['paramfield'];
 ?>  
 <p> 
 <? echo $paramtitle; ?>: &nbsp;
 <?

 switch($paramtype)
 { case 'date': echo "<input type=\"text\" id='param_".$ID."' value='2012' size='4'/>"; $jQueryConstructors.=" $( \"#param_".$ID."\" ).datepicker({dateFormat: 'yy-mm-dd'});"; break;
   case 'char': echo "<input type=\"text\" id='param_".$ID."' value='текст' size='100'/>"; break;
   case 'int': echo "<input type=\"text\" id='param_".$ID."' value='ціле значення' size='10'/>"; break;
   case 'uint': $message='Ціле невід\'ємне значення'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='10'/>"; break;
   case 'float': $message='Дійсне значення'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='20'/>"; break;
   case 'ufloat': $message='Дійсне невід\'ємне значення'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='20'/>"; break;
   case 'percent': $message='Відсотки'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='20'/>";break;
   case 'permile': $message='Перміле'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='20'/>"; break; 
   case 'year': $message='Рік'; echo "<input type=\"text\" id='param_".$ID."' value='".$message."' size='10'/>"; break;    
   case 'region':  RegionList($ID); break;
   case 'fin_source':  FinSourceList($ID); break;   
   default: echo "Невизначений параметр"; break;   
 }
 
 $condition.=" && !isEmpty(document.forms['form0'].elements['param_".$ID."'].value) ";
 $par_condition.=", param_".$ID.": document.forms['form0'].elements['param_".$ID."'].value";
 }
 mysql_free_result($result);
 mysql_close($con); 
?>
<script type="text/javascript">
function form0check()
{ if(document.forms['form0'].elements['startdate'].value != "" && document.forms['form0'].elements['enddate'].value != "" <? echo $condition; ?>)
  {//$('#moduleInfo').load('modules/data-eform-access/graccess.php',{tabtitle:document.forms['form0'].elements['tabtitle'].value, user:document.forms['form0'].elements['user'].value, startdate:document.forms['form0'].elements['startdate'].value, enddate:document.forms['form0'].elements['enddate'].value <? echo $par_condition; ?>}); 
  document.getElementById("moduleInfo").innerHTML= "<? echo $jQueryConstructors."<br>".$condition."<br>".$par_condition."<br>"; ?>";
  } else 
  { document.getElementById("moduleInfo").innerHTML= "<img src=\"images/alert.png\"/>Заповніть інформацією всі обов\'язкові поля";
  }
  document.getElementById("moduleInfo").innerHTML= "<? echo $jQueryConstructors."<br>".$condition."<br>".$par_condition."<br>"; ?>";
  return false;
}
</script>