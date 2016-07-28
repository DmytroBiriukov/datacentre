<?php
  include("../../../cgi-bin/db_functions.php");  
  $module_name="data-import-constructor";
  $module_path="modules/".$module_name."/";  
  $eform=$_POST['eform'];
  $filepath=projecttmppath."/".$eform.".xls";
  
  echo $filepath."<br>";
  
  error_reporting(E_ALL ^ E_NOTICE);
  require_once 'xlsreader.php';
  $data = new Spreadsheet_Excel_Reader(); 
  $data->read($filepath);

?>
<style>
table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:12px;
}
table.excel thead th, table.excel tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align:bottom;
}
table.excel tbody th {
	text-align:center;
	width:20px;
}
table.excel tbody td {
	vertical-align:bottom;
}
table.excel tbody td {
    padding: 0 3px;
	border: 1px solid #EEEEEE;
}
</style>

<?


   // Set output Encoding.
  $data->setOutputEncoding('CP1251');
  
  /*  */

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
**/


 $data->setRowColOffset(0);


/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
**/
   
  
   error_reporting(E_ALL ^ E_NOTICE);
   /*
   echo "<br> data->sheets[0][numRows]=".$data->sheets[0]['numRows']."<br>";
   echo "<br> data->sheets[0][numCols]=".$data->sheets[0]['numCols']."<br>";
   echo "<br> data->sheets[0][cells][2][2]=".$data->sheets[0]['cells'][2][2]."<br>";
   */
?>
<em>Клікніть по комірці та виберіть показник, який з нею пов'язаний</em>
<?   
   $sheet_count=count($data->sheets);
//   echo "<br> sheet_count=".$sheet_count."<br>";
   for($sheet_index=0; $sheet_index<$sheet_count; $sheet_index++) 
   {
?>
<table border="2">
<?  
   for($i = 1; $i <= $data->sheets[$sheet_index]['numRows']; $i++)
   { 
?>
	<tr>
<? 	     
        for($j = 0; $j <= $data->sheets[$sheet_index]['numCols']; $j++)
           echo "<td id='i_".$i."_j_".$j."' onclick=\"openCellDialog('".$i."','".$j."');\">".$data->sheets[$sheet_index]['cells'][$i][$j]."</td>";        
?>
	</tr>
<?		
  } 
?>
</table>
<?
  }
?>