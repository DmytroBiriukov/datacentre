<?  $module_path="modules/core-users-list";
?>
<script type="text/javascript" src="js/jquery.editinplace.js"></script>
<script type="text/javascript">
document.getElementById("moduleInfo").innerHTML= "";
var key_value;
$(function() 
{ $( "#accordion" ).accordion();
  $( "#usertree" ).menu();
  var currentUser=0;
  
  function checkLength( o, min, max ) 
  { if ( o.val().length > max || o.val().length < min ) 
    { return false;
    } else 
	{ return true;
    }
  }

  function checkRegexp( o, regexp) 
  { if ( !( regexp.test( o.val() ) ) ) 
   { return false;
   } else 
   { return true;
   }
  }

 function PositionDialog(link) 
{ $('#dialog-form').dialog('option', 'position', [ $(link).position().top, $(link).position().left]);
}
  
  $( "#dialog-form" ).dialog(
  { autoOpen: false,
    height: 400,
    width: 500,
    modal: true,
    buttons: 
	{ /*"Внести зміни": function() 
	  {  var bValid = true;
         document.getElementById("userformalert").innerHTML="";
		 var username=document.getElementById("username"),
		 userlgn=document.getElementById("userlgn"),
		 memo=document.getElementById("memo"),
		 email=document.getElementById("email");
*/
/*          bValid = bValid && checkLength( username, 3, 255 );
         bValid = bValid && checkLength( email, 6, 80 );
         bValid = bValid && checkLength( userlgn, 5, 16 );
 
         bValid = bValid && checkRegexp( userlgn, /^[a-z]([0-9a-z_])+$/i);
         bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
        bValid = bValid && checkRegexp( password, /^([0-9a-zA-Z])+$/);
*/ /*
         if ( bValid ) 
		 { 
*//*
		 $( "#users tbody" ).append( "<tr>" +
                            "<td>" + name.val() + "</td>" +
                            "<td>" + email.val() + "</td>" +
                            "<td>" + password.val() + "</td>" +
                        "</tr>" );
						

			*/
/*
		   document.forms['userform'].submit();
           $( this ).dialog( "close" );					
         } else
		 { document.getElementById("userformalert").innerHTML="Заповніть всі поля!";
		 }

       },
*/
       "Закрити": function() 
	   { $( this ).dialog( "close" );
       }
		
	},
    close: function() 
	{  allFields.val( "" ).removeClass( "ui-state-error" );
    }
  }); 
  		
  
  PositionDialog('#accordion');
});
</script>
<style>
    .ui-menu { width: 200px; margin-bottom: 2em; }
</style>

<div id="dialog-form" title="Дані про користувача">
<p class="editable_textarea" id='username'></p>
<p class="editable_textarea" id='userlgn'></p>
<p class="editable_textarea" id='memo'></p> 
<p class="editable_textarea" id='telephone'></p> 
<p class="editable_textarea" id='email'></p> 
</div>


<div id="accordion">
	<h3><a href="#">Список користувачів</a></h3>
	<div>
 
      <ul id="usertree">
<? 
 include("../../../cgi-bin/db_functions.php");
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db(database, $con);
 
 $query1 = " SELECT * FROM usergroups ORDER BY usergrp";
 
 $result1 = ExecuteQuery($query1);
 while($line1=mysql_fetch_array($result1, MYSQL_ASSOC))
 { echo "<li><a href='#'>".$line1['title']."</a>";
   $query2 = " SELECT * FROM userprofiles WHERE usergrp=".$line1['usergrp']." ORDER BY userprf"; 
   $result2 = ExecuteQuery($query2);
   if( mysql_num_rows($result2)>0)
   { echo "<ul>";
     while($line2=mysql_fetch_array($result2, MYSQL_ASSOC))
     { echo "<li><a href='#'>".$line2['title']."</a>";		 
       $query3 = " SELECT * FROM users WHERE userprf=".$line2['userprf']."  ORDER BY ID"; 
       $result3 = ExecuteQuery($query3);
       if( mysql_num_rows($result3)>0)
       { echo "<ul>";
         while($line3=mysql_fetch_array($result3, MYSQL_ASSOC))
         { 
		 /* <li><a onClick=" "><? echo $line3['username']; ?></a></li>	
		 */
		 ?>
             
             <li><a onClick="currentUser=<? echo $line3['ID'];?>; $('#dialog-form').load('modules/core-users-list/show-user.php',{ID: '<? echo $line3['ID'];?>'}); $( '#dialog-form' ).dialog( 'open' );"><? echo $line3['username']; ?></a></li>
           <?
		 }
		 echo "</ul>";
	   }
	   echo "</li>";
       mysql_free_result($result3);		   
     }
	 echo "</ul>";
   }
   echo "</li>";
   mysql_free_result($result2);	 
 }
 mysql_free_result($result1);
 mysql_close($con);
?> 
       </ul> 
    </div>
</div>