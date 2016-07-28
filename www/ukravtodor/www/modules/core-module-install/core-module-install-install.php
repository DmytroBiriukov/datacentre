<script type="text/javascript">
function closeWindow() {
setTimeout(function() {
window.close();
}, 10000);
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
{  $filepath=$_FILES['module-archive']['tmp_name'];
   $path_parts = pathinfo($_FILES['module-archive']['name']);

   if($path_parts['extension']=="tgz")
   {
     if (is_uploaded_file($filepath))
     { $target_path = projectpath."/www/modules/".basename( $_FILES['module-archive']['name'], ".tgz");
	   rrmdir($target_path);
	   $target_path=projecttmppath."/".basename( $_FILES['module-archive']['name']);
	   
       if(move_uploaded_file($filepath, $target_path)) 
       { $str="tar xvfz ".$target_path." --numeric-owner -C ".projectpath."/www/modules";
	     //echo $str."<br>";
    	 echo "<h2>Інстальовано модуль".basename($target_path, ".tgz")."</h2>";
	 	 echo "<p>В директорію модулю роміщені наступні файли:</p>";
		 system($str);
		 unlink($target_path);	
		 $fieldValues=array("title"=>$_POST['title'],"path"=>basename($target_path, ".tgz"), "type"=> $_POST['type'], "installed"=> date("Y-m-d H:m:s"));
	 	 sqlInsertQuery("modules", $fieldValues);
       } else echo "Помилка копіювання файлу";
     }else  echo "Файл-архів з новим програмним модулем не був завантажений на сервер";     
   }else echo "Невірний формат";
}else echo "Файл-архів з новим програмним модулем не був завантажений на сервер";

?>
