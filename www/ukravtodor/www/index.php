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
<script src="js/slides.min.jquery.js"></script>
<script type="text/javascript">
function hideLogin()
{ document.getElementById('loginwrap').style.display="none";
  document.getElementById('loginwrap').innerHTML="";
}
function loginForm(e)
{  document.getElementById(e).innerHTML="<form name=login id='login' action='panel.php' method=post>користувач:&nbsp;<input style='WIDTH: 120px' maxlength=50 size=8 name='ulgn'><br>пароль:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input style='WIDTH: 120px' type='password' maxlength=50 size=8 name='upwd'><br><input type='submit' class='green-button' style='display:inline;' value='Увійти' ><input type='button' class='red-button' style='display:inline;' onClick='hideLogin();' value='Відмінити' ></form>";
  /*document.getElementById(e).innerHTML="<div class='alert'><img src='images/alert.png'/>Тимчасово призупинено вхід в систему. </br>Програмне забезпечення оновлюється. </div>";
*/
  document.getElementById(e).style.display="block";

}

$(function()
{ var startSlide = 1;
  if (window.location.hash) 
  {	startSlide = window.location.hash.replace('#','');
  }
  $('#slides').slides(
  {				preload: true,
				preloadImage: 'img/loading.gif',
				generatePagination: true,
				play: 5000,
				pause: 2500,
				hoverPause: true,
				// Get the starting slide
				start: startSlide,
				animationComplete: function(current){
					// Set the slide number as a hash
					window.location.hash = '#' + current;
  }
});
			
/*  Contact form  */			
			
$('#name').focus(function () 
{ $(this).removeClass('error_class');
});
$('#email').focus(function () 
{ $(this).removeClass('error_class');
});
$('#message').focus(function () 
{ $(this).removeClass('error_class');
});
$('.contact_form').submit(function () 
{       hasError = false;
        if ($('#name').val() == '') 
		{   $('#name').addClass('error_class');
            hasError = true;
		}
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var emailaddressVal = $('#email').val();
        if (emailaddressVal == '') {
            $('#email').addClass('error_class');
            hasError = true;
        }
        else if (!emailReg.test(emailaddressVal)) {
            $('#email').addClass('error_class');
            hasError = true;
        }

        if ($('#email').val() == '') {
            $('#email').addClass('error_class');
            hasError = true;
        }

        if ($('#message').val() == '') {
            $('#message').addClass('error_class');
            hasError = true;
        }

        if (hasError == true) {
            $('.info_box').hide();
            $('.error_box').show();
        }
        else {
            $.ajax({
                type: 'POST',
                url: 'contact.php',
                cache: false,
                data: $(".contact_form").serialize(),
                success: function (data) {
                    if (data == "error") {
                        $('.success_box').hide();
                        $('.error_box').show();
                    }
                    else {
                        $('#name').val('');
                        $('#email').val('');
                        $('#message').val('');
                        $('#website').val('');
                        $('.error_box').hide();
                        $('.success_box').show();
                    }
                }
            });
        }

        return false;
    });
			
});
</script>
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
			
			<!-- Master Nav -->
			<nav class="main-menu">
				<ul>
					<li><a href="index.htm">Головна</a></li>
					<li>
						<a>Розділи</a>
						<ul>
							<li><a href="#main_characteristics">Характеристики ІАС</a></li>
							<li><a href="#main_reports">Звіти, діаграми та графіки</a></li>
							<li><a href="#main_reports">Електронні карти</a></li>
						</ul>
					</li>
					<li><a href="#main_contacts">Контакт</a></li>
					<li><a href="#" onClick="loginForm('loginwrap');">Вхід в систему</a></li>                    
				</ul>
			</nav>
			<!-- /Master Nav -->
		</div>
	</header>
	<!-- /Header -->
    <div id="loginwrap"></div>            
	<div class="clear"></div>
	
	<div class="clear padding40"></div>

	
	<!-- Content -->
	<section class="container clearfix">
	
<!--		<div class="clear padding30"></div>-->

<!---->	<div id="container_slider">
		<div id="example">
			<div id="slides">
				<div class="slides_container">
					<div class="slide">
						<h1>Ласкаво просимо на сторінку Інформаційно-аналітичної системи</h1>
						<p>Інформаційно-аналітична система розробляється для підтримки прийняття управлінських рішень щодо розробки виробничих планів з будівництва та реконструкції, ремонту та поточного утримання автомобільних доріг загального користування, розвитку виробничих потужностей і об`єктів виробничого призначення, що мають загальногалузеве значення відповідно до стратегії розвитку і удосконалення мережі автомобільних доріг загального користування, державних, цільових комплексних і соціальних програм розвитку дорожнього господарства, забезпечення отримання детальної оцінки стану об'єктів будівництва, реконструкції, ремонту та поточного утримання автомобільних доріг.</p>
					</div>                
					<div class="slide">
						<h1>Формування звітів, діаграм, графіків та електронних карт</h1>
						<p>ІАС є інтрументарієм накопичення, обробки, аналізу та обміну даними щодо стану доріг, їх будівництва, реконструкції, капітальних та поточних ремонтів по регіонах, планування та технічного обліку ремонтів автодоріг. <br /> ІАС дозволяє використовувати зручне представлення гео-просторової інформації, проводити візуалізації автодоріг на елекронних катрах, формувати діаграми, робити категоризацію та кластеризацію територій за показниками стану автодорожнього господарства.</p>
                        <div class="clearfix">
							<a href="#main_reports" class="green-button">Детальніше</a>
						</div>                        
					</div>
					<div class="slide">
						<h1>Розподілена архітектура та єдине сховище даних</h1>
						<p>Розподілена архітектура дозволяє користувачам системи з регіональних Служб автомобільних доріг вносити дані в єдину базу даних.<br /> Система використовує сучасні інформаційні технології, реалізована на основі архітектури клієнт-сервер.<br /> Доступ до функціональних можливостей ІАС мають зареєстровані користувачі, які повинні авторизуватися на даній веб-сторінці.</p>
                        <div class="clearfix">
							<a href="#main_characteristics" class="green-button">Детальніше</a>
						</div> 
					</div>
					<div class="slide">
						<h1>Управління правами доступу користувачів до ресурсів</h1>
						<p>В ІАС реалізована підсистема управліненя користувачами.<br /> Це надає можливість створювати групи, профілі та облікові записи користувачів, згідно з якими користувачім надаються відповідні до їх функціональних обов'язків права доступу до модулів ІАС.</p> 
					</div>
					<div class="slide">
						<h1>Підвищена надійність апаратної платформи</h1>
						<p>ІАС є інтрументарієм накопичення, обробки, аналізу та обміну даними щодо стану доріг, їх будівництва, реконструкції, капітальних та поточних ремонтів по регіонах, планування та технічного обліку ремонтів автодоріг. <br /> Система розгорнута на серверному апаратному забезпеченні з підвищеною відмовостійкістю.<br /> Використовується дублювання файлової системи та блоків живлення. </p>
					</div>
				</div>
				<a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
			</div>
			
		</div>


	</div><!---->          




<!--
recent works
-->		
	</section>
	<!-- /Content -->
		
	
	
	<section class="homepage_widgets_bg clearfix">
		<div class="container clearfix">
		
			<div class="padding20"></div>
			
            
            <!-- START COL 1/2 -->
			<div class="col_1_2 ">
				<h1 class="regular white">Ласкаво просимо на сторінку Інформаційно-аналітичної системи</h1>
				<p>Інформаційно-аналітична система розробляється для підтримки прийняття управлінських рішень щодо розробки виробничих планів з будівництва та реконструкції, ремонту та поточного утримання автомобільних доріг загального користування, розвитку виробничих потужностей і об`єктів виробничого призначення, що мають загальногалузеве значення відповідно до стратегії розвитку і удосконалення мережі автомобільних доріг загального користування, державних, цільових комплексних і соціальних програм розвитку дорожнього господарства, забезпечення отримання детальної оцінки стану об'єктів будівництва, реконструкції, ремонту та поточного утримання автомобільних доріг.</p> 
				<div class="clearfix">
					<a onClick="loginForm('loginwrap'); window.scrollBy(0,-1250);" class="green-button" alt="Для авторизованих користувачів">Вхід в систему</a>
				</div> 
                <div class="padding20"></div>                    
                
                <h1 class="regular white bottom_line">Посилання на даний ресурс</h1>
				<p><img class="alignleft MT0" id="why1" src="img/item-p.png" alt="img" >При використанні інформації з даного ресурсу оформлюйте посилання наступним чином: </br>ІАС накопичення, обробки, аналізу та обміну даними щодо стану об'єктів доріг (різного підпорядкування та типу, капітальних споруд на них), їх будівництва, реконструкції, капітальних та поточних ремонтів по регіонах, планування та технічного обліку ремонтів автодоріг [Назва з екрану]. - [Електронний ресурс]. - Режим доступу: <a href="http://ukravtodor.gov.ua/IAS">http://ukravtodor.gov.ua/IAS</a> </p>
			</div>
			<!-- END COL 1/2 -->
			<!-- START COL 1/2 -->        
           <div class="col_1_2 last">
				<h1 id="main_characteristics" class="regular white bottom_line">Основні характеристики та функції</h1>
                <p >ІАС розробляється як розподілена на основі технологій клієнт-сервер програмна система з підтримкою багатьох користувачів з неоднорідним набором функцій та прав роботи з даними. ІАС має модульну структуру, в склад якої входять підсистеми управління користувачами, управління модулями (програмними компонентами), управління параметрами (показниками) та сховищем даних. </p>
				<div><a href="#"><img class="alignleft MT0" id="why1" src="img/item-tools.png" alt="img" ></a></div>
				<p>
					реалізована як централізована система з віддаленим "тонким" клієнтом на базі Веб-браузера;
				</p>
                
                <div class="clear padding10"></div>
                
                <div><a href="#"><img class="alignleft MT0" id="why2" src="img/item-tools.png" alt="img" ></a></div>
				<p>
					характеризується відкритістю, модульністю побудови, інтегрованістю, гнучкістю, надійністю, технологічністю, спадкоємністю та можливістю здійснення ізольованої розробки;
				</p>
                 <div class="clear padding10"></div>
                 
                <div><a href="#"><img class="alignleft MT0" id="why3" src="img/item-tools.png" alt="img" ></a></div>
				<p>
					забезпечує доступ до всіх інформаційних ресурсів Системи з урахуванням встановлених прав доступу за рахунок забезпечення ефективної обробки інформації, що надходить;
				</p>
                
                <div class="clear padding10"></div>
                
                <div><a href="#"><img class="alignleft MT0" id="why2" src="img/item-tools.png" alt="img" ></a></div>
				<p>
					забезпечує оптимальне розподілення обробки даних в обчислювальній мережі для підвищення ефективності її функціонування;
				</p>
                 <div class="clear padding10"></div>
                 
                <div><a href="#"><img class="alignleft MT0" id="why3" src="img/item-tools.png" alt="img" ></a></div>
				<p>
					забезпечує вільне змінювання масштабу та пристосовуватися до зміни кількості користувачів.
				</p>                
                
			</div>
  				<div class="clear"></div>
        		<div class="padding15"></div>				
				<h1 id="main_reports" class="regular white bottom_line">Звіти, діаграми, графіки та електронні карти</h1>			
				<div class="clear"></div>	
	  <!-- START COL 1/3 -->	
		<div class="col_1_3">	        
			<div class="clear"></div>
		</div>
		<!-- END COL 1/3 -->                
		<!-- START COL 2/3 LAST -->	
		<div class="col_2_3 last">		
			<p>ІАС є інтрументарієм накопичення, обробки, аналізу та обміну даними щодо стану доріг, їх будівництва, реконструкції, капітальних та поточних ремонтів по регіонах, планування та технічного обліку ремонтів автодоріг.</p>
			<p>ІАС дозволяє використовувати зручне представлення гео-просторової інформації, проводити візуалізації автодоріг на елекронних катрах, формувати діаграми, робити категоризацію та кластеризацію територій за показниками стану автодорожнього господарства.</p>			
			<div class="padding20"></div>
        </div>   

				<div class="clear"></div>
        		<div class="padding15"></div>				
				<h1 id="main_contacts" class="regular white bottom_line">Зворотній зв'язок</h1>			
				<div class="clear"></div>			        

	  <!-- START COL 1/3 -->	
		<div class="col_1_3">	
			<ul class="contact-address">
            	<li class="address"><span>Наша контактна адреса</span></li>
                <li class="phone"><span>тел./факс 044 </span></li>
                <li class="email"><span><a href="mailto:info@">Е-пошта</a></span></li>
            </ul>
        
			<div class="clear"></div>
		
		</div>
		<!-- END COL 1/3 -->	
		
		<!-- START COL 2/3 LAST -->	
		<div class="col_2_3 last">		
			<p>Якщо у Вас є бажання зв'язатися з адміністратором. Можете написати повідомлення, яке буде надіслано адміністратору.</p>
			
			<div class="padding20"></div>
			
			<p class="required_info"><span>*</span> Обов'язкові для заповнення</p>
			
			
		
			
			<!-- SUCCESS MESSAGE -->
			<div class="success_box none">
				Повідомлення було відправлено адміністратору веб-сторінки, дякуємо за участь в роботі!
			</div>
			<!-- END SUCCESS MESSAGE -->
			
			<!-- ERROR MESSAGE -->
			<div class="error_box none">
				Будь ласка заповність всі поля!
			</div>
			<!-- END ERROR MESSAGE -->
			
			
			
			<!-- START CONTACT FORM -->	
			<form action="#" class="contact_form">
			<p>
				<label for="name">Ім'я <span>*</span></label>
				<input class="inputText" type="text" id="name" name="name" />
			</p>
			<div class="clear"></div>
			<p>
				<label for="email">E-пошта <span>*</span></label>
				<input class="inputText" type="text" id="email" name="email" />
			</p>
			<div class="clear"></div>
			<p>
				<label for="message">Текст повідомлення <span>*</span></label>
				<textarea class="inputTextarea" cols="88" rows="6" id="message" name="message"></textarea>
			</p>
			<div class="clear"></div>
			<p class="submit">
				<a href="javascript:void(0);" class="button white" onClick="$('.contact_form').submit();">Відправити</a>
			</p>
			</form>
			<!-- END CONTACT FORM -->	
			
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