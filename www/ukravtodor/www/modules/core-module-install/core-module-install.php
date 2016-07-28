<? 
$POST_MAX_SIZE = ini_get('post_max_size');
$mul = substr($POST_MAX_SIZE, -1);
$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
$POST_MAX_SIZE=$mul*(int)$POST_MAX_SIZE;
?>
	<img src="modules/core-module-install/core-module-install-large.png"/>
<script type="text/javascript">
$(function() {$( "#accordion" ).accordion();});
</script>
<div id="accordion">
	<h3><a href="#">Інсталяція програмного модулю</a></h3>
	<div>
    <form name="importModule" action="modules/core-install-module/core-install-module-install.php"    enctype="multipart/form-data" method="POST" target="_blank">
    <input type="hidden" value="<? echo $POST_MAX_SIZE; ?>" name="MAX_FILE_SIZE" />  
    <table >
       <tr>
        <td>    
    <div class="name"><p>Будь ласка виберіть tgz-архів з модулем</p></div>      
    <input type="file" name="module-archive" onChange="document.forms['importModule'].importModule_submit.disabled='';"/>   
		</td>
       </tr>
       <tr>
        <td> 
    <input name="title" id="title" value="Змістовна назва модуля"/>
    	</td>
       </tr>
       <tr>
        <td> 
    <select id="type" name="type">
    	<option id="type" value="адміністрування">адміністрування</option>
        <option id="type" value="імпорт даних">імпорт даних</option>
        <option id="type" value="звіти">звіти</option>
        <option id="type" value="електронні карти">електронні карти</option> 
    </select>
    	</td>
       </tr>
       <tr>
         <td>
             <input type="submit" name="importModule_submit" id="importModule_submit" value="Інсталювати модуль" disabled="disabled"  /> 
                </td>
            </tr>
     </table>     
    </form>
    </div>
</div>    



