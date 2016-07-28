<?  $module_path="modules/core-create-user";
?>
<script type="text/javascript">	
document.getElementById("moduleInfo").innerHTML= "";
$(function() {$( "#accordion" ).accordion();});

function form0check()
{ if(document.forms['form0'].elements['username'].value != "" && document.forms['form0'].elements['userlgn'].value != "" && document.forms['form0'].elements['userpwd'].value != "")
  { $('#moduleInfo').load('modules/core-create-user/add-user.php',{username: document.forms['form0'].elements['username'].value,
userprf: document.forms['form0'].elements['userprf'].value,
telephone: document.forms['form0'].elements['telephone'].value,
email: document.forms['form0'].elements['email'].value,		
memo: document.forms['form0'].elements['memo'].value,
userlgn: document.forms['form0'].elements['userlgn'].value,
userpwd: document.forms['form0'].elements['userpwd'].value});
  } else 
  { document.getElementById("moduleInfo").innerHTML= "<img src=\"images/error.png\"/>Заповніть інформацією всі обов\'язкові поля";
  }
 return false;
}
</script>
<div id="accordion">
	<h3><a href="#">Створення облікового запису користувача</a></h3>
	<div>
     <form id="form0" name="form0" method="post" action=""  onSubmit="return form0check()">
     <img src="<? echo $module_path;?>/core-create-user.png"/>
     <p>ПІБ: &nbsp;<input name="username" type="text" id="username" value="" size="60" maxlength="127"/></p>
     <p>Належить до профілю користувачів: &nbsp;<select name="userprf" id="userprf">
<? include("../../../cgi-bin/db_functions.php"); 
   $q = "SELECT userprf, title FROM userprofiles";
   $result = ExecuteQuery($q);
   while($line=mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='userprf' value='".$line['userprf']."'>".$line['title']."</option>";
   }
?>
</select> </p>
      <p>Опис користувача: &nbsp;<textarea name="memo" type="text" id="memo" value="" style="width:404px;" maxlength="127"/></p>
      <p>Телефон: &nbsp;<input name="telephone" type="text" id="telephone" value="" size="60" maxlength="127"/></p>
	  <p>Е-пошта: &nbsp;<input name="email" type="text" id="email" value="" size="60" maxlength="127"/></p>
	  <p>Логін: &nbsp;<input name="userlgn" type="text" id="userlgn" value="" size="60" maxlength="127"/></p>
	  <p>Пароль: &nbsp;<input name="userpwd" type="text" id="userpwd" value="" size="60" maxlength="127"/></p>
      <p><input name="submitbutton" type="submit" value="Створити обліковий запис користувача" /></p>
</form>     
     </div>
</div>    
