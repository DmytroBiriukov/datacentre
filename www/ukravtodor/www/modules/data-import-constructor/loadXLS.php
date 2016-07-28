<script type="text/javascript">
function closeWindow() {
setTimeout(function() {
window.close();
}, 1000);
}
window.onload = closeWindow();
</script>
<?php
  include("../../../cgi-bin/db_functions.php");  
$filepath=$_FILES['xlsFILE']['tmp_name'];
$eform=$_POST['eform'];
if ( $filepath)
{  $path_parts = pathinfo($_FILES['xlsFILE']['name']);

   if($path_parts['extension']=="xls")
   {
     if (is_uploaded_file($filepath))
     {  

        $target_path = projecttmppath."/".$eform.".xls";
/*	echo $target_path;
	displayVARS();*/
       if(move_uploaded_file($filepath, $target_path)) 
       { 
	 	 echo "<p>XLS файл переміщено на сервер</p>";
       } else echo "Помилка копіювання файлу";
     }else  echo "XLS-файл не був завантажений";     
   }else echo "Невірний формат";
}else echo  "XLS-файл не був завантажений на сервер";     
?>
