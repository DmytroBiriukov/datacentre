<?  $module_path="modules/core-criteria/core-criteria.php";
?>
<?   include("../../../cgi-bin/db_functions.php"); 
?>
<img src="modules/core-criteria/core-criteria-large.png"/>

<script type="text/javascript">
document.getElementById("moduleInfo").innerHTML= "";
function form0check()
{ if(document.forms['form0'].elements['title'].value != "" && document.forms['form0'].elements['description'].value != "")
  { $('#moduleInfo').load('modules/core-criteria/create_ind_tab.php',{title:document.forms['form0'].elements['title'].value, description:document.forms['form0'].elements['description'].value});

  } else 
  { document.getElementById("moduleInfo").innerHTML= "<img src=\"images/error.png\"/>Заповніть інформацією всі обов\'язкові поля";
  }
 return false;

}
function form1check()
{ if(document.forms['form1'].elements['title'].value != "" && document.forms['form1'].elements['measure'].value != "" )
  { $('#moduleInfo').load('modules/core-criteria/add_criterion.php',{tabtitle:document.forms['form1'].elements['tabtitle'].value, title:document.forms['form1'].elements['title'].value, type:document.forms['form1'].elements['type'].value, measure:document.forms['form1'].elements['measure'].value, format:document.forms['form1'].elements['format'].value, decimals:document.forms['form1'].elements['decimals'].value, separator:document.forms['form1'].elements['separator'].value, bound_low:document.forms['form1'].elements['bound_low'].value, bound_upper:document.forms['form1'].elements['bound_upper'].value, opt:document.forms['form1'].elements['opt'].value});
  } else 
  { document.getElementById("moduleInfo").innerHTML= "<img src=\"images/error.png\"/>Заповніть інформацією всі обов\'язкові поля";
  }
 return false;
 // title measure tabtitle field type  format decimals separator   bound_low  bound_upper opt
}
function form2check() 
{ if(document.forms['form2'].elements['title'].value != "" )
  { $('#moduleInfo').load('modules/core-criteria/add_param.php',{tabtitle:document.forms['form2'].elements['tabtitle'].value, title:document.forms['form2'].elements['title'].value, ptype:document.forms['form2'].elements['ptype'].value});

  } else 
  { document.getElementById("moduleInfo").innerHTML= "<img src=\"images/error.png\"/>Заповніть інформацією всі обов\'язкові поля";
  }
 return false;
}

$(function() {$( "#accordion" ).accordion();});


function criterionTypeChanged()
{ var t=document.forms['form1'].elements['type'].value;  
  switch(t)
  { case 'char': document.getElementById("characteristics").innerHTML= 
"<p>Максимальна кількість символів: &nbsp;<input type=\"text\" name=\"format\" id=\"format\"/></p>" +      
"<input type=\"hidden\" name=\"decimals\" id=\"decimals\" value=\"0\" />" +      
"<input type=\"hidden\" name=\"separator\" id=\"separator\" value=\" \" />" +      
"<input type=\"hidden\" name=\"bound_low\" id=\"bound_low\" value=\"0\" />" +      
"<input type=\"hidden\" name=\"bound_upper\" id=\"bound_upper\" value=\"0\" />" +      
"<input type=\"hidden\" name=\"opt\" id=\"opt\" value=\"min\" />";  				 
                 break;
    case 'int': 	 
	document.getElementById("characteristics").innerHTML= 
"<input type=\"hidden\" name=\"format\" id=\"format\" value=\" \" />" +     
"<input type=\"hidden\" name=\"decimals\" id=\"decimals\" value=\"\"/>" +      
"<input type=\"hidden\" name=\"separator\" id=\"separator\" value=\"\" />" +      
"<input type=\"hidden\" name=\"bound_low\" id=\"bound_low\" value=\"\" />" +  
"<input type=\"hidden\" name=\"bound_upper\" id=\"bound_upper\" value=\"\" />" +    
"<p>Напрямок оптимізації: &nbsp;<select name=\"opt\"><option id=\"opt\" value=\"max\" selected=\"selected\">більші значення є кращими</option><option id=\"opt\" value=\"min\">менші значення є кращими</option></select></p>"; 				 
                 break;
    case 'uint':  document.getElementById("characteristics").innerHTML= 
"<input type=\"hidden\" name=\"format\" id=\"format\" value=\" \" />" +     
"<input type=\"hidden\" name=\"decimals\" id=\"decimals\" value=\"\"/>" +      
"<input type=\"hidden\" name=\"separator\" id=\"separator\" value=\"\" />" +      
"<input type=\"hidden\" name=\"bound_low\" id=\"bound_low\" value=\"\" />" +  
"<input type=\"hidden\" name=\"bound_upper\" id=\"bound_upper\" value=\"\" />" +    
"<p>Напрямок оптимізації: &nbsp;<select name=\"opt\"><option id=\"opt\" value=\"max\" selected=\"selected\">більші значення є кращими</option><option id=\"opt\" value=\"min\">менші значення є кращими</option></select></p>";   				 
                 break;
    case 'float':		 document.getElementById("characteristics").innerHTML= 
"<input type=\"hidden\" name=\"format\" id=\"format\" value=\" \" />" +     
"<p>Кількість цифр після десяткової точки: &nbsp;<input type=\"text\" name=\"decimals\" id=\"decimals\"/></p>" +      
"<p>Роздільний символ: &nbsp;<select name=\"separator\"><option id=\"separator\" value=\".\" selected=\"selected\">. (крапка)</option><option id=\"separator\" value=\",\">, (кома)</option><option id=\"separator\" value=\" \">пробіл</option><option id=\"separator\" value=\"-\">- (тире)</option></select></p>" +      
"<input type=\"hidden\" name=\"bound_low\" id=\"bound_low\" value=\"\" />" +  
"<input type=\"hidden\" name=\"bound_upper\" id=\"bound_upper\" value=\"\" />" +    
"<p>Напрямок оптимізації: &nbsp;<select name=\"opt\"><option id=\"opt\" value=\"max\" selected=\"selected\">більші значення є кращими</option><option id=\"opt\" value=\"min\">менші значення є кращими</option></select></p>";  				 
                 break;
    case 'ufloat': document.getElementById("characteristics").innerHTML= 
"<input type=\"hidden\" name=\"format\" id=\"format\" value=\" \" />" +     
"<p>Кількість цифр після десяткової точки: &nbsp;<input type=\"text\" name=\"decimals\" id=\"decimals\"/></p>" +      
"<p>Роздільний символ: &nbsp;<select name=\"separator\"><option id=\"separator\" value=\".\" selected=\"selected\">. (крапка)</option><option id=\"separator\" value=\",\">, (кома)</option><option id=\"separator\" value=\" \">пробіл</option><option id=\"separator\" value=\"-\">- (тире)</option></select></p>" +      
"<input type=\"hidden\" name=\"bound_low\" id=\"bound_low\" value=\"\" />" +  
"<input type=\"hidden\" name=\"bound_upper\" id=\"bound_upper\" value=\"\" />" +    
"<p>Напрямок оптимізації: &nbsp;<select name=\"opt\"><option id=\"opt\" value=\"max\" selected=\"selected\">більші значення є кращими</option><option id=\"opt\" value=\"min\">менші значення є кращими</option></select></p>";   				 
                 break;
    case 'date': document.getElementById("characteristics").innerHTML= 
"<p>Формат дати: &nbsp;<select name=\"format\"><option id=\"format\" value=\"Y\" selected=\"selected\">рік (наприклад, \"2012\")</option><option id=\"format\" value=\"Y-M-D\">рік, місяць, день (наприклад, \"2012-01-12\")</option><option id=\"format\" value=\"Y/Q\">рік, квартал (наприклад, \"2012/1\")</option></select></p>" +      
"<input type=\"hidden\" name=\"decimals\" id=\"decimals\" value=\"0\" />" +      
"<input type=\"hidden\" name=\"separator\" id=\"separator\" value=\" \" />" +      
"<input type=\"hidden\" name=\"bound_low\" id=\"bound_low\" value=\"0\" />" +      
"<input type=\"hidden\" name=\"bound_upper\" id=\"bound_upper\" value=\"0\" />" +      
"<input type=\"hidden\" name=\"opt\" id=\"opt\" value=\"min\" />";   				 
                 break;
    case 'percent': document.getElementById("characteristics").innerHTML= 
"<input type=\"hidden\" name=\"format\" id=\"format\" value=\" \" />" +     
"<p>Кількість цифр після десяткової точки: &nbsp;<input type=\"text\" name=\"decimals\" id=\"decimals\"/></p>" +      
"<p>Роздільний символ: &nbsp;<select name=\"separator\"><option id=\"separator\" value=\".\" selected=\"selected\">. (крапка)</option><option id=\"separator\" value=\",\">, (кома)</option><option id=\"separator\" value=\" \">пробіл</option><option id=\"separator\" value=\"-\">- (тире)</option></select></p>" +      
"<p>Мінімальне значення показника: &nbsp;<input type=\"text\" name=\"bound_low\" id=\"bound_low\" value=\"0\" /></p>" +   
"<input type=\"hidden\" name=\"bound_upper\" id=\"bound_upper\" value=\"100\" />" +    
"<p>Напрямок оптимізації: &nbsp;<select name=\"opt\"><option id=\"opt\" value=\"max\" selected=\"selected\">більші значення є кращими</option><option id=\"opt\" value=\"min\">менші значення є кращими</option></select></p>";  				 
                 break;
    case 'permile': document.getElementById("characteristics").innerHTML= 
"<input type=\"hidden\" name=\"format\" id=\"format\" value=\" \" />" +     
"<p>Кількість цифр після десяткової точки: &nbsp;<input type=\"text\" name=\"decimals\" id=\"decimals\"/></p>" +      
"<p>Роздільний символ: &nbsp;<select name=\"separator\"><option id=\"separator\" value=\".\" selected=\"selected\">. (крапка)</option><option id=\"separator\" value=\",\">, (кома)</option><option id=\"separator\" value=\" \">пробіл</option><option id=\"separator\" value=\"-\">- (тире)</option></select></p>" +      
"<p>Мінімальне значення показника: &nbsp;<input type=\"text\" name=\"bound_low\" id=\"bound_low\" value=\"0\" /></p>" +   
"<input type=\"hidden\" name=\"bound_upper\" id=\"bound_upper\" value=\"1000\" />" +    
"<p>Напрямок оптимізації: &nbsp;<select name=\"opt\"><option id=\"opt\" value=\"max\" selected=\"selected\">більші значення є кращими</option><option id=\"opt\" value=\"min\">менші значення є кращими</option></select></p>"; 				 
                 break;
    default: document.getElementById("characteristics").innerHTML= "";
  }
}
</script>

<div id="accordion">
	<h3><a href="#">Створення таблиць даних для зберігання значень показників</a></h3>
	<div>
<form id="form0" name="form0" method="post" action=""  onSubmit="return form0check()">
<p>Змістовна назва, що ідентифікує дані в таблиці: &nbsp;<input name="title" type="text" id="title" size="100" /></p>
<!--<p>Назва таблиці з бази даних, де будуть міститися значення показників (латинськими літерами та цифри без пробілу): &nbsp;<input name="tabtitle" type="text" id="tabtitle" size="40"  /></p>-->
<p>Опис показників, значення яких будуть міститися в даній таблиці: &nbsp;<textarea name="description" cols="100" rows="4"></textarea></p>
<p><input name="submitbutton" type="submit" value="Створити таблицю"/></p>
</form>
	</div>
	<h3><a href="#">Внесення параметрів для таблиць даних</a></h3>
	<div> 
 <form id="form2" name="form2" method="post" action="" onSubmit="return form2check()">        
<p>Змістовна назва параметру: &nbsp;<input type="text" name="title" id="title" /></p>
<!--<p>Назва атрибуту в таблиці даних (латинськими літерами та цифри без пробілу): &nbsp;<input type="text" name="pfield" id="pfield" /></p>-->
<p>Тип параметру: &nbsp;<select name="ptype">      
        <option id="ptype" value="region" selected="selected">регіон</option>
        <option id="ptype" value="year">термін внесення</option>        
        <option id="ptype" value="int">ціле число</option> 
        <option id="ptype" value="uint">невідємне ціле число</option>                 
        <option id="ptype" value="date">дата</option>      
        <option id="ptype" value="percent">проценти</option>      
        <option id="ptype" value="permile">перміле</option>            
        <option id="ptype" value="char">текстова строка</option>              
      </select></p>   
<p>Таблиця з бази даних, де містяться значення показника: &nbsp;<select name="tabtitle" id="tabtitle">
<? $query = " SELECT * FROM eform ORDER BY ID"; 
   $result = ExecuteQuery($query);
   while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='tabtitle' value='".$line['id']."' selected='selected'>".$line['title']."</option>";
   }
   mysql_free_result($result);
?></select></p>           
<p id="error2" class="error_message"></p>
<p><input name="submitbutton" type="submit" value="Додати параметр" /> </p>
    </form>
	</div>
	<h3><a href="#">Внесення інформації про показники та їх прив'язка до таблиць даних</a></h3>
	<div>
		<p>
<form id="form1" name="form1" method="post" action="" onSubmit="return form1check()">      
<p>Назва показника: &nbsp;<input type="text" name="title" id="title" /></p>
<p>Одиниці вимірювання: &nbsp;<input type="text" name="measure" id="measure" /></p>
<p>Таблиця з бази даних, де містяться значення показника: &nbsp;<select name="tabtitle" id="tabtitle">
<? $query = " SELECT * FROM eform ORDER BY ID"; 
   $result = ExecuteQuery($query);
   while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='tabtitle' value='".$line['id']."' selected='selected'>".$line['title']."</option>";
   }
   mysql_free_result($result);
?></select></p>  
<!--<p>Назва поля даних для зберігання значень показника (латинськими літерами та цифри без пробілу): &nbsp;<input type="text" name="field" id="field" /></p>-->
<p>Тип показника: &nbsp;<select name="type" onchange="criterionTypeChanged();">      
        <option id="type" value="float" selected="selected">дійсне число</option>
        <option id="type" value="ufloat" >невідємне дійсне число</option>        
        <option id="type" value="int">ціле число</option> 
        <option id="type" value="uint">невідємне ціле число</option>                 
        <option id="type" value="date">дата</option>      
        <option id="type" value="percent">проценти</option>      
        <option id="type" value="permile">перміле</option>            
        <option id="type" value="char">текстова строка</option>              
      </select></p>       
<div id="characteristics">  
</div>
<p id="error1" class="error_message"></p>
<p><input name="submitbutton" type="submit" value="Додати показник" /> </p>   
    </form>
		</p>
	</div>
</div>