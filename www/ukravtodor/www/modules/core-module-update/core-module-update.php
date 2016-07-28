<? 
$POST_MAX_SIZE = ini_get('post_max_size');
$mul = substr($POST_MAX_SIZE, -1);
$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
$POST_MAX_SIZE=$mul*(int)$POST_MAX_SIZE;
$module_id=$_POST['module_id'];
/*

*/			
?>
<img src="modules/core-module-update/core-module-update-large.png"/>
<script type="text/javascript">
$(function() {$( "#accordion" ).accordion();});
</script>

<div id="accordion">
<? /*
?>
	<h3><a href="#">Оновлення програмного модулю</a></h3>
	<div>
    <form name="importModule"  action="modules/core-module-update/core-module-update-done.php" enctype="multipart/form-data" method="POST" target="_blank">
    <input type="hidden" value="<? echo $POST_MAX_SIZE; ?>" name="MAX_FILE_SIZE" />  
    <input type="hidden" value="<? echo $module_id; ?>" name="Module_name" />  
    <table >
       <tr>
        <td>    
    <div class="name"><p>Будь ласка виберіть tgz-архів з модулем</p></div>      
    <input type="file" name="module-archive" onChange="document.forms['importModule'].importModule_submit.disabled='';"/>   
    <input type="submit" name="importModule_submit" id="importModule_submit" value="Інсталювати модуль" disabled="disabled"  /> 
                </td>
            </tr>
     </table>     
    </form>
    </div>
	<h3><a href="#">Список файлів</a></h3>
	<div>    
<?  include("../../../cgi-bin/db_functions.php"); 
    $path = projectpath."/www/modules/".$module_id;
    $dir_handle = @opendir($path) or die("Unable to open $path");
    while ($file = readdir($dir_handle)) 
	{   if($file == "." || $file == "..")
        continue;
        echo "<a href=\"$file\">$file</a><br />";
    }
    closedir($dir_handle); 
	
	// $files=array();
	// echo json_encode($files);
    // $.getJSON('http://url/of/your/script.php', function(files) {  files[i];  });
?>    
	</div>
	
<? */
?>	
	<h3><a href="#">Завантаження на сервер (оновлення) окремого файлу</a></h3>
	<div>    
    <form name="fileUpload"  action="modules/core-module-update/core-file-upload.php" enctype="multipart/form-data" method="POST" target="_blank">
    <input type="hidden" value="<? echo $POST_MAX_SIZE; ?>" name="MAX_FILE_SIZE" />  
    <input type="hidden" value="<? echo $module_id; ?>" name="Module_name" />  
    <table >
       <tr>
        <td>    
    <div class="name"><p>Будь ласка виберіть файл</p></div>      
    <input type="file" name="module-archive" onChange="document.forms['fileUpload'].fileUpload_submit.disabled='';"/>   
    <input type="submit" name="fileUpload_submit" id="fileUpload_submit" value="Оновити файл" disabled="disabled"  /> 
                </td>
            </tr>
     </table>     
    </form>    
    </div>
</div>    
<?
/*
*/
?>


