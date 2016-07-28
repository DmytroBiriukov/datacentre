<? 
  include("../../../cgi-bin/db_functions.php");  
  function setParams($str, $pars)
  { foreach($pars as $name => $value) $str=str_replace("$".$name, $value, $str);
    return $str;
  }
  $module_name="data-eform-constructor";
?>
<script type="text/javascript">
  var eform_table;
  var QueryString;
  var ParamsArr=new Array();
  var ParamsNum=0;

  function AddParam(param_title, el_id)
  { ParamsArr[ParamsNum]=param_title;
    ParamsArr[ParamsNum+1]=el_id;
    ParamsNum+=2; 
  }
  
  var CriterionArr=new Array();
  var CriterionNum=0;
  function AddCriteion(c_id, c_title, c_type, c_field, c_tab)
  { CriterionArr[CriterionNum]=c_id;
    CriterionArr[CriterionNum+1]=c_title;
    CriterionArr[CriterionNum+2]=c_type;
    CriterionArr[CriterionNum+3]=c_field;
    CriterionArr[CriterionNum+4]=c_tab;	
    CriterionNum+=5; 
  }  
 
  $(function()
  { $('#menutab').tabs({collapsible: true});
    $('#menutab2').tabs({collapsible: true});
	$( "#accordion" ).accordion();
  });
	
  function ConnectTable()
  {
  	//$('#Parameters').load('modules/data-eform-constructor/list_param.php',{tabtitle:document.getElementById('data_table_list').value});
    //$('#Criteria').load('modules/data-eform-constructor/list_criteria.php',{tabtitle:document.getElementById('data_table_list').value});
    //document.getElementById('doc_db_table_list').value=document.getElementById('data_table_list').value;
  }
  function ConnectCriteria(id_criteria)
  { $('#Criteria_info').load('modules/data-eform-constructor/set_cell_criteria.php',{id:id_criteria});
  }

</script>
<script type="text/javascript" src="modules/data-eform-constructor/jscc.js"></script>  
<script type="text/javascript" src="modules/data-eform-constructor/formula.js"></script>       
<link href="modules/data-eform-constructor/constructor.css" rel="stylesheet" type="text/css" />
 
<img src="modules/<? echo $module_name; ?>/<? echo $module_name; ?>.png"/> 

<!--- --->



<!-- -->

<div id="constructor_panel" >
<div id="accordion">
	<h3><a href="#">Створення звітньої форми</a></h3>
	<div>

<form id="save_xml" action="modules/data-eform-constructor/xmlizer.php" method="post">
  	<input id="save_xml_content" type="hidden" name="content"/>
</form>  
     
<div>Зараз редагується: <span style="font-weight:bold;" id="doc_now_editing"></span></div>

<div id="menutab">   
	<ul>
		<li><a id="doc_tab1" href="#tabs-1">Загальні дані</a></li>            
		<li><a id="doc_tab2" href="#tabs-2">Вставка рядків</a></li>
		<li><a id="doc_tab3" href="#tabs-3">Вставка комірок</a></li>
        <li><a id="doc_tab4" href="#tabs-4">Стилізація комірки</a></li>                    
	</ul>
	<div id="tabs-1">
        <p>Заголовок таблиці: &nbsp;<input type="text" id="doc_table_name" value="Заголовок таблиці" size="100"/></p>
		<p><button id="doc_submit_table_name">Змінити</button></p>       

	</div>        
	<div id="tabs-2">
		
		<div id="doc_db_connect" style="display:none;">
            <p>Вибрати таблицю з бази даних: &nbsp;<select name="data_table_list" id="data_table_list" >         
				<? $query = " SELECT * FROM eform ORDER BY ID"; 
				   $result = ExecuteQuery($query);
				   while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
				   { echo "<option id='data_table_list' value='".$line['id']."' selected='selected'>".$line['title']."</option>";
				   }
				   mysql_free_result($result);
				?></select>
			</p>  
			<p><button id="doc_connect_table">Пов'язати</button></p>
			<p>Серіалізувати <input type="checkbox" id="doc_serialize"/></p>
			<input type="hidden" value="" id="doc_db_table_list" />    
			
			<button id="doc_add_content_tr">Додати в таблицю новий блок для даних</button>
			<button id="doc_del_content_tr">Видалити з таблиці цей блок даних</button>
		</div>
		
		<div id="doc_manage_tr">
		<table cellpadding="4" cellspacing="4">
        <tr>
        	
            <td style="vertical-align:top"> 
				<p><button id="doc_add_tr_after">Створити новий рядок після обраного</button></p>
				<p><button id="doc_add_tr_before">Створити новий рядок перед обраним</button></p>
				<p><button id="doc_delete_tr">Видалити рядок</button></p>
            </td>
            <td style="vertical-align:top">                
				<p>Ширина стовбчика (пікселів) <input id="doc_td_width" type="text" style="width:40px;" /><button id="doc_td_submit_width">Застосувати</button></p>
				<p>Висота рядка (пікселів)  <input id="doc_tr_height" type="text" style="width:40px;" /><button id="doc_tr_submit_height">Застосувати</button></p>
            </td>
         </tr>
         </table>   
         </div>
        
        
	</div>
	<div id="tabs-3">
	
	<div id="doc_manage_db_data" style="display:none;">
	         <p><select id="doc_td_type">
					<option value="numerator" selected>Нумератор</option>
					<option value="input">Поле для показника з бази даних</option>
					<option value="autocomplete">Поле для заповнення</option>
					<option value="formula">Формула</option>
				</select>
         </p>
         <div id="doc_db_data">   
            <em>Пов'язати комірку звітньої форми з показником звітності, значення якого зберігаються в базі даних.</em>
            <div id="Criteria"></div>
				<input id="doc_td_table_list" type="hidden" />
				<input type="hidden" id="doc_td_field_name" />
				<input type="hidden" id="doc_td_input_field"/>             
				<input id="doc_td_date_format" type="hidden"/>
				<input id="doc_td_text_size" type="hidden"/>
				<input id="doc_td_decimals" type="hidden"/> 
				<input id="doc_td_delimiter" type="hidden"/>
			</div>    
	</div>
	
    <div id="doc_manage_cells">
		<table cellpadding="4" cellspacing="4">
        <tr>
        	
            <td style="vertical-align:top">     
				<p><button id="doc_add_td_after">Створити нову комірку після обраної</button></p>
				<p><button id="doc_add_td_before">Створити нову комірку перед обраною</button></p>
				<p><button id="doc_delete_td">Видалити комірку</button></p>
            </td>
            <td style="vertical-align:top">         
				<p id="doc_p_colspan">Розбити комірку на декілька по стовпчикам: <input id="doc_td_colspan" type="text" style="width:35px;"/><button id="doc_td_submit_colspan">Застосувати</button></p>
				<p id="doc_p_rowspan">Розбити комірку на декілька по рядкам:<input id="doc_td_rowspan" type="text" style="width:35px;"/><button id="doc_td_submit_rowspan">Застосувати</button></p>	
            </td>
        </tr>
        </table>    
    </div>      
	</div>
	<div id="tabs-4">
		<table cellpadding="4" cellspacing="4">
        <tr>
        	
            <td style="vertical-align:top">    
				<p>Розмір тексту <input id="doc_td_font_size" type="text" style="width:35px;"/> <button id="doc_td_submit_font_size">Застосувати</button></p>
                <p>Жирний текст <input id="doc_td_bold" type="checkbox"/></p>
				<p>Курсив <input id="doc_td_italic" type="checkbox"/></p>
				<p>Закреслений <input id="doc_td_line_through" type="checkbox"/></p>
			</td>
             <td style="vertical-align:top">  				
				<p>Вирівнювання</p>
				<p><input name="text-align"  id="doc_td_text_align_left" type="radio" value="left"/> ліворуч</p>
				<p><input name="text-align"  id="doc_td_text_align_center" type="radio" value="center"/> по центру</p>
				<p><input name="text-align"  id="doc_td_text_align_right" type="radio" value="right"/> праворуч</p>		   
             </td>             
            <td style="vertical-align:top">               
				<p>Колір тексту
			<select id="doc_td_color">
				<option value="rgb(255, 0, 0)"  	style="background-color:rgb(255, 0, 0);">Червоний</option>
				<option value="rgb(0, 0, 255)" 		style="background-color:rgb(240, 255, 255);">Синій</option>
				<option value="rgb(22, 29, 30)" 	style="background-color:rgb(22,29,30);color:white;">Чорний</option>
				<option value="rgb(255, 255, 255)" 	style="background-color:rgb(255, 255, 255);">Білий</option>
				<option value="rgb(0, 255, 0)" 		style="background-color:rgb(0, 255, 0);">Зелений</option>
				<option value="rgb(255, 255, 0)" 	style="background-color:rgb(255, 255, 0);">Жовтий</option>
				<option value="rgb(0, 255, 255)" 	style="background-color:rgb(0, 255, 255);">Блакитний</option>
				<option value="rgb(175, 192, 205)"	style="background-color:rgb(175, 192, 205)">Колір теми</option>
			</select>
				</p>
				<p>Колір фону
			<select id="doc_td_bgcolor">
				<option value="rgb(255, 0, 0)"  	style="background-color:rgb(255, 0, 0);">Червоний</option>
				<option value="rgb(0, 0, 255)" 		style="background-color:rgb(240, 255, 255);">Синій</option>
				<option value="rgb(22, 29, 30)" 	style="background-color:rgb(22,29,30);color:white;">Чорний</option>
				<option value="rgb(255, 255, 255)" 	style="background-color:rgb(255, 255, 255);">Білий</option>
				<option value="rgb(0, 255, 0)" 		style="background-color:rgb(0, 255, 0);">Зелений</option>
				<option value="rgb(255, 255, 0)" 	style="background-color:rgb(255, 255, 0);">Жовтий</option>
				<option value="rgb(0, 255, 255)" 	style="background-color:rgb(0, 255, 255);">Блакитний</option>
				<option value="rgb(175, 192, 205)"	style="background-color:rgb(175, 192, 205)">Колір теми</option>
			</select>
		</p>
             </td>             
             <td style="vertical-align:top">          
				<p>Відступ</p>
				<p>Зліва  <input type="text" id="doc_td_padding_left" style="width:40px;"/> <button id="doc_td_submit_padding_left">Застосувати</button></p>
				<p>Справа <input type="text" id="doc_td_padding_right" style="width:40px;"/><button id="doc_td_submit_padding_right">Застосувати</button></p>
				<p>Зверху <input type="text" id="doc_td_padding_top" style="width:40px;"/><button id="doc_td_submit_padding_top">Застосувати</button></p>
				<p>Знизу  <input type="text" id="doc_td_padding_bottom" style="width:40px;"/><button id="doc_td_submit_padding_bottom">Застосувати</button></p>				
             </td>
             </tr>                  
         </table>    
    
    </div>          
</div><!-- /menutab  --> 

<p>Позиція комірки (номер стовчика: <span id="doc_td_pos_x"></span>, номер рядка: <span id="doc_td_pos_y"></span>)</p>	  
 
<h1 id="doc_h1_table_name">Заголовок таблиці</h1>
<div style="clear:left;" id="doc_content">
	<table class="constructor" id="doc_table" cellspacing="0" cellpadding="0">
		<tr class="doc_header">
			<td>Нова комірка</td>
			<td>Нова комірка</td>
		</tr>
		<tr  class="doc_content">
			<td>Нова комірка</td>
			<td>Нова комірка</td>
		</tr>		
	</table>
</div>

<div id="doc_constructor">
	<button id="doc_step_submit">Зберегти</button>
		<div id="doc_preview">

		</div>
		<div id="doc_db_preview">
		
		</div>
		<button id="doc_load">Завантажити</button>
</div>    
    </div> <!-- /tab accordion--> 
</div>    <!-- /accordion --> 



<script type="text/javascript" src="modules/data-eform-constructor/constructor.js"></script> 
<script type="text/javascript" src="modules/data-eform-constructor/stepper.js"></script> 
<script type="text/javascript" src="modules/data-eform-constructor/loader.js"></script> 
</div> 