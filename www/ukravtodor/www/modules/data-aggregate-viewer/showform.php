<?php 
   include("../../../cgi-bin/db_functions.php"); 
   
   $module_name="data-aggregate-viewer";
   $module_path="modules/".$module_name."/".$module_name.".php";  
   
   $agg_id=$_POST['aggregate'];
   $agg_eform=$_POST['eform'];
   $paramstring="WHERE";
   $gmpstring="  "; 
   foreach($_POST as $k=>$v)
   { if($k != "aggregate" && $k != "eform") $paramstring=$paramstring." ".$k."='".$v."' AND  ";
     $gmpstring.=$k."=".$v."&";
   }
   $paramstring=substr($paramstring,0,-5);
   $gmpstring=substr($gmpstring,0,-1);
   $agg_file="../../../aggs/agg".$agg_id.".xml";
   if (file_exists($agg_file))
   { $agg_xml = simplexml_load_file($agg_file);
   
//   echo $paramstring;
?>

<script language="javascript">
document.getElementById("moduleInfo").innerHTML= "";
$(function()
{ $( "#accordion" ).accordion();
});
</script>
		 <a href="modules/<? echo $module_name; ?>/word-export.php?<? echo trim($gmpstring); ?>" target="_blank" title="Зберегти в форматі MS Word"><img src="images/wordprocessing_32.png" title="Зберегти в форматі MS Word"/>Зберегти в форматі MS Word</a>
<div id="accordion">
<?

	 $table_no=0;
	 foreach($agg_xml->Table as $agg_table)
     {	$table_no++;
        $agg_title=$agg_table->Title[0]->Label;
?>
	<h3><a href="#"><? echo $agg_title; ?></a></h3>
	<div>
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
	</div> <!-- [end] accordion tab -->
<?   
    }// for each Table
?>
</div> <!-- [end] accordion -->
<?


   }// if eform file exists 
   else
   { 
?> 
  <script language="javascript">document.getElementById("moduleInfo").innerHTML= "<div id='alert'><img src=\"images/alert.png\"/>Не можливо знайти шаблон агрегації даних </div>";</script>
<?
   }
?>



