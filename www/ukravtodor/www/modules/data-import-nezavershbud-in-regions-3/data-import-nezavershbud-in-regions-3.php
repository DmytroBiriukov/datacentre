<? 
$monthess=array("01" => "січня", "02" => "лютого", "03" => "березня", "04" =>"квітня", "05" =>"травня", "06" =>"червня",
                "07" =>"липня","08" =>"серпня", "09" =>"вересня", "10" =>"жовтня", "11" =>"листопада", "12" =>"грудня");
$monthes=array("01" => "січень", "02" => "лютий", "03" => "березень", "04" =>"квітень", "05" =>"травень", "06" =>"червень",
                "07" =>"липень","08" =>"серпень", "09" =>"вересень", "10" =>"жовтень", "11" =>"листопад", "12" =>"грудень");

           $curDate="20".date('y-m-d');
           $tdate=explode("-", $curDate);
           $cur_year=$tdate[0];
           $intmonth=$tdate[1];
           $month=$monthes[$intmonth] ;
		   
 
?>
  <script language="javascript">
  function set_parameters(id, title, k)
  {	document.getElementById('regTitle').innerHTML = title;
	document.forms['importModule'].regID.value=id;	
  };
  function checkBeforeSubmit()
  { var flag=1;
    if(document.forms['importModule'].regID.value <= 0 && document.forms['importModule'].select_month.value < document.forms['importModule'].start_month.value) flag = -3;  
    if(document.forms['importModule'].regID.value <= 0 ) flag = -1;
	if(document.forms['importModule'].select_month.value < document.forms['importModule'].start_month.value) flag = -2;
	
	if(flag>0) document.forms['importModule'].submit();	
	else if(flag==-3) alert('Обов\язково виберіть регіон - натисніть курсором на карті та вказуйте правильно період.');
	else if(flag==-1) alert('Обов\язково виберіть регіон - натисніть курсором на карті.');
       else if(flag==-2) alert('Задано невірно період.');
	          
  };
  </script>
  
 

<img src="modules/data-import-nezaveshbud-in-regions-1/data-import-nezaveshbud-in-regions-1.png"/>
<br><br>
<table>
<tr><td>
<h2>Виберіть регіон</h2>


<p>
<img src="/ukravtodor/images/map_bb.png" width="227" height="148"  border="0" usemap="#Map">
<map name="Map">
  <area shape="poly" coords="29,8,33,4,38,2,43,2,49,3,49,6,47,10,47,15,51,15,53,20,52,25,50,28,45,27,43,30,42,32,40,33,37,32,34,27,31,27,28,23,29,18,26,14,26,8,28,7" href="javascript: set_parameters('3','Волинська обл.', '07');" target="_self" alt="Волинська обл. ">
  <area shape="poly" coords="141,121,135,123,130,128,136,129,138,132,143,131,144,139,141,146,148,145,156,143,158,138,165,139,167,134,169,132,176,133,181,132,182,129,183,126,178,124,170,128,164,125,159,120,155,117,148,115,145,115" href="javascript: set_parameters('1' ,'АР Крим', '01');"  target="_self" alt="АР Крим">
  <area shape="poly" coords="110,4,107,11,107,17,108,23,112,27,117,31,120,29,124,35,131,33,134,27,134,22,133,16,135,10,133,7,136,1,125,1" href="javascript: set_parameters('25', 'Чернігівська обл.',  '74')"  target="_self" alt="Чернігівська обл.">
  <area shape="poly" coords="158,39,161,37,165,34,168,32,172,33,175,34,180,34,182,32,186,30,190,34,194,39,194,45,193,51,190,53,188,57,184,61,181,62,179,65,176,67,171,59,166,59,161,56,165,48" href="javascript: set_parameters('20','Харківська обл.', '63');"   target="_self" alt="Харківська обл. ">
  <area shape="poly" coords="210,76,208,72,204,70,202,66,200,61,198,54,195,51,195,46,196,39,200,37,204,39,210,40,212,41,218,44,219,42,221,49,216,53,221,57,216,60,222,67,220,77" href="javascript: set_parameters('12','Луганська обл.', '44');"  target="_self" alt="Луганська обл. ">
  <area shape="poly" coords="191,96,196,93,201,93,202,90,205,86,202,83,208,79,210,75,204,71,198,58,194,54,191,55,188,58,185,62,182,64,185,75,182,77,181,79,183,83,188,85,187,90,185,91,189,95" href="javascript: set_parameters('5','Донецька обл.', '14');"  target="_self" alt="Донецька обл. ">



  <area shape="poly" coords="163,33,155,38,151,36,148,34,147,30,144,32,140,31,136,32,134,30,135,25,134,19,133,15,135,10,134,5,136,0,143,0,148,6,145,10,147,14,146,17,148,17,152,18,156,17,159,21,162,25" href="javascript: set_parameters('18','Сумська обл.', '59');"  target="_self" alt="Сумська обл.">
  <area shape="poly" coords="39,34,33,29,29,27,27,31,23,33,18,38,10,46,11,52,14,55,13,57,18,60,24,55,31,54,31,49,35,49,40,44,44,41" href="javascript: set_parameters('13','Львівська обл.', '46' );"  target="_self" alt="Львівська обл. ">
  <area shape="poly" coords="30,75,28,69,24,66,19,61,16,58,13,57,11,53,8,54,5,60,1,64,4,67,6,70,10,74,14,73,23,75,27,78" href="javascript: set_parameters('7','Закарпатська обл.', '21');"  target="_self" alt="Закарпатська обл. ">
  <area shape="poly" coords="43,33,43,37,47,37,52,35,54,37,60,32,66,29,67,22,69,18,71,14,70,10,64,7,60,6,56,5,52,3,50,6,48,10,49,14,52,14,54,20,53,26,51,29,46,28,44,30" href="javascript: set_parameters('17','Рівненська обл.', '56');"  target="_self" alt="Рівненська обл. ">
  <area shape="poly" coords="73,13,70,20,68,28,68,32,69,35,72,39,70,43,72,46,79,45,84,45,87,44,87,48,91,48,93,43,94,39,93,35,91,32,93,28,93,22,90,18,92,15,89,11,87,16,83,12,78,12" href="javascript: set_parameters('6','Житомирська обл.', '18');"  target="_self" alt="Житомирська обл. ">
  <area shape="poly" coords="54,68,48,64,43,62,39,57,37,52,38,49,40,47,43,45,45,42,44,38,48,37,52,37,54,36,53,42,53,48,53,57" href="javascript: set_parameters('19','Тернопільська обл.', '61');"  target="_self" alt="Тернопільська обл. ">
  <area shape="poly" coords="31,74,29,68,24,66,20,61,25,56,29,55,32,54,31,50,36,50,37,57,41,61,44,65,45,66,44,69,38,73,35,78,35,82,33,78" href="javascript: set_parameters('9','Івано-Франківська обл.', '26');"  target="_self" alt="Івано-Франківська обл. ">
  <area shape="poly" coords="37,82,36,78,40,74,43,71,46,66,50,67,53,69,56,70,60,68,65,69,65,71,63,72,58,73,56,74,52,75,51,79,44,79,40,79" href="javascript: set_parameters('24','Чернівецька обл.', '73');"  target="_self" alt="Чернівецька обл. ">
  <area shape="poly" coords="67,68,63,67,58,68,56,68,54,56,54,44,57,36,63,32,65,31,68,35,70,38,69,43,70,46,72,49,72,52,73,58" href="javascript: set_parameters('22','Хмельницька обл.', '68');"  target="_self" alt="Хмельницька обл.">
  <area shape="poly" coords="68,69,74,57,74,48,83,45,87,47,89,49,93,50,94,54,96,58,95,63,98,66,98,71,96,76,91,77,87,74,85,77,81,76,80,78" href="javascript: set_parameters('2','Вінницька обл.', '05');"  target="_self" alt="Вінницька обл. ">
  <area shape="poly" coords="93,127,94,132,90,128,84,130,80,131,77,130,76,128,78,125,81,123,82,120,84,119,85,117,86,113,85,109,87,107,91,109,94,109,97,111,100,110,100,107,99,102,96,98,94,95,92,92,91,89,89,86,89,81,85,78,89,77,92,78,96,78,98,76,102,81,103,85,102,90,104,90,108,91,111,96,113,98,111,105,107,111,104,117,98,122,95,122" href="javascript: set_parameters('15','Одеська обл.', '51');"  target="_self" alt="Одеська обл. ">
  <area shape="rect" coords="4,115,60,135" href="javascript: set_parameters('27','м. Севастопіль', '85');"  target="_self" alt="м. Севастопіль">
  <area shape="poly" coords="124,36,129,35,132,34,135,32,139,33,143,33,147,33,150,36,154,39,159,42,164,49,162,53,159,55,152,57,150,62,147,63,142,58,139,61,136,56,132,51,131,48,127,45,124,39" href="javascript: set_parameters('16','Полтавська обл.', '53');"  target="_self" alt="Полтавська обл. ">
  <area shape="poly" coords="93,16,92,20,93,28,92,32,95,38,93,45,93,49,96,56,101,55,105,57,107,53,110,55,112,49,113,43,114,39,118,43,122,39,122,35,120,31,115,32,112,29,108,25,106,20,104,16,101,14,96,15" href="javascript: set_parameters('10','Київська обл.', '32');"  target="_self" alt="Київська обл. ">
  <area shape="poly" coords="115,43,113,52,112,57,108,55,107,58,100,57,96,62,99,67,100,70,103,69,106,66,113,64,116,63,120,62,124,61,128,58,132,60,132,56,131,51,130,48,126,44,123,41,121,44" href="javascript: set_parameters('23','Черкаська обл.', '71');"  target="_self" alt="Черкаська обл. ">
  <area shape="poly" coords="104,77,99,76,99,73,102,71,104,70,108,68,113,66,119,63,124,62,128,59,133,60,135,58,139,62,142,60,145,63,141,66,143,68,140,74,137,78,133,79,128,82,122,83,119,79,113,77,106,77" href="javascript: set_parameters('11','Кіровоградська обл.', '35');"  target="_self" alt="Кіровоградська обл. ">
  <area shape="poly" coords="136,86,136,82,136,79,139,77,142,73,145,69,144,66,147,64,151,62,153,59,157,57,162,57,165,60,169,60,172,62,176,68,181,65,182,70,182,76,179,80,173,79,167,76,163,74,157,78,158,82,159,86,154,87,148,89,142,87,139,87" href="javascript: set_parameters('4','Дніпропетровська обл.', '12');"  target="_self" alt="Дніпропетровська обл. ">
  <area shape="poly" coords="113,104,113,99,111,94,107,90,102,89,102,82,101,79,106,78,112,78,116,80,119,82,121,85,128,84,133,80,134,86,135,95,133,101,119,104" href="javascript: set_parameters('14','Миколаївська обл.', '48');"  target="_self" alt="Миколаївська обл. ">
  <area shape="poly" coords="164,108,159,103,158,98,154,94,151,91,155,88,159,88,162,86,160,84,159,80,162,76,170,78,179,81,185,85,187,89,183,92,188,96,184,100,178,101,177,104,172,102" href="javascript: set_parameters('8','Запорізька обл.', '23');"  target="_self" alt="Запорізька обл. ">
  <area shape="poly" coords="119,106,127,104,134,101,137,96,137,89,141,89,147,89,150,90,152,95,157,99,157,104,160,107,162,110,160,113,155,115,148,115,142,114,140,116,133,114,133,117,128,116,121,112" href="javascript: set_parameters('21','Херсонська обл.', '21');"  target="_self" alt="Херсонська обл. ">
</map>
</p>
<p>Вибраний регіон:&nbsp; <div id="regTitle"><em>ще не вибраний</em></div></p>
</td><td>
      <h2>Виберіть файл з даними</h2>  
<? 
$POST_MAX_SIZE = ini_get('post_max_size');
$mul = substr($POST_MAX_SIZE, -1);
$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
$POST_MAX_SIZE=$mul*(int)$POST_MAX_SIZE;
?>
<!---->
    <form name="importModule"  action="modules/data-import-nezaveshbud-in-regions-1/data-import-nezaveshbud-in-regions-1-import.php"   enctype="multipart/form-data" method="POST" target="_blank">
    <input type="hidden" value="<? echo $POST_MAX_SIZE; ?>" name="MAX_FILE_SIZE" />    
    <input type="file" name="module-archive" onChange="document.forms['importModule'].importModule_submit.disabled='';"/>
    <!--<input type="button" name="importModule_submit" onclick="javascript: $('#result').load('modules/data-import-nezaveshbud-in-regions-1/data-import-nezaveshbud-in-regions-1-import.php');" id="importModule_submit" value="Імпортувати дані" disabled="disabled"  /> -->

    <input type="hidden" name="regID" value="0">

    
    <br />
             <h2>Вкажіть період</h2>
     <select name="start_month" id="start_month">
      <?php
        foreach($monthes as $m => $mn)
        {
          if($m==$intmonth)
          echo "<option value=$m selected >$mn</option>";
          else echo "<option value=$m>$mn</option>";
        }

      ?>
</select> - <select name="select_month" id="select_month">
      <?php
        foreach($monthes as $m => $mn)
        {
          if($m==$intmonth)
          echo "<option value=$m selected >$mn</option>";
          else echo "<option value=$m>$mn</option>";
        }

      ?>
    </select> місяць
    <select name="select_year" id="select_year">

      <?php
        for($years=2011; $years<= $cur_year; $years++)
        {
          if($cur_year==$years)
          echo "<option value=$cur_year selected >$cur_year</option>";
          else echo "<option value=$years>$years</option>";
        }

      ?>
    </select> року.
    
        <p>
      <label>
        <input type="radio" name="mode" value="test" id="RadioGroup1_0" checked>
        режим перевірки</label>
      <br>
      <label>
        <input type="radio" name="mode" value="import" id="RadioGroup1_1">
        режим імпортування</label>
      <br>
    </p>     <br />    <br />    <br />
        <input type="button" name="importModule_submit" id="importModule_submit" value="Імпортувати дані" disabled="disabled" onClick="checkBeforeSubmit();" /> 
</form>
</td></tr></table>    

<?
?>


