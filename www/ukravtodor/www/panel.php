<?php
session_start();
include("../cgi-bin/db_functions.php");
$is_passed=false;
$cur_year=date("Y");   
$expire=time()+60*60*24*30;
$username='';
$usergroupname='';
$userprf=0;
if(isset($_SESSION['aID']))
{ $is_passed=checkUserPass($_SESSION["aUser"],$_SESSION["aPassword"], $username, $usergroupname, $userprf);
}else
{// logined first time
  $localtime = localtime();
  $is_passed=checkUserPass($_POST["ulgn"],md5($_POST['upwd']), $username, $usergroupname, $userprf);
//  if($is_passed) session_register("aID","aUser","aPassword","aUserProfile","aTime","aIP","aRegID","registered");
  $aID=$is_passed;
  $aTime=$localtime[2].":".$localtime[1];  
  $aUser=$_POST["ulgn"];
  $aPassword=md5($_POST['upwd']);
  $_SESSION['aID']=$is_passed;
  $_SESSION['aUser']=$_POST["ulgn"];
  $_SESSION['aPassword']=md5($_POST['upwd']);
  
}
if($is_passed > 0)
{ //AddFileContent(projecttmppath.'/profiles/sessions.log', '<login><userprf>'.$userprf.'</userprf><time>'.$_SESSION['aTime'].'</time></login>');
  $aID=$_SESSION['aID'];
  $R=getenv("REMOTE_ADDR");
  $userIP=explode(".", $R);
  if(($userIP[0]=="10" && $userIP[1]=="10") || ($userIP[0]=="192" && $userIP[1]=="168" && $userIP[2]=="1") || ($userIP[0]=="10" && $userIP[1]=="39") 
	    || ($userIP[0]=="10" && $userIP[1]=="0")) $ip_server=ip_server_local; else $ip_server=ip_server_remote; 
?>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"><title>Інформаційно-аналітична система :: моніторинг стану автомобільних доріг України</title><link rel="shortcut icon" href="images/favicon.ico">
<link rel="stylesheet" href="css/panel/style.css" type="text/css" /><link rel="stylesheet" href="css/humanity/jquery-ui-1.9.0.custom.min.css" />
<script src="js/jquery-1.8.2.js"></script><script src="js/jquery-ui-1.9.0.custom.min.js"></script><script language="javascript">
var ip_server='<? echo $ip_server; ?>';
function isBlank(str) { return (!str || /^\s*$/.test(str));}
function isEmpty(str) { return (!str || 0 === str.length);}
function currentHTML(){ alert(document.getElementsByTagName('html')[0].innerHTML);}
</script>
</head>
<body><!-- Header --><header class="header_bg clearfix"><div class="container clearfix"><!-- Logo --><div class="logo"><img src="images/logo.png" alt="" /></div>	<!-- Master Nav --><nav class="main-menu"><ul><li><a href="panel.php"><img src="images/icon_menu_start.png" alt="Стартова сторінка" title="Стартова сторінка"/>Стартова сторінка</a></li><li><a> <img src="images/icon_menu_modules.png" alt="Програмні модулі" title="Програмні модулі"/> Програмні модулі</a><ul>
<?  
$query1="SELECT m.path, m.type, m.ID, m.title, m2u.ID as ID_share, m2u.title as t_share FROM modules m, module2user m2u WHERE m2u.userprf=".$userprf." AND m.ID=m2u.module ORDER BY m.type, m.ID";
$moduleType="";
$result1= ExecuteQuery($query1);
$i=0;
while($line1=mysql_fetch_array($result1, MYSQL_ASSOC))
{  
   if($moduleType != $line1['type'])
   { $moduleType = $line1['type'];
     if($i>0) echo "</ul></li><li><a href='javascript:'>"; else { $i=1; echo "<li><a href='javascript:'>";}
     switch($line1['type'])
     { case "адміністрування": echo "Адміністрування"; break;
       case "імпорт даних": echo "Імпортування даних"; break;
       case "звіти": echo "Форми звітності"; break;	 
       case "електронні карти": echo "Електронні карти"; break;
       default: echo "Інше"; break;
     }    	
	 echo "</a><ul>"; 
   }      
   $module_path="modules/".$line1['path']."/".$line1['path'].".php";
   $query2 = " SELECT m.param, m2p.value FROM module2user2param m2p, module2param m WHERE m.ID=m2p.param AND m2p.ID_share=".$line1['ID_share']." ";
   $result2 = ExecuteQuery($query2);
   $string="";
   if( mysql_num_rows($result2)>0)
   { $string="";
     while($line2=mysql_fetch_array($result2, MYSQL_ASSOC))
     { $string.=$line2['param'].":'".$line2['value']."', ";		   
	 }
	 $string=substr($string, 0, -2); 
   }
   
   mysql_free_result($result2); 	
    
   echo "<li><a onClick=\"javascript: $('#moduleContent').load('".$module_path."',{".$string."});\" >";
   if ($line1['t_share']=="") echo $line1['title']; else echo $line1['t_share']; 
   echo "</a></li>";  	 
}
mysql_free_result($result1);   
echo "</ul></li>";
?>  					</ul>     </li><li><a><img src="images/icon_menu_users.png"/>Користувач</a><ul><li><a><? echo $username;?></a></li><li><a>Група: <? echo $usergroupname;?></a></li></ul></li><li><img src="images/icon_menu_time.png" alt="Час входу в систему" title="Час входу в систему"/><? if($_SESSION['aTime']!="") echo $_SESSION['aTime']; ?></li><li><a href="index.php"><img src="images/icon_menu_exit.png" alt="Вийти з системи" title="Вийти з системи"/>Вийти з системи</a></li></ul></nav><!-- /Master Nav --></div></header><!-- /Header --><div class="clear"></div><div class="clear padding40"></div>
	<!-- Content -->
   	<section class="container clearfix">
    <div id="moduleInfo" name="moduleInfo"></div>            
	<div id="moduleContent" name="moduleContent">  
<?  
$query1="SELECT m.path, m.type, m.ID, m.title, m2u.ID as ID_share, m2u.title as t_share FROM modules m, module2user m2u WHERE m2u.userprf=".$userprf." AND m.ID=m2u.module ORDER BY m.type, m.ID";
$moduleType="";
$result1= ExecuteQuery($query1);
$i=0;
while($line1=mysql_fetch_array($result1, MYSQL_ASSOC))
{  
   if($moduleType != $line1['type'])
   { $moduleType = $line1['type'];
     $i=0;
?>     	<div class="clear padding10"></div>
		<div class="recent_works_left">
			<h2 class="red">
<?   switch($line1['type'])
     { case "адміністрування": echo "Адміністрування"; break;
       case "імпорт даних": echo "Імпортування даних"; break;
       case "звіти": echo "Форми звітності"; break;	 
       case "електронні карти": echo "Електронні карти"; break;
       default: echo "Інше"; break;
     }
?>
            </h2>
		</div><div class="clear"></div><div class="line"></div>
<? }      
   $module_path="modules/".$line1['path']."/".$line1['path'].".php";
//   $query2 = " SELECT m2p.param, m2u2p.value FROM module2param m2p, module2user2param m2u2p WHERE m2p.module=".$line1['ID']." AND m2u2p.userprf=".$userprf." AND m2u2p.param=m2p.ID AND m2p.module=m2u2p.module ORDER BY m2p.module"; 
$query2 = " SELECT m.param, m2p.value FROM module2user2param m2p, module2param m WHERE m.ID=m2p.param AND m2p.ID_share=".$line1['ID_share']." ";
   $result2 = ExecuteQuery($query2);
   $string="";
   if( mysql_num_rows($result2)>0)
   { $string="";
     while($line2=mysql_fetch_array($result2, MYSQL_ASSOC))
     { $string.=$line2['param'].":'".$line2['value']."', ";		   
	 }
	 $string=substr($string, 0, -2); 
   }
   $i++;
   mysql_free_result($result2); 
   if( ($i%3) > 0) echo "<div class=\"col_1_3\">"; else echo "<div class=\"col_1_3 last\">";
?>
			<div class="features">
				<div class="title clearfix">
					<img src="<? echo "modules/".$line1['path']."/".$line1['path'].".png"; ?>" alt="" class="alignleft" />
					<!--<h3>  </h3>-->
				</div>
				<p><? if ($line1['t_share']=="") echo $line1['title']; else echo $line1['t_share']; ?> 
                <br /> <a onClick="javascript: $('#moduleContent').load('<? echo $module_path; ?>',{<? echo $string; ?>});" >Запустити модуль</a></p> 
			</div>
		</div>
<?	 
   	 
}
mysql_free_result($result1);
?> 
    		</div> <!-- /module content -->
    	</section>
	<!-- /Content -->
	<div class="clear"></div>
	<div class="clear padding40"></div>	    		
	<!-- footer -->
	<footer id="page_bottom">
		<ul>
			<li class="colHeader">&copy; 2011 - <script language=JavaScript type=text/javascript>document.write((new Date()).getFullYear());</script>&nbsp; Всі права застережені</li>
			<li><a href="#">Державне агентство автомобільних доріг України</a></li>
			<li>IP-aдреса користувача: <? echo $R; ?></li>
            <li><a onClick="javascript: currentHTML();">Поточний код сторінки </a>	</li>
		</ul>
		<ul>
			<li class="colHeader">Розробник:</li>
			<li><a href="http://unicyb.kiev.ua"  target="_blank">факультет кібернетики,</a></li>
			<li><a href="http://univ.kiev.ua" target="_blank">Київський національний університет імені Тараса Шевченка</a></li>
		</ul>
	</footer><!-- /footer -->
        </div>
    <!--wrapper end-->
</body>
</html>
<?
//  }  // profile file exists [end]
}else
{ ?>
<html>
<link href="css/panel/style.css" rel="stylesheet" type="text/css" />
<body>
<div id='alert' align="center"><img src="images/alert.png"/><p>Порушення прав доступу!</p>
<a href="/">Повернутися на головну сторінку</a></div>
</body>
</html>
<?
}
?>