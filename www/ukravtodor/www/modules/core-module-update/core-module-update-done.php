<script type="text/javascript">
function closeWindow() 
{ setTimeout(function() {  window.close();}, 10000);
}
window.onload = closeWindow();
</script>
<?
 include("../../../cgi-bin/db_functions.php"); 

 function rrmdir($dir) 
 {  if (is_dir($dir)) 
 	{ $objects = scandir($dir);
      foreach ($objects as $object) 
	  {  if ($object != "." && $object != "..") 
	     { if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
         }
      }
      reset($objects);
      rmdir($dir);
    }
 }

 if ( $_FILES['module-archive']['tmp_name'])
 { 
   $filepath=$_FILES['module-archive']['tmp_name'];
   $path_parts = pathinfo($_FILES['module-archive']['name']);
   $Module_name=$_POST['Module_name'];
   
   if($path_parts['extension']=="tgz")
   {
     if (is_uploaded_file($filepath))
     {  $target_path = projectpath."/www/modules/".$Module_name;
	    
        rrmdir($target_path);
		//mkdir($target_path);
		$target_path=projecttmppath."/".$Module_name.".tgz";
	
        if(move_uploaded_file($filepath, $target_path)) 
        { $str="tar xvfz ".$target_path." --numeric-owner -C ".projectpath."/www/modules";
	      echo $str."<br>";
    	  system($str);
		  unlink($target_path);		  
//		  echo "<br> done.";
        }else echo "Помилка копіювання файлу";
     }else  echo "Файл-архів з оновленням програмного модулю не був завантажений на сервер";     
   }else echo "Невірний формат";
}else echo "Файл-архів з оновленням програмного модулю не був завантажений на сервер";
?>
