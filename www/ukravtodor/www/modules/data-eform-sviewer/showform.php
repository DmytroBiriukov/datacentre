<?php 
   include("../../../cgi-bin/db_functions.php"); 
   
   $module_name="data-eform-sviewer";
   $module_path="modules/".$module_name."/".$module_name.".php";  
   
   $eform_id=$_POST['eform'];
   $eform_id_share=$_POST['ID_share'];
   
   function setParams($str, $pars)
   { foreach($pars as $name => $value)
     { $name="{".$name."}"; 
	   $str=str_replace($name, $value, $str);
	 }
     return $str;
   }
   
   $mpstring="  "; // to pass POST variables when page should be loaded again
   $gmpstring="  "; 
   $paramstring="WHERE";
   $params=array();
 
  
	  
   foreach($_POST as $key => $val)
   {  if($key != "eform" && $key !="ID_share")
      { $paramstring=$paramstring." ".$key."='".$val."' AND  ";
	    $params[substr($key,2)]=$val;
	  }
	 $mpstring.=" ".$key.":'".$val."', ";
     $gmpstring.=$key."=".$val."&";
	 
   }
 

   
   $mpstring=substr($mpstring,0,-2);
   $gmpstring=substr($gmpstring,0,-1);
   $paramstring=substr($paramstring,0,-5);   
   
   $eformfile="../../../eforms/eform".$eform_id.".xml";
   if (file_exists($eformfile))
   { $eform_xml = simplexml_load_file($eformfile);
   
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
	 foreach($eform_xml->Table as $agg_table)
     {	$table_no++;
        $agg_title=setParams($agg_table->Title[0]->Label,  $params);
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
		
		
		
		if($cellType == 'input')
		{ $dfield=trim($tab_cell->Entity[0]->DataField);
		  $dtab=trim($tab_cell->Entity[0]->DataTable); 
		  $query="SELECT ".$dfield." FROM ".$dtab." ".$paramstring;
  
		  $result = ExecuteQuery($query);				 
          if( mysql_num_rows($result) >0)
          { 
			if ($line = mysql_fetch_array($result, MYSQL_ASSOC))
		    {  echo $line[$dfield];			   
			}
		  }		  
		}else
		if($cellType == 'text')		  
		{ if($tab_cell->Entity[0]->Text !="") echo $tab_cell->Entity[0]->Text; else echo "&nbsp;"; 
		}else 
		echo "&nbsp;"; 
		
		
		
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



