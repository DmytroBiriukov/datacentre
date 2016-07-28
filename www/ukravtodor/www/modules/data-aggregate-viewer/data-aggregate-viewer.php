<?php 
   include("../../../cgi-bin/db_functions.php");   
   $module_name="data-aggregate-viewer";
   $module_path="modules/".$module_name."/".$module_name.".php";  
   $agg_id=$_POST['aggregate'];
   $agg_file="../../../aggs/agg".$agg_id.".xml";
   $agg_title="";
   $agg_descr="";
   $agg_eform="";
   $paramstring=" ,";   
   if (file_exists($agg_file))
   { 

   $query = " SELECT * FROM aggregate WHERE id=".$agg_id." ;";
   $result = ExecuteQuery($query);
   if( mysql_num_rows($result) == 1)
   {   while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { $agg_title=$line['title'];
	    $agg_descr=$line['description'];
		$agg_eform=$line['eform'];	
?>
<h1><? echo $agg_title;?></h1>
<div style="min-height:65px"><img src="modules/<? echo $module_name; ?>/<? echo $module_name; ?>-large.png" style="display:inline; float:left"/> 
<div style="font-style:italic">
<? echo $agg_descr;?>  
</div>
</div>
<?				
	    $query2="SELECT e.paramtitle, e.paramfield, e.paramtype FROM aggregate2eform2param a, eform2params e WHERE a.agg=".$agg_id." AND a.param=e.ID AND a.variable='N'";		
        $result2 = ExecuteQuery($query2);	
        if( mysql_num_rows($result2) >0)
        {  echo "<p>Виберіть значення параметрів агрегації:";
		   while ($line2 = mysql_fetch_array($result2, MYSQL_ASSOC))
		   { //echo "<p> Paramtitle=".$line2['paramtitle'].", paramfield=".$line2['paramfield'].", paramtype=".$line2['paramtype'].". </p>"; 
		     $query3="SELECT DISTINCT ".$line2['paramfield']." FROM data_".$agg_eform." ORDER BY ".$line2['paramfield']."";		
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
		
		$argstring="'modules/".$module_name."/showform.php',{aggregate: ".$agg_id.", eform: ".$agg_eform."".$paramstring."}";
		//echo $argstring;
		echo "<input type='button' value='Показати агреговані дані' onClick=\" $('#aggegateFormContent').load(".$argstring."); \"/>";

		
	  }
   }else
   { 
?> 
  <script language="javascript">document.getElementById("moduleInfo").innerHTML= "<div id='alert'><img src=\"images/alert.png\"/>В базі даних немає записів про цей шаблон агрегації даних </div>";</script>
<?
   }
?>   
<div id="aggegateFormContent">
</div>
<?
   }// if eform file exists 
   else
   { 
?> 
  <script language="javascript">document.getElementById("moduleInfo").innerHTML= "<div id='alert'><img src=\"images/alert.png\"/>Не можливо знайти шаблон агрегації даних </div>";</script>
<?
   }
?>



