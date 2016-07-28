<?  $module_path="modules/core-create-user-group";
?>
<script type="text/javascript">
document.getElementById("moduleInfo").innerHTML= "";
$(function() {$( "#accordion" ).accordion();});

function form1check()
{ if(document.forms['form1'].elements['title'].value != "" && document.forms['form1'].elements['description'].value != "" )
  { $('#moduleInfo').load('modules/core-create-user-group/add-user-group.php',{title: document.forms['form1'].elements['title'].value,
description: document.forms['form1'].elements['description'].value});
  } else 
  { document.getElementById("moduleInfo").innerHTML= "<img src=\"images/error.png\"/>Заповніть інформацією всі поля";
  }
 return false;
}
</script>
<div id="accordion">
	<h3><a href="#">Створення групи користувачів</a></h3>
	<div>
    <form id="form1" name="form1" method="post" action=""  onSubmit="return form1check()">
    <img src="<? echo $module_path;?>/core-create-user-group.png"/>
    <p>Найменування групи: &nbsp;<input name="title" type="text" id="title" value="" maxlength="60" size="50"/></p>
    <p>Опис групи: &nbsp;<textarea name="description" type="text" id="description" value="" maxlength="127"  style="width:400px;"/></p>
    <p><input name="submitbutton" type="submit" value="Створити нову групу користувачів" /></p>
    </form>     
    </div>
</div>