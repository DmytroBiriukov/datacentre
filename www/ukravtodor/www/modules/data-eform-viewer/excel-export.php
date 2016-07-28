<?php
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; Filename=SavedEform.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
<title>Saves as a Word Doc</title>
</head>
<body>
<?php 

   include("../../../cgi-bin/db_functions.php"); 
   
   function setParams($str, $pars)
   { foreach($pars as $name => $value)
     { $name="{".$name."}"; 
	   $str=str_replace($name, $value, $str);
	 }
     return $str;
   }
   
   $mpstring="  ";
   foreach($_GET as $key => $val)
   {$mpstring.=" ".$key.":'".$val."', ";
   }
   $mpstring=substr($mpstring,0,-2);
   
   
   $module_name="data-eform-viewer";
   $module_path="modules/".$module_name."/".$module_name.".php";  
   $eform_id=$_GET['eform'];
   $eform_id_share=$_GET['ID_share'];    
   $eformfile="../../../eforms/eform".$eform_id.".xml";
   $params=array();
   $param_fields=array();
   $param_types=array();
   $queryparams="";	
   $queryDataTable="";
   $query = " SELECT id, tab, IDfield FROM eform WHERE id=".$eform_id." ;"; 
   $result = ExecuteQuery($query);
   if( mysql_num_rows($result) == 1)
   {   while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { 
	    $queryparams="SELECT * FROM ".$line['tab']." ";	
		$queryDataTable=$line['tab'];		
        $query2 = " SELECT param, value FROM eform2user2param WHERE ID_share=".$eform_id_share." ;"; 
        $result2 = ExecuteQuery($query2);	
		$pstring="tab:'".$queryDataTable."'";
		
        if( mysql_num_rows($result2) >0)
        {  $queryparams.=" WHERE ";
		   while ($line2 = mysql_fetch_array($result2, MYSQL_ASSOC))
		   { $query3 = " SELECT paramfield, paramtype FROM eform2params WHERE ID=".$line2['param']." ;"; 
             $result3 = ExecuteQuery($query3);
			 if( mysql_num_rows($result3) >0)
			 {
			   if(($line3 = mysql_fetch_array($result3, MYSQL_ASSOC)))
			   { $param_fields[$line2['param']]=$line3['paramfield'];	
			     $param_types[$line2['param']]=$line3['paramtype'];	 
			   }
			 }
			 $queryparams.=" p_".$line2['param']."='".$line2['value']."' AND";
			 $pstring.=" , p_".$line2['param'].":'".$line2['value']."'";	
			 switch($param_types[$line2['param']])
			 {case "region": getFieldValue("reg", "title", $line2['value'], $params[$line2['param']]) ; break;
			  default: $params[$line2['param']]=$line2['value']; break;	     
			 }
		   }
		   $queryparams=substr($queryparams,0,-3);
		}
		
      }
   } else echo "<div id='alert'><img src=\"images/alert.png\"/>Ідентифікатор електронної форми не є визначеним в базі даних!</div>";

   
   if (file_exists($eformfile))
   { $eform_xml = simplexml_load_file($eformfile);
?>
<table>
<? 
	 foreach($eform_xml->Table as $eform_table)
     {	 echo "<tr><td>";
	   $eform_title=setParams($eform_table->Title[0]->Label, $params);
	   $table_no=1;
?>
	<h3><? echo $eform_title; ?></h3>
<?  $query_getfields=array();
	$dataTable=array();
	$content_no=0;
	$ind=0; 
	foreach($eform_table->Content as $eform_table_content)
    { $content_serialize=$eform_table_content->Serialize;
      
	  $query_getfields[$content_no]= $queryparams;
	  if($content_serialize=='N') $query_getfields[$content_no].=" LIMIT 0, 1";
	  $dataTable[$content_no]=$queryDataTable;		
	  $dataKey[$content_no]="ID"; 
	  $result=ExecuteQuery($query_getfields[$content_no]);
	  $n=mysql_num_rows($result);  

	  while($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { $ind++;
		$col_no=0;
		foreach($tab_row->Cell as $tab_cell)
      	{ $cellType=$tab_cell->EntityType;

		  $col_no++; 
        }
	  }
	  $content_no++;
	}
?>	  


<? 	 $eform_header=$eform_table->Header;	 
 	 echo "<table ".$eform_header->htm." >";
	 foreach($eform_header->Row as $eform_header_row) 
	 { echo "<tr><td></td>";
	   foreach($eform_header_row->Cell as $eform_header_cell)
	   {  echo "<td ".$eform_header_cell->htm." >".$eform_header_cell->text."</td>"; 		   
	   }
	   echo "</tr>";
	 }
	 
	 	 
	$ind=0; 
    $c_i=0;
	foreach($eform_table->Content as $eform_table_content)
    { $result=ExecuteQuery($query_getfields[$c_i]);
	  $n=mysql_num_rows($result);
	  while($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { $ind++;
	    $a_items=array(); // element id
  	    $t_items=array(); // type
        $n_items=array(); // field name  
		echo "<tr>";  				
?>
			<td></td>
<?
        $colspan=1;
		$col_no=0;
		$tab_row=$eform_table_content->Row[0];
		
		foreach($tab_row->Cell as $tab_cell)
      	{ $colspan++;
		  $cellType=$tab_cell->EntityType;
		  echo "<td ".$tab_cell->htm.">";
			  
		  if($cellType == 'input')
		  { $a_items[]=$tab_cell->Entity[0]->DataField;
			$t_items[]=$tab_cell->Entity[0]->DataType;
			$n_items[]="назва показника"; 			  
?>	              
              <p> <? echo $line[trim($tab_cell->Entity[0]->DataField)];?></p>     
<?              
		  }else
			if($cellType == 'autocomplete')
			{ $a_items[]=$tab_cell->Entity[0]->DataField;
			  $n_items[]="назва показника";		  
?>	              <p> <? echo $line[trim($tab_cell->Entity[0]->DataField)];?></p>
<? 			   
			}else
			  if($cellType == 'counter')		  
			  { echo $ind;
			  }	else
			     if($cellType == 'text')		  
			    { if($tab_cell->Entity[0]->Text !="") echo $tab_cell->Entity[0]->Text; else echo "&nbsp;"; 
			    } else echo "&nbsp;";
		  echo "</td>";
		  $col_no++;			
		}// foreach cell
		echo "</tr>";	  			
	  }// for each line	
      $c_i++;
	}//for each content
?>  
    </table>
	</td></tr> 
<?   $table_no++;
    }// for each Table
?>
</table>
<?
   } 
 
   ?>
   </body>
   </html>


