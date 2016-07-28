<?  $module_path="modules/core-delete-user-profile";
?>
				 <div id="update-data" title="редагування данних">

<script type="text/javascript">

    $('#loader').hide();
    
    $("#update-data").submit(function() {	

	var poststring = 
        "userprf=" + $("#userprf").attr("value");
		
	$.ajax({
		type: "POST",
		url: "<? echo $module_path;?>/data-manipulate.php",
		data: poststring,
		success: function(data){
            $('#loader').hide();
			alert("Профіль користувача був видалений");
			$('#moduleContent').load("<? echo $module_path;?>/core-delete-user-profile.php",{parameter: 'value'});
			}
        });
	return false;
	});
	
    $("#update-submit").click(function(){
	   $("#update-data").submit();
       $('#loader').show();
	});
</script>
<!--
<form id="create-user-group-form" name="create-user-group-form" action="">  
-->
<img src="<? echo $module_path;?>/core-delete-user-profile-large.png"/>
    <div class="update-table">
    <table >  

          <tr>          <td>
                <div class="name"><p>Видалити профіль користувачів:</p></div>
                <div class="name_update">
                    <p>
<select name="userprf" id="userprf">
<? include("../../../cgi-bin/def.php"); 
   $q = "SELECT userprf, title FROM userprofiles";
   $result = ExecuteQuery($q);
   while($line=mysql_fetch_array($result, MYSQL_ASSOC))
   { echo "<option id='userprf' value='".$line['userprf']."'>".$line['title']."</option>";
   }
?>
</select>                    
                    
                    </p>
            </div>
            </td>
      </tr>      
            <tr><td>
                <div class="loader-div">
                    <center><img id="loader" class="centered" src="<? echo $module_path;?>/ajax-loader.gif" alt="Виконання запиту!"></img></center>
                </div>
                </td>
            </tr>
            <tr><td>
                <div class="update-data">
                    <p><input type="button" class="input_button"  id="update-submit" value="Видалити профіль користувачів" /></p>
                </div>
                </td>
            </tr>
</table> 
</div>
		            <p><div id="update_place" name="update_place"></div></p>
            	</div>