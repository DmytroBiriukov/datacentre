<?php
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment; Filename=SavedAggregateAsWordDoc.doc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<title>Зберегти як Word Doc</title>
</head>
<body>

<?php 
   include("../../../cgi-bin/db_functions.php"); 
   
   $module_name="data-aggregate-viewer";
   $module_path="modules/".$module_name."/".$module_name.".php";  
   
   $agg_id=$_GET['aggregate'];
   $agg_eform=$_GET['eform'];
   $paramstring="WHERE";
   foreach($_GET as $k=>$v)
   { if($k != "aggregate" && $k != "eform") $paramstring=$paramstring." ".$k."='".$v."' AND  ";
   }
   $paramstring=substr($paramstring,0,-5);
//   echo $paramstring;
   $agg_file="../../../aggs/agg".$agg_id.".xml";
   if (file_exists($agg_file))
   { $agg_xml = simplexml_load_file($agg_file);
   
	 $table_no=0;
	 foreach($agg_xml->Table as $agg_table)
     {	$table_no++;
        $agg_title=$agg_table->Title[0]->Label;
?>
	<h3><? echo $agg_title; ?></h3>
<?  
	 $eform_header=$agg_table->Header;
	 
 	 echo "<table ".$eform_header->htm." >";
	 foreach($eform_header->Row as $eform_header_row) 
	 { echo "<tr>";	   
	   foreach($eform_header_row->Cell as $eform_header_cell)
	   {  echo "<td ".$eform_header_cell->htm." >".$eform_header_cell->text."</td>"; 		   
	   }
	   echo "</tr>";
	 }

	foreach($agg_table->Content as $eform_table_content)
    { $tab_row=$eform_table_content->Row[0];
	  echo "<tr>";
	  foreach($tab_row->Cell as $tab_cell)
      { $cellType=$tab_cell->EntityType;
	    echo "<td ".$tab_cell->htm.">";
		if($cellType == 'function')
		{ $dfield_a=explode(" ",trim($tab_cell->Entity[0]->DataField));
		  $dfield=implode("+", $dfield_a);
		  $dtab=trim($tab_cell->Entity[0]->DataTable); 
		  // $dtab="data_".$agg_eform;
		  $dfunction=trim($tab_cell->Entity[0]->DataFormat); 		  
		  $query="SELECT ".$dfunction."(".$dfield.") as s FROM ".$dtab." ".$paramstring;
//		  echo 	$query;	  
		  $result = ExecuteQuery($query);				 
          if( mysql_num_rows($result) >0)
          { 
			if ($line = mysql_fetch_array($result, MYSQL_ASSOC))
		    {  echo $line['s'];			   
			}
		  }		  
		}else
		if($cellType == 'text')		  
		{ if($tab_cell->Entity[0]->Text !="") echo $tab_cell->Entity[0]->Text; else echo "&nbsp;"; 
		}
		echo "</td>";
   	  }// foreach cell
 	  echo "</tr>";	  			
	}//for each content
?>  </table>
<?   
    }// for each Table
   }// if eform file exists 
   else echo "<p>немає файлу опису</p>";
 
?> 
</body>
</html>


