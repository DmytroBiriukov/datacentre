<? 
 include("../../../cgi-bin/db_functions.php");
 $con = mysql_connect(host,user,pwd);
 if(preg_match('/^5\./',mysql_get_server_info($con)))
 mysql_query('SET SESSION sql_mode=0');
 mysql_query("SET NAMES utf8") or die("Invalid query: ".mysql_error()); 
 if (!$con) {  die('Could not connect: ' . mysql_error()); }
 mysql_select_db(database, $con);
 $query3 = " SELECT * FROM users WHERE ID=".$_POST['ID']." "; 
 $result3 = ExecuteQuery($query3);
 if( mysql_num_rows($result3)>0)
 { if($line3=mysql_fetch_array($result3, MYSQL_ASSOC))
   { 
?>
<p><em> Ім'я: &nbsp;&nbsp;</em></p>
<p class="editable_textarea" id='username'><? echo $line3['username'];?></p>
<p><em>Логін: &nbsp;</em></p>
<p class="editable_textarea" id='userlgn'><? echo $line3['userlgn'];?></p>
<p><em>Опис: &nbsp;</em></p>
<p class="editable_textarea" id='umemo'><? echo $line3['memo'];?></p> 
<p><em>Телефон: &nbsp;</em></p>
<p class="editable_textarea" id='telephone'><? echo $line3['telephone'];?></p> 
<p><em>Е-пошта: &nbsp;&nbsp;</em></p>
<p class="editable_textarea" id='email'><? echo $line3['email'];?></p> 
<script type="text/javascript">
key_value=<? echo $_POST['ID'];?>;

  	$('#username').editInPlace({
		postclose: function() { },
        url: "http://"+ip_server+"/src/inDBPlaceEdit.php",
        params: "tab=users&field=username&keyvalue="+key_value+"&keyfield=ID&fieldtype=input&datatype=char",
		show_buttons: true
	});
  	$('#userlgn').editInPlace({
		postclose: function() { },
        url: "http://"+ip_server+"/src/inDBPlaceEdit.php",
        params: "tab=users&field=userlgn&keyvalue="+key_value+"&keyfield=ID&fieldtype=input&datatype=char",
		show_buttons: true
	});
  	$('#umemo').editInPlace({
		postclose: function() { },
        url: "http://"+ip_server+"/src/inDBPlaceEdit.php",
        params: "tab=users&field=memo&keyvalue="+key_value+"&keyfield=ID&fieldtype=input&datatype=char",
		show_buttons: true
	});
  	$('#telephone').editInPlace({
		postclose: function() { },
        url: "http://"+ip_server+"/src/inDBPlaceEdit.php",
        params: "tab=users&field=telephone&keyvalue="+key_value+"&keyfield=ID&fieldtype=input&datatype=char",
		show_buttons: true
	});
	
  	$('#email').editInPlace({
		postclose: function() { },
        url: "http://"+ip_server+"/src/inDBPlaceEdit.php",
        params: "tab=users&field=email&keyvalue="+key_value+"&keyfield=ID&fieldtype=input&datatype=char",
		show_buttons: true
	});	

</script>
<?
   }		 
 }
 mysql_free_result($result3);		   
 mysql_close($con);
?>