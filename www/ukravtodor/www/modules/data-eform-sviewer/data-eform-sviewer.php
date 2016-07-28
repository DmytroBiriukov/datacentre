<?php 
   include("../../../cgi-bin/db_functions.php"); 
   $module_name="data-eform-sviewer";
   $module_path="modules/".$module_name."/".$module_name.".php";  
   $eform_id=$_POST['eform'];
   $eform_id_share=$_POST['ID_share'];  
   $eformfile="../../../eforms/eform".$eform_id.".xml";
   if (file_exists($eformfile))
   { // -1- 
     $query = " SELECT * FROM eform WHERE id=".$eform_id." ;";
     $result = ExecuteQuery($query);
     if( mysql_num_rows($result) == 1)
     {   while($line = mysql_fetch_array($result, MYSQL_ASSOC))
         { $eform_title=$line['title'];
	       $eform_descr=$line['description'];
		   $eform_tab=$line['tab'];
		   $IDfield=$line['IDfield'];
		   
?>
<h1><? echo $eform_title;?></h1>
<div style="min-height:65px"><img src="modules/<? echo $module_name; ?>/<? echo $module_name; ?>-large.png" style="display:inline; float:left"/> 
<div style="font-style:italic">
<? echo $eform_descr;?>  
</div>
</div>
<?		   
	    $query2="SELECT e.paramtitle, e.paramfield, e.paramtype FROM eform2params e WHERE e.eform=".$eform_id." ";		
        $result2 = ExecuteQuery($query2);	
        if( mysql_num_rows($result2) >0)
        {  echo "<p>Виберіть значення параметрів звітньої форми:";
		   while ($line2 = mysql_fetch_array($result2, MYSQL_ASSOC))
		   { //echo "<p> Paramtitle=".$line2['paramtitle'].", paramfield=".$line2['paramfield'].", paramtype=".$line2['paramtype'].". </p>"; 
		     $query3="SELECT DISTINCT ".$line2['paramfield']." FROM ".$eform_tab." ORDER BY ".$line2['paramfield']."";		
             $result3 = ExecuteQuery($query3);				 
        	 if( mysql_num_rows($result3) >0)
        	 { echo "<p>".$line2['paramtitle'].": &nbsp;<select name='".$line2['paramfield']."' id='".$line2['paramfield']."'>";                
			   while ($line3 = mysql_fetch_array($result3, MYSQL_ASSOC))
		       {  echo "<option id='".$line2['paramfield']."' value='".$line3[$line2['paramfield']]."' selected='selected'>".$line3[$line2['paramfield']]."</option>";			   
			   }
			   echo "</select></p>";
			  $paramstring=$paramstring." ".$line2['paramfield'].": document.getElementById('".$line2['paramfield']."').options[document.getElementById('".$line2['paramfield']."').selectedIndex].value, ";
			 }
		   }
		   $paramstring=substr($paramstring,0,-2);
		   echo "</p>";
		}		
		
		$argstring="'modules/".$module_name."/showform.php',{eform: ".$eform_id.", ID_share: ".$eform_id_share.", ".$paramstring."}";
		//echo $argstring;
		echo "<input type='button' value='Показати форму звітності' onClick=\" $('#eFormContent').load(".$argstring."); \"/>";

		
	  }
   }else
   { 
?> 
  <script language="javascript">document.getElementById("moduleInfo").innerHTML= "<div id='alert'><img src=\"images/alert.png\"/>В базі даних немає записів про цей шаблон форми звітності </div>";</script>
<?
   }
?>   
<div id="eFormContent">
</div>
<?
   }// if eform file exists 
   else
   { 
?> 
  <script language="javascript">document.getElementById("moduleInfo").innerHTML= "<div id='alert'><img src=\"images/alert.png\"/>Не можливо знайти шаблон форми звітності </div>";</script>
<?
   }
?>