<?php
include("../../cgi-bin/db_functions.php");
//$_POST['fieldtype']
$value=trim($_POST['update_value']);

if($_POST['datasep']!='.') $value=str_replace($_POST['datasep'],".", $value); 

if($_POST['fieldtype'] == 'input')
{ if($_POST['datatype'] == 'float' && (! is_numeric($value)) ) die("Невірний формат дійсних чисел.");
  if($_POST['datatype'] == 'ufloat' && (! is_numeric($value)) && (floatval($value)>=0) ) die("Невірний формат дійсних невідємних чисел.");     
  if($_POST['datatype'] == 'int' && (! is_int($value)) ) die("Невірний формат цілих чисел."); 
  if($_POST['datatype'] == 'int' && (! is_int($value)) && (intval($value)>=0) ) die("Невірний формат цілих невідємних чисел.");    
}else
 if($_POST['fieldtype'] == 'region')
 { /* ... */
 }else
  if($_POST['fieldtype'] == 'road')
  { /* ... */
  }else
  { /* ... */
  }
$fieldValues=array($_POST['field'] => $value);
$keyValues=array($_POST['keyfield'] => $_POST['keyvalue']);
sqlUpdateQuery($_POST['tab'], $fieldValues, $keyValues);
echo $_POST['update_value'];
?>