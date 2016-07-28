<?php
// start the output buffer
ob_start(); ?>
<?php 
   include("../../../cgi-bin/db_functions.php"); 
   
   function setParams($str, $pars)
   { foreach($pars as $name => $value)
     { $name="{".$name."}"; 
	   $str=str_replace($name, $value, $str);
	 }
     return $str;
   }
   
   $mpstring="  "; // to pass POST variables when page should be loaded again
   $gmpstring="  "; 
   foreach($_POST as $key => $val)
   {$mpstring.=" ".$key.":'".$val."', ";
    $gmpstring.=$key."=".$val."&";
   }
   $mpstring=substr($mpstring,0,-2);
   $gmpstring=substr($gmpstring,0,-1);
   
   $args_f=array();
   $sign_f=array();
   $type_f=array();
   $result_f=array();
   $fields_f=array();
   $sep_f=array();
   $no_f=0;
  /* 
   $regions_arr=[1 => 'АР Крим',2 => 'Вінницька обл.', 3 =>'Волинська обл.',4 =>'Дніпропетровська обл.', 5=>'Донецька обл.',6=>'Житомирська обл.',7=>'Закарпатська обл.',8=>'Запорізька обл.'];
   $roads_arr=[1=>'М-01',2=>'М-02',3=>'М-03',4=>'М-04',5=>'М-05',6=>'М-06',7=>'М-07',8=>'М-08',9=>'М-09',10=>'М-10',11=>'М-11',12=>'М-12'];
*/
$regions_arr="АР Крим, Вінницька обл., Волинська обл., Дніпропетровська обл., Донецька обл., Житомирська обл.,Закарпатська обл.,Запорізька обл.";
$roads_arr="М-01,М-02,М-03,М-04,М-05,М-06,М-07,М-08,М-09,М-10,М-11,М-12";


   $module_name="data-eform-viewer";
   $module_path="modules/".$module_name."/".$module_name.".php";  
   $eform_id=$_POST['eform'];
   $eform_id_share=$_POST['ID_share'];  
   $eformfile="../../../eforms/eform".$eform_id.".xml";
   $params=array();
   $param_fields=array();
   $param_types=array();
   $addRecordParams=array(); // array of parameters and their values to create first record in DBtable, when it not exist
   $queryparams="";	
   $queryparams_p="";
   $queryDataTable=""; // table where data is stored
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
			 $queryparams_p.=$queryparams_p;
			 $pstring.=" , p_".$line2['param'].":'".$line2['value']."'";
			 $addRecordParams["p_".$line2['param'].""]=	$line2['value'];
			 switch($param_types[$line2['param']])
			 {case "region": getFieldValue("reg", "title", $line2['value'], $params[$line2['param']]) ; break;
			  default: $params[$line2['param']]=$line2['value']; break;	     
			 }
		   }
		   $queryparams=substr($queryparams,0,-3);
		   $queryparams_p=substr($queryparams_p,0,-3);
		}
		
      }
   } else echo "<div id='alert'><img src=\"images/alert.png\"/>Ідентифікатор електронної форми не є визначеним в базі даних!</div>";

   
   if (file_exists($eformfile))
   { $eform_xml = simplexml_load_file($eformfile);
?>
<script type="text/javascript" src="js/jquery.editinplace.js"></script>
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
	  	  
	  $row_num=mysql_num_rows($result);
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
		  { //;
?>	              
              <p class="editable_textarea" id='<? echo $identif;?>'> <? echo str_replace(".", trim($tab_cell->Entity[0]->DataSeparator), $line[trim($tab_cell->Entity[0]->DataField)]);?></p>     
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
			    } else 
				if($cellType == 'function')
				{ //fargs
				  $args_f[]=$tab_cell->Entity[0]->DataField;
				  $fields_f[]=$eform_id." ".$row_num;
				  //ftype
				  
				  $type_f[]=trim($tab_cell->Entity[0]->DataFormat);
				  $sep_f[]=trim($tab_cell->Entity[0]->DataSeparator);
				  $no_f++;
				  $result_f[]="F_".$no_f;	
				  
				  
				  
				  ?>
				  <p id='<? echo "F_".$no_f; ?>' style="background-color:#FF9933">  <? echo "F_".$no_f."=".$tab_cell->Entity[0]->DataFormat."(".$tab_cell->Entity[0]->DataField.")";?></p> 
                  <?
				  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
				  /*
				  
		  $dfield_ap=explode(" ",trim($tab_cell->Entity[0]->DataField));
		  $dfield_p=implode("+", $dfield_ap);
		  $dtab_p=trim($tab_cell->Entity[0]->DataTable); 
		  $dfunction_p=trim($tab_cell->Entity[0]->DataFormat); 		  
		  $query_p="SELECT ".$dfunction_p."(".$dfield_p.") as s FROM ".$dtab_p." WHERE ".$queryparams_p;
		  $result_p = ExecuteQuery($query_p);				 
          if( mysql_num_rows($result_p) >0)
          { 
			if ($line_p = mysql_fetch_array($result_p, MYSQL_ASSOC))
		    {  echo $line_p['s'];			   
			}
		  }	
				  
					<EntityType>function</EntityType>
					<Entity>
						<DataField>W_1256</DataField>
						<DataTable>data_10</DataTable>
						<DataType>function</DataType>
						<DataFormat>SUM</DataFormat>
						<DataDecimals>3</DataDecimals>
						<DataSeparator>.</DataSeparator>
					</Entity>                                                      				
				  */
				  
				  
				  
				}else echo "&nbsp;";
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
function my_trim(str) 
{ str = str.replace(/^\s+/, '');
  for (var i=str.length - 1; i >= 0; i--) 
   if(/\S/.test(str.charAt(i))) { str = str.substring(0, i + 1); break; }
  return str;
}
/* type SUM | AVR 
*/
function fhandle(ftype, fresult, fargs, fsep, fsign)
{   
    var s=0.0; var value=0.0;
    var text='';
    for (var i=0; i < fargs.length; i++)
   { text=my_trim( document.getElementById(fargs[i]).innerHTML);
     value = parseFloat(text.replace(",", "."));
	 if(fsign[i] == "+") s=s+value;
	 else if(fsign[i] == "-") s=s-value;
	      else if(fsign[i] == "/") s=s+value; 
		  /*  ????????????????????????
		  */
   }
   if(ftype == 'AVR') s=s / a.length;
   var str=s.toString();
   /*if(fsep != ".") str.replace(".", fsep);*/
   document.getElementById(fresult).innerHTML=str;
}
var sep_f=<? 
  $a="[ "; 
  foreach($sep_f as $k2) { $a=$a."\""; $a=$a.$k2; $a=$a."\",";} 
  $a=substr($a,0,-1); 
  $a.=" ]"; 
  echo $a; 
?>;
var args_f=<? 
  $i=0;
  $a="[ ";
  $sa="[ "; 
  foreach($args_f as $k)
  { $b=explode(" ",$k);
    $z=explode(" ",$fields_f[$i]);
	$eform_id_z=$z[0];
	$row_num_z=$z[1];
	$i++;
    $a.=" [";
	$sa.=" ["; 
    foreach($b as $c)
	{ $c_arr=array();  
	  $sa.="\"+\",";	  
	  $c_arr=explode("-",$c);
	  if(count($c_arr)>1) { $sa.="\"-\",";}
	  else
	  { $c_arr=explode("/",$c);
	    if(count($c_arr)>1) { $sa.="\"/\",";}
	  }
	  
	  for($j=1; $j<=$row_num_z;$j++)
	  { foreach($c_arr as $cc)
	    { $a=$a."\"ph_".$eform_id_z."_".$j."_".$cc."\","; 
		}
	  }
	}
	$a=substr($a,0,-1);
    $a.="],";
	$sa=substr($sa,0,-1);
    $sa.="],";	
  } 
  $a=substr($a,0,-1);
  $a.=" ]";
  $sa=substr($sa,0,-1);
  $sa.=" ]";
  echo $a;
?>;
var sign_f=<? 
  echo $sa;
?>;
var type_f=<? 
  $a="[ "; 
  foreach($type_f as $k2) { $a=$a."\""; $a=$a.$k2; $a=$a."\",";} 
  $a=substr($a,0,-1); 
  $a.=" ]"; 
  echo $a; 
?>;
var result_f=<? 
  $a="[ "; 
  foreach($result_f as $k3){ $a=$a."\""; $a=$a.$k3; $a=$a."\",";} 
  $a=substr($a,0,-1); 
  $a.=" ]"; 
  echo $a; 
?>;
function updateFields(id_e)
{ /* #ph_$eform_id_$line[ID]_$dfield
*/
   var n_t=type_f.length;
   var n_r=result_f.length;   
   var n_a=args_f.length;
   
   for(var i=0; i<n_t; i++)
   { 
/*   */      
   } 
   
}

function updateAllFunctionFields()
{  var n_t=type_f.length;
   var n_r=result_f.length;   
   var n_a=args_f.length;  
   for(var i=0; i<n_r; i++)
   { fhandle(type_f[i], result_f[i], args_f[i], sep_f[i], sign_f[i]);
   } 
}

$(document).ready(function(){
<?   $eform_xml2 = simplexml_load_file($eformfile);
	 $table_no=0;
	 foreach($eform_xml2->Table as $eform_table2)
     {	$table_no++; 
	    $id_cell=0;
	    foreach($eform_table2->Content as $eform_table_content2)
        { $content_serialize=$eform_table_content2->Serialize;
		  $query_cells = $queryparams;
		  if($content_serialize=='N') $query_cells .=" LIMIT 0, 1"; 
	      $result=ExecuteQuery($query_cells );
	      
		  while($line = mysql_fetch_array($result, MYSQL_ASSOC))
     	  { $ind++;
			$col_no=0;
			$tab_row2=$eform_table_content2->Row[0];
			foreach($tab_row2->Cell as $tab_cell)
      		{ $id_cell++;
			  $cellType=$tab_cell->EntityType;
			  $dfield=trim($tab_cell->Entity[0]->DataField);
			  $identif="#ph_".$eform_id."_".$line['ID']."_".$dfield;
			  if($cellType == 'input')
		 	  {  
?>	 
												   
	$('<? echo $identif;?>').editInPlace({
		postclose: function() { /*updateFields('<? echo $identif;?>');*/ updateAllFunctionFields()},
        url: "http://"+ip_server+"/src/inDBPlaceEdit.php",
        params: "tab=<? echo $queryDataTable;?>&field=<? echo $dfield; ?>&keyvalue=<? echo $line['ID'];?>&keyfield=ID&fieldtype=input&datatype=<? echo $tab_cell->Entity[0]->DataType;?>&datasep=<? echo $tab_cell->Entity[0]->DataSeparator;?>",
		show_buttons: true
	});										    
<?				   		
			  }else
		  	  if($cellType == 'autocomplete')
		      { // tab, keyvalue keyfield, field, value    		callback: function(unused, enteredText) { return enteredText; },
		         $autocompleteType= $tab_cell->Entity[0]->Autocomplete;
			     if($autocompleteType=='regions')
			     {
?>	
	$('<? echo $identif;?>').editInPlace({
		postclose: function() { updateFields('<? echo $identif;?>');},		
        url: "http://"+ip_server+"/src/inDBPlaceEdit.php",
        params: "tab=<? echo $queryDataTable;?>&field=<? echo $dfield; ?>&keyvalue=<? echo $line['ID'];?>&keyfield=ID&fieldtype=region",
		field_type: "select",
		select_options: "<? echo $regions_arr;?>",
		show_buttons: true
	});
	
	  
<?			     }else
			     { if($autocompleteType=='numbways')
			       {
?>	  
	$('<? echo $identif;?>').editInPlace({
		postclose: function() { updateFields('<? echo $identif;?>');},		
        url: "http://"+ip_server+"/src/inDBPlaceEdit.php",
        params: "tab=<? echo $queryDataTable;?>&field=<? echo $dfield; ?>&keyvalue=<? echo $line['ID'];?>&keyfield=ID&fieldtype=road",
		field_type: "select",
		select_options: "<? echo $roads_arr;?>",
		show_buttons: true
	});   
<?					  
				  
			        }// end if autocompleteType=='numbways'
			      }// end else autocomplete == numbways
		       }// end if  cellType == 'autocomplete'
			}// foreach Cell
		  }// end while mysql_fetch_array
		}// end foreach Content
	 }// end foreach Table
?>
	
	updateAllFunctionFields();
});


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
<?php
$cachefile = projectpath."/www/maps/v.htm";
$fp = fopen($cachefile, 'w');
fwrite($fp, ob_get_contents());
fclose($fp);
ob_end_flush();
?>


