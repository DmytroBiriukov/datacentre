<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) 
{  setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();
?>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title>Інформаційно-аналітична система :: моніторинг стану автомобільних доріг України</title>
<link rel="shortcut icon" href="images/favicon.ico">
<meta name="keywords" content="ІАС, автошляхи, автомобільні дороги, Укравтодор, ремонт, ДТП" />
<meta name="description" content="ІАС накопичення, обробки, аналізу та обміну даними щодо стану об'єктів (доріг різного підпорядкування та типу, капітальних споруд на них) їх будівництва, реконструкції, капітальних та поточних ремонтів по регіонах, планування та технічного обліку ремонтів автодоріг" />
<!--<meta name="robots" content="index,follow" />-->
<link rel="shortcut icon" href="img/favicon.ico" /> 
<link rel="stylesheet" href="css/panel/indexstyle.css" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<!-- Header -->
	<header class="header_bg clearfix">
		<div class="container clearfix">
			 <!-- Logo -->
			<div class="logo">
				<img src="images/logo.png" alt="" />
			</div>
			 <!-- /Logo -->
		</div>
	</header>
	<!-- /Header -->
    <div id="loginwrap"></div>            
	<div class="clear"></div>	
	<div class="clear padding40"></div>
	<section class="homepage_widgets_bg clearfix">
		<div class="container clearfix">
			<div class="padding20"></div>
            <!-- START COL 1/2 -->
			<div class="col_1_2 ">
				<h1 class="regular white">Ласкаво просимо на сторінку Інформаційно-аналітичної системи</h1>
<form name=login id='login' action='panel.php' method=post>користувач:&nbsp;<input style='WIDTH: 120px' maxlength=50 size=8 name='ulgn'><br>пароль:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style='WIDTH: 120px' type='password' maxlength=50 size=8 name='upwd'><br><input type='submit' class='green-button' style='display:inline;' value='Увійти' ></form>
			</div>
			<!-- END COL 1/2 -->
		</div>
		<!-- END COL 2/3 LAST -->	
		<div class="clear padding20"></div>
		</div>        
	</section>
	<!-- footer -->
	<footer class="footer_bg_bottom clearfix">
		<div class="footer_bottom container">
			<div class="clear padding20"></div>
				<p>&copy; 2011 - <script language=JavaScript type=text/javascript>document.write((new Date()).getFullYear());</script><a href="#"> &nbsp;Державне агентство автомобільних доріг України</a> | Розробник: <a href="http://unicyb.kiev.ua" target="_blank">факультет кібернетики</a>, <a href="http://univ.kiev.ua" target="_blank">Київський національний університет імені Тараса Шевченка</a> </p>										
			<div class="clear padding20"></div>
		</div>
	</footer>
	<!-- /footer -->
    </div>
    <!--wrapper end-->
</body>
</html>