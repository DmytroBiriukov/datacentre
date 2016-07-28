<?php

include('def.php');

function my_db_connect()
{
    $r = mysql_pconnect(host,user,pwd);
    if(preg_match('/^5\./',mysql_get_server_info($r)))
    mysql_query('SET SESSION sql_mode=0');
    mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error());
    return $r;
}

function my_db_select()
{
  mysql_select_db(database);
}

function checkUserPass($username, $password, &$user, &$usergroupname, &$userprf)
{  $username = trim(str_replace("'","''",$username));
   $password = trim($password);
   // Verify that user is in database
   $q = "SELECT u.ID, u.username, u.userprf, ug.title FROM users u, userprofiles up, usergroups ug WHERE u.userlgn = '".$username."' AND u.userpwd='".$password."' AND ug.usergrp=up.usergrp AND up.userprf=u.userprf";   
   $result = ExecuteQuery($q);
   $ID=0;
   if(!$result || !(mysql_num_rows($result) == 1))
   { $username=''; 
     return 0; //Indicates failure   
   } else 
   { $line=mysql_fetch_array($result, MYSQL_ASSOC); 
     $ID=$line['ID']; 
	 $user=$line['username'];
	 $userprf=$line['userprf'];
	 $usergroupname=$line['title'];
   }
   return $ID;     
}

function  checkModuleRights( $aID, $script_name)
{  $q = "SELECT ID FROM module2user WHERE userprf = '".$aID."' AND module=(SELECT ID FROM modules WHERE path='".$script_name."' )";  
   $result = ExecuteQuery($q);
   if(!$result || !(mysql_num_rows($result) == 1))
   {  return 0; //Indicates failure
   } else {$line=mysql_fetch_array($result, MYSQL_ASSOC); $ID=$line['ID'];}
   return $ID; 
}

function mystrdecode($str, $from, $to)// "UTF-8","windows-1251" "iso-8859-5"
{ $rstr = @iconv($from,$to,$str); 
  if ($rstr == false) {return $str;} else {return $rstr;}
}


function RegionList($reg_id)
{ $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);

      $query = "SELECT title,id FROM reg ORDER BY id";
      $result = mysql_query($query, $con);
      print("<select id='param_".$reg_id."' name='param_".$reg_id."'>");
      while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { $fld=$line['title'];
        $n=$line['id'];
        print("<option  value='".$n."' selected='selected' >".$fld."</option>");
        // id='param_".$reg_id."' name='param_".$reg_id."'
      }
      print("</select>");
 mysql_free_result($result);
 mysql_close($con);
}

function FinSourceList($id)
{ $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);

      $query = "SELECT source, ID FROM fin_source ORDER BY ID";
      $result = mysql_query($query, $con);
      print("<select id='param_".$id."' name='param_".$id."'>");
      while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { $fld=$line['source'];
        $n=$line['ID'];
        print("<option  value='".$n."' selected='selected' >".$fld."</option>");
        // id='param_".$id."' name='param_".$id."'
      }
      print("</select>");
 mysql_free_result($result);
 mysql_close($con);
}


function ShowRegTable()
{
   $link =  my_db_connect();
   if(!empty($link))
    {
      my_db_select();
      $query = "SELECT * FROM reg ORDER BY id";
      $result = mysql_query($query);

          while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
        {
                  $fld=$line['title'];
                  $n=$line['id'];
                  if($n<26)
                    { print("<tr> <td width=180 class=breadcrumbs bgcolor=#999999>  <a href='reg.php?reg=$n'> $fld </a> </td>");
                    } else print("<tr> <td width=180 class=breadcrumbs bgcolor=#999999>  $fld </td>");
                  for ($j = 1; $j <= 2; $j++)
                  {
                  for ($i = 1; ($j==1 && $i<5) || ($j==2 && $i < 4) ; $i++)
                   {
/*
                    $fldname="V$j$i";
            print("<td width=60> <div align='right'> $line[$fldname] </div> </td>");
                    $fldname="R$j$i";
                    print("<td width=20 bgcolor='#FFFF99'> <div align='right'> $line[$fldname] </div> </td>");
                        $fldname="W$j$i";
                        print("<td width=60 bgcolor='#FFFF66'> <div align='right'> $line[$fldname] </div> </td>");
*/
                    $fldname="W$j$i";
		    print("<td bgcolor='#FFFFCC'> <div align='right'> $line[$fldname] </div> </td>");


                   }
                  }
          print(" </tr>");
        }
     mysql_free_result($result);
   }else echo "<em> неможлтво підключитися до БД</em>";
}

function printRegTitle($r)
{
   $link =  my_db_connect();
   if(!empty($link))
   {  my_db_select();
      $query = "SELECT title FROM reg WHERE id=$r";
      $result = mysql_query($query);
      if($line = mysql_fetch_array($result, MYSQL_ASSOC))
      {
         $title=$line['title'];
      }
   }else echo "<em> неможливо підключитися до БД</em>";
   echo $title;
}

/*
function replaceRegIDs()
{
  $tabs=array("cty"=>'cty', "ind"=>'ind', "agr"=>'agr');
  $link=my_db_connect();
  if(!empty($link))
    { my_db_select();
      $query = "SELECT title,id FROM reg ORDER BY id";
      $result = mysql_query($query);
      while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
      { $regTitle=$line['title'];
        $n=$line['id'];
        if($n<26)
        {  foreach($tabs as $tab)
           {
               $query2="UPDATE $tab SET reg =$n WHERE reg_title = '$regTitle'";
               $result2 = mysql_query($query2);
           }

        }
      }
      mysql_free_result($result);
   }else print("<em>неможливо підключитись до БД</em>");



}
*/

function ShowTrtInfo($tab, $t, $r)
{
   $link =  my_db_connect();
   if(!empty($link))
    {
      my_db_select();
      $query1 = "SELECT * FROM par WHERE grp='$tab'";
      $result1 = mysql_query($query1);
      $query2 = "SELECT * FROM $tab WHERE reg=$r AND id=$t";
      $result2 = mysql_query($query2);
      $line2 = mysql_fetch_array($result2, MYSQL_ASSOC);
      while ($line1 = mysql_fetch_array($result1, MYSQL_ASSOC))
        { $i=$line1["num"];
                  print("<tr>");
                  $fld1=$line1['title']; print("<td class=breadcrumbs bgcolor='#CCCCCC'> <div align='left'><strong> $fld1 </strong></div></td>");
                  for($year=1;$year<=3;$year++)
                   { $fld1=$line1["avr$year"]; print("<td bgcolor='#FFFF99'> $fld1 </td>");
                     $fld2=$line2["V$i$year"]; print("<td> $fld2 </td>");
                     $fld2=$line2["W$i$year"]; print("<td bgcolor='#FFFF66'> $fld2 </td>");
                   }
          $fld2=$line2["W$i"]; print("<td> $fld2 </td>");
          $fld1=$line1["dsc"]; print("<td> $fld1 </td>");
          print("</tr>");
        }
     mysql_free_result($result1);
     mysql_free_result($result2);
   }else
        {
          print("Unable to connect to database");
        }
}

function ShowRegInfo($tab, $reg)
{  $link =  my_db_connect();
   $ter_cnt=0;
   if(!empty($link))
    {
      mysql_select_db(database);
      switch($tab)
      { case 'ind': $tab='dst';$condition="AND W15>=W25";break;
        case 'agr': $tab='dst';$condition="AND W15<W25";break;
        default: $condition=""; break;
      }

      $query = "SELECT id, title FROM $tab WHERE reg=$reg ".$condition." ORDER BY title";
      $result = mysql_query($query);
      print("<ol>");
      while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
        { $fld=$line['title'];
          $fld2=$line['id'];
                  print("<li> <a href='tab.php?tab=$tab&id=$fld2&title=".$fld." & reg=$reg'> $fld </a> </li>");
                  $ter_cnt++;
        }
      print("</ol>");
      mysql_free_result($result);
   }else print("Unable to connect to database");
   return $ter_cnt;
}

function ShowInfo($dbtable, $n, $m)
{
   $link =  my_db_connect();
   if(!empty($link))
    {
      mysql_select_db(database);
      $query = "SELECT * FROM $dbtable";
      $result = mysql_query($query);
      while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
        { $fld=$line["title"];
          print("<tr> <td width=180 class=breadcrumbs bgcolor=#999999> $fld </td>");
                  for ($j = 1; $j <= $n; $j++)
                  {
                  $fld=$line["W$j"];
                  print("<td width=60 bgcolor=#999999> <div align='right'> $fld </div> </td>");
                  for ($i = 1; $i <= $m; $i++)
                   {
                    $fldname="V$j$i";
            print("<td width=60> <div align='right'> $line[$fldname] </div> </td>");
                    $fldname="R$j$i";
                    print("<td width=20> <div align='right'> $line[$fldname] </div> </td>");
                        $fldname="W$j$i";
                        print("<td width=60 bgcolor='#FFFF66'> <div align='right'> $line[$fldname] </div> </td>");
                   }
                   }
          print(" </tr>");
        }
     mysql_free_result($result);
   }else
        {
          print("Unable to connect to database");
        }
}

function ShowRegTeritoriesInfo($tab, $reg, $flds, $fld2, $fld3)
{  
   $link = my_db_connect();
   if(!empty($link))
   {
      my_db_select();
	  if($tab=='cty')
	  { $query = "SELECT * FROM cty WHERE reg='$reg'";
	  }else
	  {
       $query = "SELECT d.* FROM ".$tab." t, dst d WHERE d.id=t.id AND d.reg='".$reg."'";
	  }
      $result = mysql_query($query);
      $query1 = "SELECT * FROM par WHERE grp='$tab' ORDER BY num";
      $result1 = mysql_query($query1);
      $pnum=0;
      $num_rows = mysql_num_rows($result);

      if($num_rows>0)
      {
          while ($line1 = mysql_fetch_array($result1, MYSQL_ASSOC))
          { $fld=$line1["title"];
		    $fld2=$line1["num"];
			
            print("<td colspan=3 height=60> <div align='center' > <strong>$fld </strong></div> </td>");    $ptitle[$pnum]=$fld2;
            $pnum++;
          }
          print("</tr>");
          mysql_free_result($result1);

          print("<tr bgcolor='#CCCCCC'><td bordercolor='#FFFFFF'> <div align='left' > рік </div></td>");
          for($i=0;$i<$pnum;$i++)
            for($j=2005;$j<=2007;$j++)
               print("<td bordercolor='#FFFFFF' border=1> <div align='center'>$j</div> </td>");
          print("</tr>");
  
/*         $result1 = mysql_query($query1);
          print("<tr bgcolor='#CCCCCC'><td bordercolor='#FFFFFF'> <div align='left' > середнє</div></td>");

          while ($line1 = mysql_fetch_array($result1, MYSQL_ASSOC))
          { $i=$line1["num"];
            for($j=1;$j<=5;$j++)
            { $fld=$line1["avr$j"];
              print("<td colspan=3 bordercolor='#FFFFFF'> <div align='center'> $fld </div> </td>");
            }
          }

          print("</tr>");
          mysql_free_result($result1);

          $result1 = mysql_query($query1);

          print("<tr bgcolor='#CCCCCC'><td bordercolor='#FFFFFF'> <div align='left' > $fld3</div></td>");
          while ($line1 = mysql_fetch_array($result1, MYSQL_ASSOC))
          { $i=$line1["num"];
            for($j=1;$j<=3;$j++)
            { $fld=$line1["wval$j"];
              print("<td colspan=3> <div align='center'> $fld </div> </td>");
            }
          }
          print("</tr>");
          mysql_free_result($result1);
*/
          print("<tr bgcolor='#CCCCCC'><td width=180 > <div align='left'><strong>".$flds['ttitle']."</strong></div> </td>");

/*
          for($k=1;$k<=$pnum;$k++)
	  {
              for($l=1;$l<=3;$l++)
                     {print("<td width=80 bordercolor='#FFFFFF'> <div align='center'><strong>".$flds['year']."</strong></div></td>");
                      print("<td width=40 bordercolor='#FFFFFF'> <div align='center'><strong>".$flds['rank']."</strong></div></td>");
                      print("<td width=60 bordercolor='#FFFFFF'> <div align='center'><strong>W$k$l</strong></div></td> ");
                     }


	  }
*/
          $colpn=3*$pnum+1;
	  echo "<td colspan=$colpn></td></tr>";
//          print("</tr> <tr><td colspan=$colpn height=4> </td></tr>");

          while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
          { $fld=$line["title"];
            print("<tr> <td width=180 class=breadcrumbs bgcolor=#999999> $fld </td>");

            for ($j = 0; $j < $pnum; $j++)
            {
              for ($i = 1; $i <= 3; $i++)
              {
/*
                    $fldname="V$j$i";
                    print("<td width=60> <div align='right'> $line[$fldname] </div> </td>");
                    $fldname="R$j$i";
                    $fldr=$ter_nums["$tab"]-$line[$fldname]+1;
                    print("<td width=20 bgcolor='#FFFF66'> <div align='right'> $fldr </div> </td>");
                    $fldname="W$j$i";
                    print("<td width=60 bgcolor='#FFFF33'> <div align='right'> $line[$fldname] </div> </td>");
*/
//		    $k=$ptitle[$j];
		    if($tab=='cty')
			{
			 $k=$ptitle[$j];
             $fldname="W$k".($i+2);
			
			}else
			{
			 $k=$ptitle[$j];
             $fldname="W$k".($i+2);
			}
		    print("<td bgcolor='#FFFFCC'> <div align='right'>");
			printf("%8.2f", $line[$fldname]);
			print(" </div> </td>");


              }
            }
            print(" </tr>");
          } /**/
      }else print(" </tr>");
      mysql_free_result($result);
   }else print("Unable to connect to database");
}

function sqlUpdateQuery($tableName, $fieldValues, $keyValues)
{
   $link = my_db_connect();
   if(!empty($link))
   {  $aSQL="UPDATE $tableName SET ";
      $i=0;
      foreach($fieldValues as $fieldName => $aValue)
      {
       if($i>0) $aSQL.="', ";       $aSQL.=$fieldName."='".addslashes($aValue);   $i++;
      }
      $aSQL.="' WHERE ";
      $i=0;
      foreach($keyValues as $fieldName => $aValue)
      {
       if($i>0) $aSQL.=" AND ";  $aSQL.=$fieldName."=".$aValue;   $i++;
      }
      $aSQL.="";
      if(!empty($link))
      {
        if(mysql_select_db(database,$link) == True)
       { //echo "<p>".$aSQL."</p>";
        $aQResult= mysql_query($aSQL, $link);
        if($aQResult == True)
        {
          $aResult=mysql_insert_id($link);
        }else
		{ echo "<p>Failed to update. Query: ".$aSQL."</p>";
//		  		  foreach($keyValues as $fieldName => $aValue) $fieldValues[$fieldName]=$aValue;
		  //sqlInsertQuery($tableName, $fieldValues);
		}
           }
      }
  }
}


function sqlDeleteQuery($tableName, $keyValues)
{
   $link = my_db_connect();
   if(!empty($link))
   {  $aSQL="DELETE FROM $tableName WHERE ";
      $i=0;
      foreach($keyValues as $fieldName => $aValue)
      {
       if($i>0) $aSQL.="' AND ";  $aSQL.=$fieldName."='".$aValue;   $i++;
      }
      $aSQL.="'";
      if(!empty($link))
      {
        if(mysql_select_db(database,$link) == True)
       {
        $aQResult= mysql_query($aSQL, $link);
        if($aQResult == True)
        {
          $aResult=mysql_insert_id($link);
        }
           }
      }
  }
}

function getFieldValue($tabName, $fldName, $IDVal, &$fldVal)
{ $link = my_db_connect();
   if(!empty($link))
   {  my_db_select();
      $query =  "SELECT $fldName FROM $tabName WHERE ID=".$IDVal;
          $result = mysql_query($query);
          if($line = mysql_fetch_array($result, MYSQL_ASSOC))
          { $fldVal=$line[$fldName];
          }
      mysql_free_result($result);

   } else echo "<br>Не може підєднатися до бази даних";
}

// $fieldValues - array
function sqlInsertQuery($tableName, $fieldValues)
{
   $aSQL="INSERT INTO $tableName (";
   $i=0;
   foreach($fieldValues as $fieldName => $aValue)
   {

     if($i>0) $aSQL.=",";       $aSQL.=$fieldName;   $i++;
   }
   $aSQL.=") VALUES('";
   $i=0;
   foreach($fieldValues as $fieldName => $aValue)
   {

     if($i>0) $aSQL.="','";     $aSQL.=$aValue;         $i++;
   }
   $aSQL.="')";
//   echo $aSQL;

   $link = my_db_connect();
   if(!empty($link))
   {
      if(mysql_select_db(database,$link) == True)
     {
        $aQResult= mysql_query($aSQL, $link);
        if($aQResult == True)
        {
          $aResult=mysql_insert_id($link);

        }
        else
        {
          $aResult=-1;
        }
     }
     else
     {
        $aResult=-2;
     }
  }
  else
  {
    $aResult=-3;
  }

}

function sqlUpdateInsertQuery($tableName, $fieldValues, $keyValues)
{ $r=sqlUpdateQuery($tableName, $fieldValues, $keyValues);
  if(! $r>0) 
  {  $r=sqlInsertQuery($tableName, array_merge ($fieldValues, $keyValues));
	 if($r>0)
	 {//echo "<br> No raw to update - it was inserted!";
	 }else 
	 { //echo "<br> All attampt were failed!";
	 }
  }
  return $r;
}

function sqlCreateTableQuery($tableName, $fields)
{  $aSQL="CREATE TABLE IF NOT EXISTS ".$tableName." ".$fields.";"; 
echo $aSQL;
   $link = my_db_connect();
   if(!empty($link))
   {
      if(mysql_select_db(database,$link) == True)
     {
        $aQResult= mysql_query($aSQL, $link);
        if($aQResult == True)
        {
          $aResult=1;

        }
        else
        {
          $aResult=-1;
        }
     }
     else
     {
        $aResult=-2;
     }
  }
  else
  {
    $aResult=-3;
  }

}

function displayVARS()
{
 global $HTTP_GET_VARS;
 global $HTTP_POST_VARS;
 print("<br> GET variables are <br>");
 print_r($HTTP_GET_VARS);
 print("<br> POST variables are <br>");
 print_r($HTTP_POST_VARS);
}
// $name contens name of POST variable
// $fields should be an array with field names coresponding to fields of value and text areas
// $fields=array("value" =>  , "text"=>  )
function ShowList($name, $result, $fields)
{
  print("<select name='$name' size='1'>");
  if($result)
  while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
  {
    $valuefld=$line[$fields['value']];
    $textfld=$line[$fields['text']];
    print("<option value='$valuefld'>$textfld</option>");
  }
  print("</select>");
  mysql_free_result($result);
}

function ExecuteQuery($query)
{  $link = my_db_connect();
   if(!empty($link))
   { mysql_select_db(database);
     $result = mysql_query($query);
   }//else echo "empty link";
   return $result;
}

function getField($field, $result)
{
  if($result)
  { $line = mysql_fetch_array($result, MYSQL_ASSOC);
    $valuefld=$line[$field];
  }
  mysql_free_result($result);
  return $valuefld;
}


function AddFileContent($filename, $somecontent)
{
  if ($handle = fopen($filename, 'a')) 
  { if (is_writable($filename)) 
    {  if(fwrite($handle, $somecontent) === FALSE) return 0;
       return 1;
     }else return 0;
     fclose($handle);
  }else return 0;
}

function PutFileContent($filename, $somecontent)
{
  if ($handle = fopen($filename, 'w')) 
  { if (is_writable($filename)) 
    {  if(fwrite($handle, $somecontent) === FALSE) return 0;
       return 1;
     }else return 0;
     fclose($handle);
  }else return 0;
}

?>