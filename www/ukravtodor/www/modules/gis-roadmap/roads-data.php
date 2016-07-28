<script type="text/javascript">

    $('#loader').hide();
    
    $("#update-button").submit(function() {	

	var poststring = 
        "OGR_FID=" + $("#OGR_FID").attr("value") + 
        "&title=" + $("#title").attr("value") + 
        "&numbway=" + $("#numbway").attr("value") + 
        "&type=" + $("#type").attr("value");
		
	$.ajax({
		type: "POST",
		url: "roads-data-update.php",
		data: poststring,
		success: function(data){
            $('#loader').hide();
            $('#update-button').show();
			}
        });
	return false;
	});
	
    $("#update-submit").click(function(){
	   $("#update-button").submit();
	   $('#update-button').hide();
       $('#loader').show();
	});
</script>

<input name="OGR_FID" id="OGR_FID" type="hidden" value="<?php echo $_POST['id']; ?>" />

<?php 
    include("../../../cgi-bin/db_functions.php");
    $query="SELECT * FROM gis_roads WHERE OGR_FID=".$_POST['id'];

    if(  $result=ExecuteQuery($query) )
    { 
        $field=array();
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        foreach($line as $key => $value)
        {
            $field[$key]=$value;
        }
        mysql_free_result($result);
?>
    <div class="update-table">
    <table >
        <td>
            <tr> 
                <div class="name"><p>Найменування дороги:</p></div>
                <div class="name_update">
                    <p><input name="title" type="text" id="title" value="<? echo $field['title'];?>" size="40" maxlength="120"/></p>
                    </div>
            </tr>
   
            <tr>
                <div class="numbway"><p>Маркування дороги:</p></div>
                <div class="numbway_update">
                    <p><input name="numbway" type="text" id="numbway" value="<? echo $field['numbway'];?>" size="14" maxlength="10"/></p>
                </div>
            </tr>
     
            <tr>
                <div class="description"><p>Тип:</p></div>
                <div class="description_update">
                    <p><select name="type" id="type">   
                                 
                        <? $type_array=array('магістральна','територіальна','районна','сільська','інше');
                           if($field['type']=='') $field['type']='інше';
                           foreach($type_array as $type_value){
                                if($type_value == $field['type']){
                                    echo "<option id='type' value='".$field['type']."' selected='selected'>".$field['type']."</option>";}
                                else{ echo "<option id='type' value='".$type_value."'>".$type_value."</option>";}
                           }
                        ?>
                    </select></p>                      
              </div>
            </tr>
            <tr>
                <div class="loader-div">
                    <center><img id="loader" class="centered" src="img/loading.gif" alt="Внесення змін в базу даних!"></img></center>
                </div>

            </tr>

            <tr>
                <div id="update-button">
                    <p><input type="button" class="input_button"  id="update-submit" value="Внести зміни" /></p>
                </div>
            </tr>
        </td>
    </table>
    </div>
    <?	
       }
       else 
       { 
    ?> 
    <div class="alert-div">
                    <center><img id="alert" class="centered" src="images/alert.png" alt="Помилка підключення до бази даних!"></img>Не може отримати дані про об'єкт за бази даних!</center>
    </div>    
    <?
       }
    ?>   