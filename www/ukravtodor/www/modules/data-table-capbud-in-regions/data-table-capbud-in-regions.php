<? 
function setParams($str, $pars)
{  foreach($pars as $name => $value) $str=str_replace("$".$name, $value, $str);
   return $str;
}


   $eform_xml;
   $module_name="data-table-capbud-in-regions";
  // $eformfile="modules/".$module_name."/eform.xml";
   $eformfile="eform.xml";
   if (file_exists($eformfile))
   { $eform_xml = simplexml_load_file($eformfile);

     $params=array();
	 $eform_params=$eform_xml->Params[0];
	 foreach($eform_params->Param as $eform_param) $params[(string)$eform_param->Name]=(string)$eform_param->Val;
	 
?>
<img src="modules/<? echo $module_name; ?>/data-table-capbud-in-regions.png"/>
<br>
<?   include("../../../cgi-bin/db_functions.php"); 
     $eform_title=setParams($eform_xml->Title[0]->Label, $params);
	 echo "<h1 ".$eform_xml->Title[0]->htm.">".$eform_title."</h1>";
	 
	 $eform_table=$eform_xml->Table[0];
	 $eform_header=$eform_table->Header;
?>
<table <? echo $eform_header->htm; ?> >
<?
	 foreach($eform_header->Row as $eform_header_row) 
	 { echo "<tr>";
	   foreach($eform_header_row->Cell as $eform_header_cell)
	   {  echo "<td ".$eform_header_cell->htm." >".$eform_header_cell->text."</td>"; 		   
	   }
	   echo "</tr>";
	 }
?>
<!--</table>-->
<?	$ind=0; 
	foreach($eform_table->Content as $eform_table_content)
    { $qparams=array();
	  $eform_condition=$eform_table_content->Condition[0];
	  $eform_qparams=$eform_condition->Params[0];
	  foreach($eform_qparams->Param as $eform_qparam) $qparams[(string)$eform_qparam->Name]=(string)$eform_qparam->Val; 	       
	  $query=setParams($eform_table_content->Condition[0]->Query, $qparams); 
	  $dataTable=$eform_table_content->DataTable;		
	  $dataKey=$eform_table_content->Key;      
/*	  
echo $query;
require("../cgi-bin/db_functions.php");
$query="SELECT * FROM data_capbud3 WHERE date='2011-12-05'";
$result=ExecuteQuery($query);
$ii=0;
while($line = mysql_fetch_array($result, MYSQL_ASSOC))
{ $ii++; echo $ii;
  print_r($line);
}
mysql_free_result($result);
*/
	  $result=ExecuteQuery($query);
	  $n=mysql_num_rows($result);
//	  echo "<table cellspacing='0' cellpadding='0' border='1px' >";	
	  
	  while($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { $ind++;
	    $a_items=array(); // element id
  	    $t_items=array(); // type
        $n_items=array(); // field name
    	echo "<tr>";			
?>		
    <form id='form_<? echo $ind;?>' name='form_<? echo $ind;?>' method='post' action='../cgi-bin/dataManipulation.php' target='_self'>
    	<input type="hidden" name="tab" value="<? echo $dataTable; ?>">
	    <input type="hidden" name="key_field" value="<? echo $dataKey; ?>">
        <input type="hidden" name="key_value" value="<? echo $line[$dataKey]; ?>">                      
		<input type="hidden" name="action" value="UPDATE">  
<?		$colspan=0;
		$tab_row=$eform_table_content->Row[0];
		
		foreach($tab_row->Cell as $tab_cell)
      	{ $colspan++;
		  $cellType=$tab_cell->EntityType;
		  
		
//		print_r($line);
//		echo trim($tab_cell->Entity[0]->DataField);
			  
		  if($cellType == 'input')
		  { $a_items[]=$tab_cell->Entity[0]->DataField;
			$t_items[]=$tab_cell->Entity[0]->DataType;
			$n_items[]="назва показника"; 
?>			  
			  <td <? echo $tab_cell->htm;?> ><input type="text" name="" id="<? echo $tab_cell->id;?>" value="<? echo $line[trim($tab_cell->Entity[0]->DataField)];?>" /></td>
<?              
		  }else
			if($cellType == 'autocomplete')
			{ $a_items[]=$tab_cell->Entity[0]->DataField;
			  $t_items[]=$tab_cell->Entity[0]->DataType;
			  $n_items[]="назва показника";
?>			  
			  <td <? echo $tab_cell->htm;?> ><input type="text" name="" id="<? echo $tab_cell->id;?>" value="<? echo $line[trim($tab_cell->Entity[0]->DataField)];?>" /></td>
<? 			   
			}else
			  if($cellType == 'counter')		  
			  { echo "<td>".$ind."</td>";
			  }	else  echo "<td>&nbsp;</td>";
						
		}// foreach cell
?>		
		</tr><tr><td colspan="<? echo $colspan; ?>"> <div class="demo"><button onClick="onEdit('form1',new Array(
<?php $ii=0;
  foreach( $a_items as $p){ if($ii>0) echo ',';  echo "'".$p."'"; $ii++;}

?>), new Array(
<?php $ii=0;
  foreach( $t_items as $p){ if($ii>0) echo ',';  echo "'".$p."'"; $ii++;}
?>), new Array(
<?php $ii=0;
  foreach( $n_items as $p){ if($ii>0) echo ',';  echo "'".$p."'"; $ii++;}
?>),'error_box');"><img src='../img/done.png' style='cursor:pointer;' >Внести зміни</button></div>

<div id="error_box" style="display:none">    
</div>	</td>   </form></tr>	
<?			  			
	  }// for each line
//	  echo "</table>";	
 
	}//for each content
    echo "</table>";	      
 
   } else
   { echo "не може відкрити файл опису електронної форми звітності";
   }

?>
<br /><br /><br /><br />
<table>
  <tr>
    <td rowspan="3" width="3579">NN          n/n               </td>
    <td rowspan="3" width="70">Індекс    та N дороги</td>
    <td rowspan="3" width="154">Найменування    робіт та об&quot;єкту</td>
    <td rowspan="3" width="92">Регіон</td>
    <td rowspan="3" width="92">Рік    початку робіт</td>
    <td rowspan="3" width="119">Наявність    ПКД</td>
    <td rowspan="3" width="93">Загальна    кошторисна вартість об'єкту тис.грн</td>
    <td rowspan="3" width="116">Обсяг    незавершеного будівництва тис. грн. (на 01.01.2011)</td>
    <td rowspan="3" width="125">Фактична    потреба в коштах на завершення робіт, тис. грн.</td>
    <td colspan="15" width="956">Передбачено    фінансування у 2011 році та введення в експлуатацію, тис.грн. / км/ пог. М</td>
    <td rowspan="3" width="130">Очікувальний    обсяг незавершеного будівництва, тис.грн на 01.01.2012</td>
    <td colspan="15" width="1326">Виконання станом на                  </td>
    <td rowspan="3" width="131">Фактичний    обсяг незавершеного будівництва тис.грн. на 01.09.2011</td>
    <td rowspan="3" width="133">Примітки</td>
  </tr>
  <tr>
    <td colspan="3" width="956">Розпорядження КМУ № 312-р від 23.03.2011</td>
    <td colspan="3" width="199">Розпорядження КМУ № 269-р від 28.03.2011</td>
    <td colspan="3" width="154">Розпорядження КМУ № 325-р від 13.04.2011</td>
    <td colspan="3" width="192">Розпорядження    КМУ  № 763-р від 08.08.11</td>
    <td colspan="3" width="268">Всього</td>
    <td colspan="3" width="1326">Розпорядження КМУ № 312-р від 23.03.2011</td>
    <td colspan="3" width="283">Розпорядження КМУ № 269-р від 28.03.2011</td>
    <td colspan="3" width="269">Розпорядження КМУ № 325-р від 13.04.2011</td>
    <td colspan="3" width="276">Розпорядження    КМУ  № 763-р від 08.08.11</td>
    <td colspan="3" width="262">Всього</td>
  </tr>
  <tr>
    <td width="956">тис.грн</td>
    <td width="54">км</td>
    <td width="44">пог.м</td>
    <td width="199">тис.грн</td>
    <td width="42">км</td>
    <td width="59">пог.м</td>
    <td width="154">тис.грн</td>
    <td width="40">км</td>
    <td width="48">пог.м</td>
    <td width="192">тис.грн</td>
    <td width="55">км</td>
    <td width="74">пог.м</td>
    <td width="268">тис.грн</td>
    <td width="85">км</td>
    <td width="100">пог.м</td>
    <td width="1326">тис.грн</td>
    <td width="87">км</td>
    <td width="59">пог.м</td>
    <td width="283">тис.грн</td>
    <td width="88">км</td>
    <td width="97">пог.м</td>
    <td width="269">тис.грн</td>
    <td width="88">км</td>
    <td width="96">пог.м</td>
    <td width="276">тис.грн</td>
    <td width="68">км</td>
    <td width="106">пог.м</td>
    <td width="262">тис.грн</td>
    <td width="84">тис.грн</td>
    <td width="75">тис.грн</td>
  </tr>
  
  
  
  <tr>
    <td width="3579">1</td>
    <td width="70"><input name="numbway" type="text" value="М-18" /></td>
    <td width="154"><input name="object" type="text" value="Реконструкція а/д Харків-Сімферополь-Алушта-Ялта км 632-635" /></td>
    <td width="92"><input name="reg_title" type="text" value="Харківська обл." /></td>
    <input name="id_region" type="hidden" value="20" />
    <td width="92"><input name="year_start" type="text" value="2009" /></td>
    <td width="119"><input name="PKD" type="text" value="02.07.09 потребує    корегування" /></td>
    <td width="93"><input name="PKD" type="text" value="89480,591" /></td>
    <td width="116">83966,476</td>
    <td width="125">8640</td>
    <td width="956">___</td>
    <td width="54">___</td>
    <td width="44">___</td>
    <td width="199">___</td>
    <td width="42">___</td>
    <td width="59">___</td>
    <td width="154">___</td>
    <td width="40">___</td>
    <td width="48">___</td>
    <td width="192">8640</td>
    <td width="55">3</td>
    <td width="74">___</td>
    <td width="268">8640</td>
    <td width="85">3</td>
    <td width="100">&nbsp;</td>
    <td width="130">0,000</td>
    <td width="1326">___</td>
    <td width="87">___</td>
    <td width="59">___</td>
    <td width="283">___</td>
    <td width="88">___</td>
    <td width="97">___</td>
    <td width="269">___</td>
    <td width="88">___</td>
    <td width="96">___</td>
    <td width="276">5514,115</td>
    <td width="68">___</td>
    <td width="106">___</td>
    <td width="262">5514,115</td>
    <td width="84">___</td>
    <td width="75">___</td>
    <td width="131">89480,591</td>
    <td width="133">___</td>
  </tr>
  <tr>
    <td width="3579">2</td>
    <td width="70">М    - 04</td>
    <td width="154">Реконструкція    а/д Знам&quot;янка - Луганськ - Ізварине км 384+046 - 386+046</td>
    <td width="92">Донецьк</td>
    <td width="92">2010</td>
    <td width="119">01.02.2011</td>
    <td width="93">55347,885</td>
    <td width="116">24553,232</td>
    <td width="125">30814,653</td>
    <td width="956">___</td>
    <td width="54">___</td>
    <td width="44">___</td>
    <td width="199">___</td>
    <td width="42">___</td>
    <td width="59">___</td>
    <td width="154">20000</td>
    <td width="40">___</td>
    <td width="48">___</td>
    <td width="192">___</td>
    <td width="55">___</td>
    <td width="74">___</td>
    <td width="268">20000</td>
    <td width="85">___</td>
    <td width="100">___</td>
    <td width="130">44553,232</td>
    <td width="1326">___</td>
    <td width="87">&nbsp;</td>
    <td width="59">___</td>
    <td width="283">___</td>
    <td width="88">___</td>
    <td width="97">___</td>
    <td width="269">20000</td>
    <td width="88">___</td>
    <td width="96">___</td>
    <td width="276">___</td>
    <td width="68">___</td>
    <td width="106">___</td>
    <td width="262">20000</td>
    <td width="84">___</td>
    <td width="75">___</td>
    <td width="131">44553,232</td>
    <td width="133">___</td>
  </tr>
  <tr>
    <td width="3579">3</td>
    <td width="70">М    - 14</td>
    <td width="154">Капітальний    ремонт а/д Одеса - Мелітополь - Новоазовськ</td>
    <td width="92">Херсон</td>
    <td width="92">2011</td>
    <td width="119">в експертизі</td>
    <td width="93">30000</td>
    <td width="116">0</td>
    <td width="125">30000</td>
    <td width="956">___</td>
    <td width="54">___</td>
    <td width="44">___</td>
    <td width="199">___</td>
    <td width="42">___</td>
    <td width="59">___</td>
    <td width="154">17000</td>
    <td width="40">___</td>
    <td width="48">___</td>
    <td width="192">13000</td>
    <td width="55">6</td>
    <td width="74">___</td>
    <td width="268">30000</td>
    <td width="85">6</td>
    <td width="100">___</td>
    <td width="130">0,000</td>
    <td width="1326">___</td>
    <td width="87">___</td>
    <td width="59">___</td>
    <td width="283">___</td>
    <td width="88">___</td>
    <td width="97">___</td>
    <td width="269">___</td>
    <td width="88">___</td>
    <td width="96">___</td>
    <td width="276">___</td>
    <td width="68">___</td>
    <td width="106">___</td>
    <td width="262">___</td>
    <td width="84">___</td>
    <td width="75">___</td>
    <td width="131">0</td>
    <td width="133">___</td>
  </tr>
  <tr>
    <td align="right">4</td>
    <td>&nbsp;</td>
    <td width="154">Поточний ремонт</td>
    <td width="92">АР    Крим</td>
    <td width="92">___</td>
    <td width="119">___</td>
    <td width="93">___</td>
    <td width="116">___</td>
    <td width="125">___</td>
    <td width="956">___</td>
    <td width="54">___</td>
    <td width="44">___</td>
    <td width="199">12504,4</td>
    <td width="42">0,1</td>
    <td width="59">10</td>
    <td width="154">___</td>
    <td width="40">___</td>
    <td width="48">___</td>
    <td width="192">___</td>
    <td width="55">___</td>
    <td width="74">___</td>
    <td width="268">12504,4</td>
    <td width="85">0,1</td>
    <td width="100">10</td>
    <td width="130">___</td>
    <td width="1326">___</td>
    <td width="87">___</td>
    <td width="59">___</td>
    <td width="283">12504,4</td>
    <td width="88">0,1</td>
    <td width="97">10</td>
    <td width="269">___</td>
    <td width="88">___</td>
    <td width="96">___</td>
    <td width="276">___</td>
    <td width="68">___</td>
    <td width="106">___</td>
    <td width="262">12504,4</td>
    <td width="84">0,1</td>
    <td width="75">10</td>
    <td width="131">___</td>
    <td width="133">___</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="154">ВСЬОГО по    регіонам:</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td width="133">___</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="154"> в тому числі:</td>
    <td width="92">&nbsp;</td>
    <td width="92">&nbsp;</td>
    <td width="119">&nbsp;</td>
    <td width="93">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="133">___</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="154">будівництво та    реконструкція</td>
    <td width="92">___</td>
    <td width="92">___</td>
    <td width="119">___</td>
    <td width="93">___</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td width="133">___</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>кап. ремонт</td>
    <td width="92">___</td>
    <td width="92">___</td>
    <td width="119">___</td>
    <td width="93">___</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td width="133">___</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>поточний ремонт</td>
    <td width="92">___</td>
    <td width="92">___</td>
    <td width="119">___</td>
    <td width="93">___</td>
    <td width="116">___</td>
    <td width="125">___</td>
    <td width="956">___</td>
    <td width="54">___</td>
    <td width="44">___</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td width="154">___</td>
    <td width="40">___</td>
    <td width="48">___</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td width="130">___</td>
    <td width="1326">___</td>
    <td width="87">___</td>
    <td width="59">___</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td width="269">___</td>
    <td width="88">___</td>
    <td width="96">___</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td>∑</td>
    <td width="131">___</td>
    <td width="133">___</td>
  </tr>  
  </table>

