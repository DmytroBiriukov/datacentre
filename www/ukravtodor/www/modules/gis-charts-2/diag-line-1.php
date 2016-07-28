<div id="line-charts">
	  <p>Лінійна діаграма:</p>
      <div id="diag-line-1" style="width:450px;height:240px;"></div>
      <div id="diag-line-choices">Показники:</div>
</div>
<script type="text/javascript">
$(function () {
	var data = [];
	var datasets;
<?php 
    include("../../../cgi-bin/db_functions.php");
	$OGR_FID=$_POST['id'];
	//$OGR_FID=2;
    $query="SELECT * FROM stat WHERE id=".$OGR_FID;
    if(  $result=ExecuteQuery($query) )
    { 
        $field=array();
        $line = mysql_fetch_array($result, MYSQL_ASSOC);
        foreach($line as $key => $value)
        {
            $field[$key]=$value;
        }
	
//  формуємо datasets, наприклад,
$datasets_string=" datasets = { ";
$datasets_string.=" 'criterion_1': {label: 'Перевезення вантажів, млн. т.', ";
$datasets_string.="data: [ [1995, ".$field['W1']."], [2000, ".$field['W2']."], [2005,  ".$field['W3']."], [2007,  ".$field['W4']."], [2008,  ".$field['W5']."] , [2009,  ".$field['W6']."]";
$datasets_string.="]},";
$datasets_string.=" 'criterion_2': {label: 'Вантажооборот, млн. ткм', ";
$datasets_string.=" data: [ [1995, ".$field['W7']."], [2000, ".$field['W8']."], [2005,  ".$field['W9']."], [2007,  ".$field['W10']."], [2008,  ".$field['W11']."] , [2009,  ".$field['W12']."] ";
$datasets_string.="]},";
$datasets_string.=" 'criterion_3': {label: 'Середня відстань перевезення, км', ";
$datasets_string.=" data: [ [1995, ".$field['W13']."], [2000, ".$field['W14']."], [2005,  ".$field['W15']."], [2007,  ".$field['W16']."], [2008,  ".$field['W17']."] , [2009,  ".$field['W18']."] ";
$datasets_string.="]} }; ";	
print($datasets_string); 
        mysql_free_result($result);
    }else 
    {   
      $datasets_string=" datasets = { 'criterion_1': {label: 'Не отримані дані з бази даних', data: [ [0, 0] ]}}; "; 
	  print($datasets_string); 
    }
?>   	
    var i = 0;
    $.each(datasets, function(key, val) {
        val.color = i;
        ++i;
    });
    
    // insert checkboxes 
    var choiceContainer = $("#diag-line-choices");
    $.each(datasets, function(key, val) {
        choiceContainer.append('<br/><div class="criterion-fields"><div class ="criterion-check"> <input type="checkbox" name="' + key +
                               '" checked="checked"  id="id' + key + '"></div>' +
                               '<div class="criterion-text"><label for="id' + key + '">'
                                + val.label + '</label></div></div>');
    });
    choiceContainer.find("input").click(plotAccordingToChoices);
    function plotAccordingToChoices() {
        var data = [];
        choiceContainer.find("input:checked").each(function () {
            var key = $(this).attr("name");
            if (key && datasets[key])
                data.push(datasets[key]);
        });

        if (data.length > 0)
            $.plot($("#diag-line-1"), data, {
                yaxis: { min: 0 },
                xaxis: { tickDecimals: 0 },
				series: {

           	 lines: { show: true },

            points: { show: true }

        },
            });
    }
    plotAccordingToChoices();

});
</script>


