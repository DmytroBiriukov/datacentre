<?php $ID=1; 
      $line=array(); 
	  for($i=158; $i<167;$i++) $line['W_'.$i]=100+$i; 
	  for($i=230; $i<239;$i++) $line['W_'.$i]=200+$i;
	  $region="АР Крим"; 
	  $month="серпень";
	  $year="2012";
	  
   $module_name="data-table-operative-2";	  
?>
<script type="text/javascript" src="js/jquery.jeditable.js"></script>
<script type="text/javascript">
function textvalue(elementreference)
{ return elementreference.textContent || elementreference.innerText || '';
}

$(function() 
{	$( "#accordion" ).accordion();
<?
for($i=158; $i<167;$i++) 
{
?>
	$("#<? echo "W_".$i;?>").editable("http://213.160.135.162:10080/src/inDBPlaceEdit.php", 
	  												       { indicator : "<img src='img/indicator.gif'>", 
														     type   : 'textarea',  
															 submitdata: { _method: "put", tab: "tab_name", keyfield: "key_field", keyvalue: "key_val", field: "field_name", value: "field_val"},  
															 select : true, 
															 submit : 'Змінити', 
															 cancel : 'Відмінити', 
															 cssclass : "editable"
														   }); 
<?
}
for($i=230; $i<239;$i++)
{
?>
	$("#<? echo "W_".$i;?>").editable("http://213.160.135.162:10080/src/inDBPlaceEdit.php", 
	  												       { indicator : "<img src='img/indicator.gif'>", 
														     type   : 'textarea',  
															 submitdata: { _method: "put", tab: "tab_name", keyfield: "key_field", keyvalue: "key_val", field: "field_name", value: "field_val"},   
															 select : true, 
															 submit : 'Змінити', 
															 cancel : 'Відмінити', 
															 cssclass : "editable"
														   }); 
<?
}
?>

});			
</script>
<img src="modules/<? echo $module_name; ?>/<? echo $module_name; ?>-large.png"/> 
<div id="accordion">
	<h3><a href="#">Оперативне виконання по ремонтах доріг загального користування за рахунок кредитних коштів (розпорядження КМУ № 269-р, 312-р та 763-р) за січень-<? echo $month; ?> <? echo $year; ?>  року по Службі автомобільних доріг у <? echo $region; ?> </a></h3>   
	<div>

<table cellspacing="0" cellpadding="0" border="1px">
  <col width="67" />
  <col width="64" span="10" />
 
  <tr>
    <td rowspan="3" width="67">&nbsp;</td>
    <td colspan="9" width="576"><div align="center">Ремонти ВСЬОГО</div></td>
  </tr>
  <tr>
    <td colspan="3" width="192"><div align="center">Річний план</div></td>
    <td colspan="3" width="192"><div align="center">План    на поточний період</div></td>
    <td colspan="3" width="192"><div align="center">Факт</div></td>
  </tr>
  <tr>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">&nbsp;</td>
    <td colspan="9" width="576">крім того зворотні суми</td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
  </tr>
  <tr>
    <td rowspan="3" width="67">&nbsp;</td>
    <td colspan="9" width="576"><div align="center">Капітальний ремонт РАЗОМ</div></td>
  </tr>
  <tr>
    <td colspan="3" width="192"><div align="center">Річний план</div></td>
    <td colspan="3" width="192"><div align="center">План    на поточний період</div></td>
    <td colspan="3" width="192"><div align="center">Факт</div></td>
  </tr>
  <tr>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">&nbsp;</td>
    <td colspan="9" width="576">крім того зворотні суми</td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10" width="643">-в тому числі:</td>
  </tr>
  <tr>
    <td rowspan="3" width="67">&nbsp;</td>
    <td colspan="9" width="576"><div align="center">Капітальний    ремонт (розп. №269-р)</div></td>
  </tr>
  <tr>
    <td colspan="3" width="192"><div align="center">Річний план</div></td>
    <td colspan="3" width="192"><div align="center">План    на поточний період</div></td>
    <td colspan="3" width="192"><div align="center">Факт</div></td>
  </tr>
  <tr>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">&nbsp;</td>
    <td colspan="9" width="576">крім того зворотні суми</td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="3" width="67">&nbsp;</td>
    <td colspan="9" width="576"><div align="center">Капітальний    ремонт (розп. №312-р)</div></td>
  </tr>
  <tr>
    <td colspan="3" width="192"><div align="center">Річний план</div></td>
    <td colspan="3" width="192"><div align="center">План    на поточний період</div></td>
    <td colspan="3" width="192"><div align="center">Факт</div></td>
  </tr>
  <tr>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">&nbsp;</td>
    <td colspan="9" width="576">крім того зворотні суми</td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="3" width="67">&nbsp;</td>
    <td colspan="9" width="576"><div align="center">Капітальний    ремонт (розп. №763-р)</div></td>
  </tr>
  <tr>
    <td colspan="3" width="192"><div align="center">Річний план</div></td>
    <td colspan="3" width="192"><div align="center">План    на поточний період</div></td>
    <td colspan="3" width="192"><div align="center">Факт</div></td>
  </tr>
  <tr>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">&nbsp;</td>
    <td colspan="9" width="576">крім того зворотні суми</td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
    <td width="64"></td>
  </tr>
  <tr>
    <td rowspan="3" width="67">&nbsp;</td>
    <td colspan="9" width="576"><div align="center">Поточний ремонт РАЗОМ</div></td>
  </tr>
  <tr>
    <td colspan="3" width="192"><div align="center">Річний план</div></td>
    <td colspan="3" width="192"><div align="center">План на поточний період</div></td>
    <td colspan="3" width="192"><div align="center">Факт</div></td>
  </tr>
  <tr>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">&nbsp;</td>
    <td colspan="9" width="576">крім того зворотні суми</td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10" width="643">-в тому числі:</td>
  </tr>
  <tr>
    <td rowspan="3" width="67">&nbsp;</td>
    <td colspan="9" width="576"><div align="center">Поточний    ремонт (розп. №269-р)</div></td>
  </tr>
  <tr>
    <td colspan="3" width="192"><div align="center">Річний план</div></td>
    <td colspan="3" width="192"><div align="center">План    на поточний період</div></td>
    <td colspan="3" width="192"><div align="center">Факт</div></td>
  </tr>
  <tr>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">&nbsp;</td>
    <td colspan="9" width="576">крім того зворотні суми</td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="3" width="67">&nbsp;</td>
    <td colspan="9" width="576"><div align="center">Поточний ремонт (Наказ Нацагенства від    13.04.2011 №299)</div></td>
  </tr>
  <tr>
    <td colspan="3" width="192"><div align="center">Річний план</div></td>
    <td colspan="3" width="192"><div align="center">План на поточний період</div></td>
    <td colspan="3" width="192"><div align="center">Факт</div></td>
  </tr>
  <tr>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">&nbsp;</td>
    <td colspan="9" width="576">крім того зворотні суми</td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td rowspan="3" width="67">&nbsp;</td>
    <td colspan="9" width="576"><div align="center">Поточний ремонт (розп. №763-р)</div></td>
  </tr>
  <tr>
    <td colspan="3" width="192"><div align="center">Річний план</div></td>
    <td colspan="3" width="192"><div align="center">План на поточний період</div></td>
    <td colspan="3" width="192"><div align="center">Факт</div></td>
  </tr>
  <tr>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
    <td width="64"><div align="center">тис.грн.</div></td>
    <td width="64"><div align="center">км</div></td>
    <td width="64"><div align="center">пог.м</div></td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
    <td width="64">&nbsp;</td>
  </tr>
  <tr>
    <td width="67">&nbsp;</td>
    <td colspan="9" width="576">крім того зворотні суми</td>
  </tr>
  <tr>
    <td width="67">Місцеві</td>
    <td width="64"><p id="W_158"><?php if($line['W_158']!="") echo $line['W_158']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_159"><?php if($line['W_159']!="") echo  $line['W_159']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_160"><?php if($line['W_160']!="") echo $line['W_160']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_161"><?php if($line['W_161']!="") echo  $line['W_161']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_162"><?php if($line['W_162']!="") echo $line['W_162']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_163"><?php if($line['W_163']!="") echo  $line['W_163']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_164"><?php if($line['W_164']!="") echo $line['W_164']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_165"><?php if($line['W_165']!="") echo  $line['W_165']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_166"><?php if($line['W_166']!="") echo  $line['W_166']; else echo "немає даних";?></p></td>
  </tr>
  <tr>
    <td width="67">Державні</td>
    <td width="64"><p id="W_230"><?php if($line['W_158']!="") echo $line['W_158']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_231"><?php if($line['W_159']!="") echo  $line['W_159']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_232"><?php if($line['W_160']!="") echo $line['W_160']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_233"><?php if($line['W_161']!="") echo  $line['W_161']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_234"><?php if($line['W_162']!="") echo $line['W_162']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_235"><?php if($line['W_163']!="") echo  $line['W_163']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_236"><?php if($line['W_164']!="") echo $line['W_164']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_237"><?php if($line['W_165']!="") echo  $line['W_165']; else echo "немає даних";?></p></td>
    <td width="64"><p id="W_238"><?php if($line['W_166']!="") echo  $line['W_166']; else echo "немає даних";?></p></td>
  </tr>
  <tr>
    <td width="67">Всього</td>
    <td width="64"><? echo ($line['W_158']+$line['W_230']); ?></td>
    <td width="64"><? echo ($line['W_159']+$line['W_231']); ?></td>
    <td width="64"><? echo ($line['W_160']+$line['W_232']); ?></td>
    <td width="64"><? echo ($line['W_161']+$line['W_233']); ?></td>
    <td width="64"><? echo ($line['W_162']+$line['W_234']); ?></td>
    <td width="64"><? echo ($line['W_163']+$line['W_235']); ?></td>
    <td width="64"><? echo ($line['W_164']+$line['W_236']); ?></td>
    <td width="64"><? echo ($line['W_165']+$line['W_237']); ?></td>
    <td width="64"><? echo ($line['W_166']+$line['W_238']); ?></td>
  </tr>
</table>
</div>
</div>
