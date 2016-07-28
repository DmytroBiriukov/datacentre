<?  $module_path="modules/data-aggegate-access/data-aggegate-access.php";
    include("../../../cgi-bin/db_functions.php"); 
?>
<img src="modules/data-aggregate-access/data-aggregate-access.png"/>

<script type="text/javascript">
function ConnectTable()
{ document.forms['form0'].submitbutton.disabled='';
  document.getElementById('title').value=document.getElementById('tabtitle').options[document.getElementById('tabtitle').selectedIndex].text;
}
$(function() 
{ $( "#accordion" ).accordion();
  $( "#startdate" ).datepicker({dateFormat: 'yy-mm-dd'});
  $( "#enddate" ).datepicker({dateFormat: 'yy-mm-dd'});   
});

function form0check()
{ if(document.forms['form0'].elements['startdate'].value != "" && document.forms['form0'].elements['enddate'].value != "")
  { $('#moduleInfo').load('modules/data-aggregate-access/graccess.php',{tabtitle:document.forms['form0'].elements['tabtitle'].value, user:document.forms['form0'].elements['user'].value, startdate:document.forms['form0'].elements['startdate'].value, enddate:document.forms['form0'].elements['enddate'].value, title:document.forms['form0'].elements['title'].value});
  } else 
  { document.getElementById("moduleInfo").innerHTML= "<div id='alert'><img src='images/alert.png'/>Заповніть інформацією всі обов\'язкові поля</div> ";
  }
  return false;
}
</script>

<div id="accordion">
	<h3><a href="#">Відкриття доступу користувачам для перегляду агрегованих форм звітності</a></h3>   
	<div>
		<p>
     <form id="form0" name="form0" method="post" action=""  onSubmit="return form0check()"> 

<? $query = " SELECT userprf, title FROM userprofiles WHERE usergrp>0 ORDER BY usergrp, userprf"; 
   $result = ExecuteQuery($query);
?>
  <p>Виберіть профіль користувачів: &nbsp;<select name="user" id="user">                
<?
$selected=1;
 while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='user' value='".$line['userprf']."' ";
     if($selected == 1) { echo " selected='selected' "; $selected=0;}
     echo "  >".$line['title']."</option>";
   }
   mysql_free_result($result);   
?></select></p>  
<? $query = " SELECT * FROM aggregate ORDER BY ID"; 
   $result = ExecuteQuery($query);
?>
  <p>Виберіть агреговану форму звітності: &nbsp;<select name="tabtitle" id="tabtitle" onchange="ConnectTable();">                
<? while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='tabtitle' value='".$line['id']."' selected='selected'>".$line['title']."</option>";
   }
   mysql_free_result($result); 
?></select>  
  <p>Змістовний опис щодо надання доступу до агрегованої форми звітності: &nbsp;<input type="text" name="title" id="title" /></p>
  <p>Вкажіть початок строку, на який надається право доступу: &nbsp;<input type="text" name="startdate" id="startdate" /></p>
  <p>Вкажіть кінець строку, на який надається право доступу: &nbsp;<input type="text" name="enddate" id="enddate" /></p>
  <p id="error0" class="error_message"></p>
  <p><input name="submitbutton" type="submit" value="Надати доступ" disabled="disabled" /> </p>
</form>
	</div>
</div>
<? 
  if($selected == 0)
 { ?>
<script>
ConnectTable();   
</script>
<?
 }
?>