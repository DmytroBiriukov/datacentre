<?  $module_path="modules/core-create-user-profile";
?>
<script type="text/javascript">
document.getElementById("moduleInfo").innerHTML= "";
$(function() {$( "#accordion" ).accordion();});

function form2check()
{ if(document.forms['form2'].elements['title'].value != "" && document.forms['form2'].elements['description'].value != "" )
  { $('#moduleInfo').load('modules/core-create-user-profile/add-user-profile.php',{title: document.forms['form2'].elements['title'].value,
description: document.forms['form2'].elements['description'].value, usergrp: document.forms['form2'].elements['usergrp'].value});
  } else 
  { document.getElementById("moduleInfo").innerHTML= "<img src=\"images/error.png\"/>Заповніть інформацією всі поля";
  }
 return false;
}
</script>
<div id="accordion">
	<h3><a href="#">Створення профілю користувача</a></h3>
	<div>
     <form id="form2" name="form2" method="post" action=""  onSubmit="return form2check()">
     <img src="<? echo $module_path;?>/core-create-user-profile.png"/>
     <p>Найменування профіля користувача: &nbsp;<input name="title" type="text" id="title" value="" size="52" maxlength="127"/></p>
     <p>Створюється в межах групи користувачів: &nbsp;<select name="usergrp" id="usergrp">
<? include("../../../cgi-bin/db_functions.php"); 
   $q = "SELECT usergrp, title FROM usergroups";
   $result = ExecuteQuery($q);
   while($line=mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='usergrp' value='".$line['usergrp']."'>".$line['title']."</option>";
   }
?>
</select> </p>
     <p>Опис профілю користувача: &nbsp;<textarea name="description" type="text" id="description" value="" maxlength="127"  style="width:404px;"/></p>
     <p><input name="submitbutton" type="submit" value="Створити новий профіль користувача" /></p> 
</form>     
     </div>
</div> 