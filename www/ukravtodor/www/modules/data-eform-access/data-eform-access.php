<?  $module_path="modules/data-eform-access/data-eform-access.php";
    include("../../../cgi-bin/db_functions.php"); 
?>
<img src="modules/data-eform-access/data-eform-access.png"/>

<script type="text/javascript">
function ConnectTable()
{ $('#Parameters').load('modules/data-eform-access/list_param.php',{tabtitle:document.getElementById('tabtitle').value});
  document.forms['form0'].submitbutton.disabled='';
  document.getElementById('title').value=document.getElementById('tabtitle').options[document.getElementById('tabtitle').selectedIndex].text;
}
$(function() 
{ $( "#accordion" ).accordion();
  $( "#startdate" ).datepicker({dateFormat: 'yy-mm-dd'});
//  $( "#startdate" ).formatDate('yy-mm-dd');
  $( "#enddate" ).datepicker({dateFormat: 'yy-mm-dd'});
 // $( "#enddate" ).formatDate('yy-mm-dd');   
});

</script>

<div id="accordion">
	<h3><a href="#">Відкриття доступу користувачам для редагування показників електронних форм звітності</a></h3>   
	<div>
		<p>
     <form id="form0" name="form0" method="post" action=""  onSubmit="return form0check()"> 

<? $query = " SELECT userprf, title FROM userprofiles WHERE usergrp>0 ORDER BY usergrp, userprf"; 
   $result = ExecuteQuery($query);
?>
  <p>Виберіть користувача: &nbsp;<select name="user" id="user">                
<?
$selected=1;
 while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='user' value='".$line['userprf']."' ";
     if($selected == 1) { echo " selected='selected' "; $selected=0;}
     echo "  >".$line['title']."</option>";
   }
   mysql_free_result($result);   
?></select></p>  
<? $query = " SELECT * FROM eform ORDER BY ID"; 
   $result = ExecuteQuery($query);
?>
  <p>Виберіть електронну форму звітності: &nbsp;<select name="tabtitle" id="tabtitle" onchange="ConnectTable();">                
<? while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='tabtitle' value='".$line['id']."' selected='selected'>".$line['title']."</option>";
   }
   mysql_free_result($result); 
?></select>  
  <p>Змістовний опис щодо надання доступу до електронної форми звітності: &nbsp;<input type="text" name="title" id="title" /></p>
  <p>Вкажіть початок строку, на який надається право доступу до форми звітності: &nbsp;<input type="text" name="startdate" id="startdate" /></p>
  <p>Вкажіть кінець строку, на який надається право доступу до форми звітності: &nbsp;<input type="text" name="enddate" id="enddate" /></p>
  <div id="Parameters"><em>Параметри електронної форми звітності.</em>
  </div>
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