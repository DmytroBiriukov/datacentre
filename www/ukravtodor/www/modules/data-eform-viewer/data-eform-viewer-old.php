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
   
   
/*    $regions_arr="{'1':'АР Крим','2':'Вінницька обл.','3':'Волинська обл.','4':'Дніпропетровська обл.','5':'Донецька обл.','6':'Житомирська обл.','7':'Закарпатська обл.','8':'Запорізька обл.','9':'Івано-Франківська обл.','10':'Київська обл.','11':'Кіровоградська обл.','12':'Луганська обл.','13':'Львівська обл.','14':'Миколаївська обл.','15':'Одеська обл.','16':'Полтавська обл.','17':'Рівненська обл.','18':'Сумська обл.','19':'Тернопільська обл.','20':'Харківська обл.','21':'Херсонська обл.','22':'Хмельницька обл.','23':'Черкаська обл.','24':'Чернівецька обл.','25':'Чернігівська обл.','26':'м. Київ','27':'м. Севастополь'}";
 $roads_arr="{'1':'М-01','2':'М-02','3':'М-03','4':'М-04','5':'М-05','6':'М-06','7':'М-07','8':'М-08','9':'М-09','10':'М-10','11':'М-11','12':'М-12','13':'М-13','14':'М-14','15':'М-15','16':'М-16','17':'М-17','18':'М-18','19':'М-19','20':'М-20','21':'М-21','22':'М-22','23':'М-23','24':'Н-01','25':'Н-02','26':'Н-03','27':'Н-04','28':'Н-05','29':'Н-06','30':'Н-07','31':'Н-08','32':'Н-09','33':'Н-10','34':'Н-11','35':'Н-12','36':'Н-13','37':'Н-14','38':'Н-15','39':'Н-16','40':'Н-17','41':'Н-18','42':'Н-19','43':'Н-20','44':'Н-21','45':'Н-22','46':'Н-23','47':'Р-01','48':'Р-02','49':'Р-03','50':'Р-04','51':'Р-05','52':'Р-06','53':'Р-07','54':'Р-08','55':'Р-09','56':'Р-10','57':'Р-11','58':'Р-12','59':'Р-13','60':'Р-14','61':'Р-15','62':'Р-16','63':'Р-17','64':'Р-18','65':'Р-19','66':'Р-20','67':'Р-21','68':'Р-22','69':'Р-23','70':'Р-24','71':'Р-25','72':'Р-26','73':'Р-27','74':'Р-28','75':'Р-29','76':'Р-30','77':'Р-31','78':'Р-32','79':'Р-33','80':'Р-34','81':'Р-35','82':'Р-36','83':'Р-37','84':'Р-38','85':'Р-39','86':'Р-40','87':'Р-41','88':'Р-42','89':'Р-43','90':'Р-44','91':'Р-45','92':'Р-46','93':'Р-47','94':'Р-48','95':'Р-49','96':'Р-50','97':'Р-51','98':'Р-52','99':'Р-53','100':'Р-54','101':'Р-55','102':'Р-56','103':'Р-57','104':'Р-58','105':'Р-59','106':'Р-60','107':'Р-61','108':'Р-62','109':'Р-63','110':'Р-64','111':'Р-65','112':'Р-66','113':'Р-67','114':'Р-68'} ";
*/
   $regions_arr=[1 => 'АР Крим',2 => 'Вінницька обл.', 3 =>'Волинська обл.',4 =>'Дніпропетровська обл.', 5=>'Донецька обл.',6=>'Житомирська обл.',7=>'Закарпатська обл.',8=>'Запорізька обл.'];
   $roads_arr=[1=>'М-01',2=>'М-02',3=>'М-03',4=>'М-04',5=>'М-05',6=>'М-06',7=>'М-07',8=>'М-08',9=>'М-09',10=>'М-10',11=>'М-11',12=>'М-12'];

   $module_name="data-eform-viewer";
   $module_path="modules/".$module_name."/".$module_name.".php";  
   $eform_id=$_POST['eform'];
   $eform_id_share=$_POST['ID_share'];  
//   echo   "eform_id_share=".$eform_id_share."</br>";
   $eformfile="../../../eforms/eform".$eform_id.".xml";
   $params=array();
   $param_fields=array();
   $param_types=array();
   $addRecordParams=array();
   $queryparams="";	
   $queryDataTable="";
   $query = " SELECT id, tab, IDfield FROM eform WHERE id=".$eform_id." ;"; 
//   echo $query."</br>";
   $result = ExecuteQuery($query);
   if( mysql_num_rows($result) == 1)
   {   while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { 
	    $queryparams="SELECT * FROM ".$line['tab']." ";	
		$queryDataTable=$line['tab'];		
        $query2 = " SELECT param, value FROM eform2user2param WHERE ID_share=".$eform_id_share." ;"; 
        $result2 = ExecuteQuery($query2);	
		$pstring="tab:'".$queryDataTable."'";
		
//		   echo $query2."</br>";
		
		
        if( mysql_num_rows($result2) >0)
        {  $queryparams.=" WHERE ";
		   while ($line2 = mysql_fetch_array($result2, MYSQL_ASSOC))
		   { $query3 = " SELECT paramfield, paramtype FROM eform2params WHERE ID=".$line2['param']." ;"; 
             $result3 = ExecuteQuery($query3);
			 
//			    echo $query3."</br>";
			 
			 
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
<script type="text/javascript" src="js/jquery.jeditable.js"></script>
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
    $('.check:button').toggle(function(){
        $('input:checkbox').attr('checked','checked');
        $(this).val('Відмінити всі рядки')
    },function(){
        $('input:checkbox').removeAttr('checked');
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
    
<script language="javascript">
<!--
$(function(){
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
	  $result=ExecuteQuery($query_getfields[$content_no]);
	  $n=mysql_num_rows($result);  

	  if($content_serialize=='N' && $n==0)
      { // create one record!
	    $fieldValues=array();
		foreach($addRecordParams as $k => $v) $fieldValues[$k]=$v;
		sqlInsertQuery($dataTable[$content_no], $fieldValues);     
	  }
	    
	  while($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { $ind++;
		$col_no=0;
		foreach($tab_row->Cell as $tab_cell)
      	{ $id_cell++;
		  $cellType=$tab_cell->EntityType;
		  if($cellType == 'input')
		  { // tab, keyvalue keyfield, field, value
?>	 
	  $("#ph_<? echo $eform_id."_".$table_no."_".$id_cell;?>").editable("http://"+ip_server+"/src/inDBPlaceEdit.php", 
	  												       { indicator : "<img src='img/indicator.gif'>", 
														     type   : 'textarea',  															 
															 select : true, 
															 submit : 'Змінити', 
															 cancel : 'Відмінити', 
															 cssclass : "editable"
														   }); 
<?	      }else
		  if($cellType == 'autocomplete')
		  { // tab, keyvalue keyfield, field, value
		    $autocompleteType= $tab_cell->Entity[0]->Autocomplete;
			if($autocompleteType=='regions')
			{
?>	  
	  $("#ph_<? echo $eform_id."_".$table_no."_".$id_cell;?>").editable("http://"+ip_server+"/src/inDBPlaceEdit.php",
	  														{ indicator : "<img src='img/indicator.gif'>",
														      data   : '<? print  json_encode($regions_arr);?>',
														      type   : 'select', 
															  submit : "Змінити", 
															  cancel : "Відмінити", 
															  style  : "inherit"
 															});  
<?			}else
			{ if($autocompleteType=='numbways')
			  {
?>	  
	  $("#ph_<? echo $eform_id."_".$table_no."_".$id_cell;?>").editable("http://"+ip_server+"/src/inDBPlaceEdit.php",
	  														{ indicator : "<img src='img/indicator.gif'>",
															  data   : '<?php print  json_encode($roads_arr); ?>',
     														  type   : 'select',
															  submit : "Змінити", 
															  cancel : "Відмінити", 
															  style  : "inherit"
 															});   
<?					  
				  
			  }// end if autocompleteType=='numbways'
			  
			  
			}
		  }// end if  cellType == 'autocomplete'
		  $col_no++; 
        }// end for cell
	  }
	  $content_no++;
	}
?>	  
		
			});
-->
</script>


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
	  	  
	  
	  while($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { $ind++;
	    $a_items=array(); // element id
  	    $t_items=array(); // type
        $n_items=array(); // field name  
		echo "<tr class=\"data_block\">";  				
 		if($content_serialize=='Y')
		{
?>	
      <form id='form_<? echo $ind;?>' name='form_<? echo $ind;?>' method='post' action='../cgi-bin/dataManipulation.php' target='_self'>
    	<input type="hidden" name="tab" value="<? echo $dataTable[$c_i]; ?>">
	    <input type="hidden" name="key_field" value="<? echo $dataKey[$c_i]; ?>">
        <input type="hidden" name="key_value" value="<? echo $line[$dataKey[$c_i]]; ?>">                      
		<input type="hidden" name="action" value="UPDATE"> 
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
		  echo "<td ".$tab_cell->htm.">";
			  
		  if($cellType == 'input')
		  { $a_items[]=$tab_cell->Entity[0]->DataField;
			$t_items[]=$tab_cell->Entity[0]->DataType;
			$n_items[]="назва показника"; 			  
?>	              
              <p class="editable_textarea" id="ph_<? echo $eform_id."_".$table_no."_".$id_cell;?>"> <? echo $line[trim($tab_cell->Entity[0]->DataField)];?></p>     
<?              
		  }else
			if($cellType == 'autocomplete')
			{ $a_items[]=$tab_cell->Entity[0]->DataField;
			  $n_items[]="назва показника";		  
?>	              <p class="editable_textarea" id="ph_<? echo $eform_id."_".$table_no."_".$id_cell;?>"> <? echo $line[trim($tab_cell->Entity[0]->DataField)];?></p>
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
 		if($content_serialize=='Y')
		{
?>	 </form>
<?		}
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
<?
   } else
   { 
?> 
  <script language="javascript">document.getElementById("moduleInfo").innerHTML= "<div id='alert'><img src=\"images/alert.png\"/>Не можливо знайти шаблон звітньої форми </div>";</script>
<?
   }
?>



