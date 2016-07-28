<script type="text/javascript">
function closeWindow() 
{ setTimeout(function() {  window.close();}, 4000);
}
window.onload = closeWindow();
</script>
<?
 include("../../../cgi-bin/db_functions.php"); 

 if ( $_FILES['module-archive']['tmp_name'])
 { 
   $filepath=$_FILES['module-archive']['tmp_name'];
   $path_parts = pathinfo($_FILES['module-archive']['name']);
   $Module_name=$_POST['Module_name'];
   
   if (is_uploaded_file($filepath))
   {  $target_path = projectpath."/www/modules/".$Module_name;
	  //if (file_exists($target_path."/" . $_FILES['module-archive']["name"])) unlink($target_path."/" . $_FILES['module-archive']["name"]);
	  //else echo "Файл не був завантажений на сервер 3";
      if (! move_uploaded_file($filepath, $target_path."/" . $_FILES['module-archive']["name"] )){echo "Файл не може бути записаний!";} else echo "File <em>". $_FILES['module-archive']["name"]." </em> was successfully updated!";
	  //echo "OK!  file: ".$target_path."/" . $_FILES['module-archive']["name"] ;
   }else echo "Файл не був завантажений на сервер";
 }else echo "Файл не був завантажений на сервер 2";
?>
