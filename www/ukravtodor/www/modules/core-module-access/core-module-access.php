<?  $module_path="modules/core-module-access/core-module-access.php";
    include("../../../cgi-bin/db_functions.php"); 
?>
<img src="modules/core-module-access/core-module-access.png"/>

<script type="text/javascript">
function ConnectTable()
{ $('#Parameters').load('modules/core-module-access/list_param.php',{tabtitle:document.getElementById('tabtitle').value});
  document.forms['form0'].submitbutton.disabled='';
}
$(function() 
{ $( "#accordion" ).accordion();
  $( "#startdate" ).datepicker({dateFormat: 'yy-mm-dd'});
//  $( "#startdate" ).formatDate('yy-mm-dd');
  $( "#enddate" ).datepicker({dateFormat: 'yy-mm-dd'});
 // $( "#enddate" ).formatDate('yy-mm-dd');   
});

    function DisplayFormValues()
    {
        var str = '';
        var elem = document.getElementById('form0').elements;
        for(var i = 0; i < elem.length; i++)
        {
            str += "<b>Type:</b>" + elem[i].type + "&nbsp&nbsp";
            str += "<b>Name:</b>" + elem[i].name + "&nbsp;&nbsp;";
            str += "<b>Value:</b><i>" + elem[i].value + "</i>&nbsp;&nbsp;";
            str += "<BR>";
        } 
        document.getElementById('moduleInfo').innerHTML = str;
    }
/*
DisplayFormValues();
  
function form0check()
{ var args=Array();
  
  var string=""; //="tabtitle: '"+document.getElementById('tabtitle').value+"'";
  var elem = document.getElementById('form0').elements;
  var flag=0;
  for(var i = 0; i < elem.length; i++)
  { if(elem[i].type != 'submit')
    { if(flag>0) string=string+", ";
	  string=string+elem[i].name + ": &quot;"+elem[i].value+"&quot;";
	  flag=1;
	}
  } 
  args[0]=string;
   document.getElementById('moduleInfo').innerHTML = string;
  $('#moduleInfo').load('modules/data-eform-access/graccess.php',args); 
  return false;
}

 function showValues() 
{ var str = $("form0").serialize();
  $("#moduleInfo").text(str);
}*/
</script>

<div id="accordion">
	<h3><a href="#">Відкриття доступу користувачам до програмних модулів</a></h3>   
	<div>
		<p>
<form id="form0" name="form0" method="post" action=""  onSubmit="return form0check()">  

<? $query = " SELECT userprf, username FROM users ORDER BY ID"; 
   $result = ExecuteQuery($query);
?>
  <p>Виберіть користувача: &nbsp;<select name="user" id="user">                
<? while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='user' value='".$line['userprf']."' selected='selected'>".$line['username']."</option>";
   }
   mysql_free_result($result);   
?></select></p>  
<? $query = " SELECT * FROM modules ORDER BY ID"; 
   $result = ExecuteQuery($query);
?>
  <p>Виберіть програмний модуль: &nbsp;<select name="tabtitle" id="tabtitle" onchange="ConnectTable();">                
<? while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='tabtitle' value='".$line['ID']."' selected='selected'>".$line['title']."</option>";
   }
   mysql_free_result($result); 
?></select>  
  <p>Вкажіть початок строку, на який надається право доступу: &nbsp;<input type="text" name="startdate" id="startdate" /></p>
  <p>Вкажіть кінець строку, на який надається право доступу: &nbsp;<input type="text" name="enddate" id="enddate" /></p>
  <div id="Parameters"><em>Параметри доступу до програмного модуля.</em>
  </div>
  <p id="error0" class="error_message"></p>
  <p><input name="submitbutton" type="submit" value="Надати доступ" disabled="disabled" /> </p>
</form>
	</div>
</div>