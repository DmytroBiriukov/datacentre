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
   $gmpstring="  ";
   foreach($_POST as $key => $val)
   {$mpstring.=" ".$key.":'".$val."', ";
    $gmpstring.=$key."=".$val."&";
   }
   $mpstring=substr($mpstring,0,-2);
   $gmpstring=substr($gmpstring,0,-1);
   
   $regions_arr=[1 => 'АР Крим',2 => 'Вінницька обл.', 3 =>'Волинська обл.',4 =>'Дніпропетровська обл.', 5=>'Донецька обл.',6=>'Житомирська обл.',7=>'Закарпатська обл.',8=>'Запорізька обл.'];
   $roads_arr=[1=>'М-01',2=>'М-02',3=>'М-03',4=>'М-04',5=>'М-05',6=>'М-06',7=>'М-07',8=>'М-08',9=>'М-09',10=>'М-10',11=>'М-11',12=>'М-12'];

   $module_name="data-eform-viewer";
   $module_path="modules/".$module_name."/".$module_name.".php";  
   $eform_id=$_POST['eform'];
   $eform_id_share=$_POST['ID_share'];  
   $eformfile="../../../eforms/eform".$eform_id.".xml";
   $params=array();
   $param_fields=array();
   $param_types=array();
   $addRecordParams=array();
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
			 $addRecordParams["p_".$line2['param'].""]=	$line2['value'];
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
<script type="text/javascript" src="js/jeip.js"></script>
<script language="javascript">
document.getElementById("moduleInfo").innerHTML= "";

function delete_record(tab)
{ if(confirm('Ви справді бажаєте видалити відмічені записи?'))
  { var sList = "";
    $('input:checkbox').each( 
		function () 
		{ if (this.checked) sList += $(this).attr('id');
   	 	});
    
	$('#moduleInfo').load('modules/data-eform-viewer/del-record.php',{table: tab, keyfield: 'ID', keyvalue: sList});
	
	$('#moduleContent').load('<? echo $module_path;?>', {<? echo $mpstring; ?>});
  }       
}

var message=" ";

$(function()
{ $( "#accordion" ).accordion();
});

$(document).ready(function(){
    $('.check:button').toggle(
		function()
		{ $('input:checkbox').attr('checked','checked');
          $(this).val('Відмінити всі рядки')
        },
		function()
		{ $('input:checkbox').removeAttr('checked');
          $(this).val('Вибрати всі рядки');        
        })
})
</script>
<style>
.data_block td:hover { border: none; outline: solid 1px #F90; }
.data_block tr:hover td { background-color:#FFFF99;} 
</style>
<div style="min-height:65px"><img src="modules/<? echo $module_name; ?>/<? echo $module_name; ?>-large.png" style="display:inline; float:left"/>   
 <a style="display:inline; float:right" href="modules/<? echo $module_name; ?>/word-export.php? <? echo $gmpstring; ?>" target="_blank" title="Зберегти в форматі MS Word"><img src="images/wordprocessing_32.png" title="Зберегти в форматі MS Word"/>Зберегти в форматі MS Word</a>
</div>
<div id="accordion">
<?
	 $table_no=0;
	 foreach($eform_xml->Table as $eform_table)
     {	$table_no++; 
	    $eform_title=setParams($eform_table->Title[0]->Label, $params);
	   
?>


	<h3><a href="#"><? echo $eform_title; ?></a></h3>
	<div>
    

<?  $query_getfields=array();
	$dataTable=array();
	$content_no=0;
	$ind=0; 
	$id_cell=0;
	foreach($eform_table->Content as $eform_table_content)
    { $content_serialize=$eform_table_content->Serialize;
      
	  $query_getfields[$content_no]= $queryparams;
	  if($content_serialize=='N') $query_getfields[$content_no].=" LIMIT 0, 1";
	  $dataTable[$content_no]=$queryDataTable;		
	  $dataKey[$content_no]="ID"; 
	  $content_no++;
	}
?>	  



<? 	 $eform_header=$eform_table->Header;
	 if($content_serialize=='Y')
	 {
	    ?>  
        <input type="button" class="check" value="Вибрати всі рядки" />
	    <a onClick="javascript: $('#moduleInfo').load('modules/<? echo $module_name; ?>/add-record.php',{<? echo $pstring; ?>}); $('#moduleContent').load('<? echo $module_path;?>', {<? echo $mpstring; ?>});" title="Вставити новий запис"><img src="images/add_32.png" title="Вставити новий запис"/>Вставити новий запис</a>
	    <a onClick="delete_record('<? echo $queryDataTable;?>');" title="Видалити відмічені записи"><img src="images/delete_32.png" title="Видалити відмічені записи"/>Видалити відмічені записи</a>               
		<?
	 }
?>

	            
<?	 
 	 echo "<table ".$eform_header->htm." >";
	 foreach($eform_header->Row as $eform_header_row) 
	 { echo "<tr>";
	   if($content_serialize=='Y') echo "<td></td>";
	   foreach($eform_header_row->Cell as $eform_header_cell)
	   {  echo "<td ".$eform_header_cell->htm." >".$eform_header_cell->text."</td>"; 		   
	   }
	   echo "</tr>";
	 }
?>  <div class="data_block">
<?	 
	$ind=0; 
    $c_i=0;
    $id_cell=0;
	foreach($eform_table->Content as $eform_table_content)
    { $result=ExecuteQuery($query_getfields[$c_i]);
	      $n=mysql_num_rows($result); 
	      if($content_serialize=='N' && $n==0)
          { // create one record!
	        $fieldValues=array();
		    foreach($addRecordParams as $k => $v) $fieldValues[$k]=$v;
		    sqlInsertQuery($dataTable[$content_no], $fieldValues);  
			mysql_free_result($result);
			$result=ExecuteQuery($query_getfields[$c_i]); 
	      }	
	  	  
	  
	  while($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { $ind++;
	    $a_items=array(); // element id
  	    $t_items=array(); // type
        $n_items=array(); // field name  
		echo "<tr class=\"data_block\">";  				
 		if($content_serialize=='Y')
		{
?>	
           <td>
           <input type="checkbox" class="cb-element" id="ch_<? echo $line[$dataKey[$c_i]]; ?>"> 
           </td>
<?		}
        $colspan=1;
		$col_no=0;
		$tab_row=$eform_table_content->Row[0];
		
		foreach($tab_row->Cell as $tab_cell)
      	{ $id_cell++;
		  $colspan++;
		  $cellType=$tab_cell->EntityType;
		  $dfield=trim($tab_cell->Entity[0]->DataField);
		  $identif="ph_".$eform_id."_".$line['ID']."_".$dfield;
		  echo "<td ".$tab_cell->htm.">";
			  
		  if($cellType == 'input')
		  { 
?>	              
              <p class="editable_textarea" id='<? echo $identif;?>'> <? echo $line[trim($tab_cell->Entity[0]->DataField)];?></p>     
<?              
		  }else
			if($cellType == 'autocomplete')
			{ 	  
?>	          <p class="editable_textarea" id='<? echo $identif;?>'> <? echo $line[trim($tab_cell->Entity[0]->DataField)];?></p>
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
?>  </div> <!-- [end] data_block -->
    </table>
	</div> <!-- [end] accordion tab -->
<?   
    }// for each Table
?>
</div> <!-- [end] accordion -->
<script language="javascript">
<?
	 $table_no=0;
	 foreach($eform_xml->Table as $eform_table)
     {	$table_no++; 
	    $id_cell=0;
	    foreach($eform_table->Content as $eform_table_content)
        { $content_serialize=$eform_table_content->Serialize;
		  $query_cells = $queryparams;
		  if($content_serialize=='N') $query_cells .=" LIMIT 0, 1"; 
	      $result=ExecuteQuery($query_cells );
	  
		  while($line = mysql_fetch_array($result, MYSQL_ASSOC))
     	  { $ind++;
			$col_no=0;
			foreach($tab_row->Cell as $tab_cell)
      		{ $id_cell++;
			  $cellType=$tab_cell->EntityType;
			  $dfield=trim($tab_cell->Entity[0]->DataField);
			  $identif="#ph_".$eform_id."_".$line['ID']."_".$dfield;
			  if($cellType == 'input')
		 	  { 
?>	 
												   
	$("<? echo $identif;?>").eip( "http://"+ip_server+"/src/inDBPlaceEdit.php", { 
		form_type: "textarea"
	} );														    
<?				   		
			  }else
		  	  if($cellType == 'autocomplete')
		      { // tab, keyvalue keyfield, field, value
		         $autocompleteType= $tab_cell->Entity[0]->Autocomplete;
			     if($autocompleteType=='regions')
			     {
?>	
	$("<? echo $identif;?>").eip( "http://"+ip_server+"/src/inDBPlaceEdit.php", { 
		form_type: "select",
		select_options: <? print  json_encode($regions_arr);?>
	} );   
<?			     }else
			     { if($autocompleteType=='numbways')
			       {
?>	  
	$("<? echo $identif;?>").eip( "http://"+ip_server+"/src/inDBPlaceEdit.php", { 
		form_type: "select",
		select_options: <? print  json_encode($roads_arr);?>
	} );   
<?					  
				  
			        }// end if autocompleteType=='numbways'
			      }// end else autocomplete == numbways
		       }// end if  cellType == 'autocomplete'
			}// foreach Cell
		  }// end while mysql_fetch_array
		}// end foreach Content
	 }// end foreach Table
?>
</script>
<?
   }// if eform file exists 
   else
   { 
?> 
  <script language="javascript">document.getElementById("moduleInfo").innerHTML= "<div id='alert'><img src=\"images/alert.png\"/>Не можливо знайти шаблон звітньої форми </div>";</script>
<?
   }
?>



