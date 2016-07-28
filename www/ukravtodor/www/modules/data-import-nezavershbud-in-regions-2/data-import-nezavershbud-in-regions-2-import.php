<script type="text/javascript">
function closeWindow() {
setTimeout(function() {
window.close();
}, 200000);
}
window.onload = closeWindow();
</script>
    <h1>Завантаження даних</h1>
<?
$mode=$_POST['mode'];

function is_numbway($code)
{ $suggestion=false;
  $code=trim($code);
  $vowels = array("     ", "    ", "   ", "  ", " ");
  $code=  str_replace ($vowels ,"",$code);
//  echo " <".$code."> len=".strlen($code)." ";
  //if(is_numeric($code[2]) && is_numeric($code[3])) echo "yes"; else echo "no";
  if(strlen($code)== 5 && ($code[0]=='М' || $code[0]=='Р' && $code[1]=='-' )$suggestion=true; //&& ctype_digit( $code[2]) && ctype_digit($code[3])) 
  if(strlen($code)== 8 && $code[0]=='Т' && $code[1]=='-' && $code[4]=='-'  )$suggestion=true; // && ctype_digit( $code[2]) && ctype_digit($code[3]) && ctype_digit( $code[5]) && ctype_digit($code[6])
  if(strlen($code)== 11 && ($code[0]=='С' || $code[0]=='О') && $code[1]=='-' && $code[4]=='-' && $code[7]=='-' )$suggestion=true; // && ctype_digit( $code[2]) && ctype_digit($code[3]) && ctype_digit( $code[5]) && ctype_digit($code[6])  && ctype_digit( $code[8]) && ctype_digit($code[9])
  
  return $suggestion;
}	  


function unset_array($a)
{ foreach ($a as $key => $value)
  { unset($a[$key]);
  }
}


if ( $_FILES['module-archive']['tmp_name'])
{  $filepath=$_FILES['module-archive']['tmp_name'];
   $path_parts = pathinfo($_FILES['module-archive']['name']);

   if($path_parts['extension']=="xls")
   {
     if (is_uploaded_file($filepath))
     {  
	 error_reporting(E_ALL ^ E_NOTICE);
     require_once '../../../cgi-bin/excel_reader2.php';
     $data = new Spreadsheet_Excel_Reader($filepath,false);
	 include("../../../cgi-bin/def.php");
	 


   $count=0;
   $sheet_index=0;
   $sheet_count=4;
   $n0=array(6);
   $n=array(24);
   $n_jn=array(2);
      for($i=4; $i <= $data->rowcount($sheet_index); $i++)
      {  
	     if(is_numbway($data->val($i,2,$sheet_index)))
	     {  $fieldValues=array();
            $vowels = array("     ", "    ", "   ", "  ", " ");
			$fieldValues['numbway']=str_replace ($vowels ,"", $data->val($i,2,0));
		    $fieldValues['object']=$data->val($i,3,0);
		    $fieldValues['id_region']=$_POST['regID']; 
			$fieldValues['fin_month']=$_POST['select_month'];
			$fieldValues['start_month']=$_POST['start_month']; 
			$fieldValues['year']=$_POST['select_year'];
			$fieldValues['type']='передбачено фінансування';
			
			$count++;		
			$jn=2;			
		    for($jj=$n0[$sheet_index]; $jj <= $n[$sheet_index]; $jj++) 
		    { $value=trim($data->val($i,$jj,$sheet_index));
              if(is_numeric($value)) $fieldValues['W_'.$jn]=$value; else $fieldValues['W_'.$jn]=floatval($value);			  
			  $jn++;
			}
		    if($mode=='import')
            {  sqlInsertQuery("nezavershbud", $fieldValues);
		    }else
			{  print_r($fieldValues);			   
			}
		    unset_array($fieldValues);
		 }else echo $data->val($i,2,$sheet_index);
	  }
	  echo "<p> Завантажено дані про ".$count." об'єкти </p>";
     }else  echo "Файл з даними не був завантажений на сервер";     
   }else echo "Невірний формат";
}else echo "Файл з даними не був завантажений на сервер";

?>
