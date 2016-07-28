<? 
  include("../../../cgi-bin/db_functions.php");  
  $module_name="data-import-constructor";
  $module_path="modules/".$module_name."/";  
  $POST_MAX_SIZE = ini_get('post_max_size');
  $mul = substr($POST_MAX_SIZE, -1);
  $mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
  $POST_MAX_SIZE=$mul*(int)$POST_MAX_SIZE;
?>
<script type="text/javascript">
  $('#moduleInfo').innerHTML="";
  
  var cell_info=new Array();
  
  $(function()
  {   $( "#accordion" ).accordion();
  });

  $("#dialog-form").dialog(
  { autoOpen: false,
    height: 400,
    width: 500,
    modal: true,
    buttons: 
	{ "Закрити": function() 
	   { $( this ).dialog( "close" );
       },
	   "Пов\'язати":function()
	   { var str=""+document.forms['cell-form'].elements['i'].value+" "+document.forms['cell-form'].elements['j'].value+" "+ document.forms['cell-form'].elements['cell_serialize'].value+" "+ document.forms['cell-form'].elements['id_criteria'].value+"";
 
/*  cell_info[cell_info.length]=str; */
  document.getElementById("i_"+document.forms['cell-form'].elements['i'].value+"_j_"+document.forms['cell-form'].elements['j'].value).style.backgroundColor = '#678';
		 $( this ).dialog( "close" );
	   }
		
	},
    close: function() 
	{  
    }
  }); 

	
  function openCellDialog(i, j)
  { document.forms['cell-form'].elements['i'].value=i;
    document.forms['cell-form'].elements['j'].value=j;
	//alert("i="+document.forms['cell-form'].elements['i'].value+" j="+document.forms['cell-form'].elements['j'].value);
	$('#dialog-form').dialog( 'open' );
  }
	
  function ConnectTable()
  { //$('#Parameters').load('modules/data-import-constructor/list_param.php',{tabtitle:document.getElementById('data_table_list').value});
    var d = new Date();
    var n = d.getTime(); 
    document.getElementById('eform').value=n.toString();
	$('#Criteria').load('modules/data-import-constructor/list_criteria.php',{tabtitle:document.getElementById('data_table_list').value});	
  }
  function LoadXLSTable()
  { document.forms['openXLS'].submit();
    $('#xlsTABLE').load('modules/data-import-constructor/openXLS.php',{eform:document.getElementById('eform').value});
  } 
</script>
<img src="modules/<? echo $module_name; ?>/<? echo $module_name; ?>.png"/> 
<div id="dialog-form" title="Дані про комірку">
<form id="cell-form" name="cell-form">
<input type="hidden" id="i" name="i" value="0"/>
<input type="hidden" id="j" name="j" value="0"/>
<select id="cell_serialize" name="cell_serialize">
<option id="cell_serialize" value="N" selected="selected">показник міститься в одній комірці</option>
<option id="cell_serialize" value="Y">показник повторюється в рядках до першої порожньої комірки</option>
</select> 
<div id="Criteria">
	<em>Список показників електронної форми звітності.</em>
</div>
</form>
</div>
<div id="accordion">
	<h3><a href="#">Імпорт XLS файлів - створення привязок до показників в БД</a></h3>
	<div>
            <p>Вибрати таблицю з бази даних: &nbsp;<select name="data_table_list" id="data_table_list" >         
<? $query = " SELECT * FROM eform ORDER BY ID"; 
   $result = ExecuteQuery($query);
   while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='data_table_list' value='".$line['id']."' selected='selected'>".$line['title']."</option>";
   }
   mysql_free_result($result);
?></select></p>  
		<p><button id="" onclick="ConnectTable();">Прив'язати</button></p>
		<div id="Parameters">
		        <em>Параметри електронної форми звітності.</em>
		</div>    
    	<form name="openXLS" action="modules/data-import-constructor/loadXLS.php" enctype="multipart/form-data" method="POST" target="_blank">
		<input type="hidden" value="<? echo $POST_MAX_SIZE; ?>" name="MAX_FILE_SIZE" />  
        <input type="hidden" value="" name="eform"  id="eform"/>  
		<p>Будь ласка виберіть xls-файл з даними</p>
		<input type="file" name="xlsFILE" onChange="document.getElementById('openXLS_submit').disabled='';"/>   
		</form>
        <p><button id="openXLS_submit" disabled="disabled" onClick="LoadXLSTable();">Відкрити XLS файл</button></p>
		<div id="xlsTABLE">
		        <em>Таблиця вмісту xls-файлу.</em>
		</div>    		
	</div>
</div>