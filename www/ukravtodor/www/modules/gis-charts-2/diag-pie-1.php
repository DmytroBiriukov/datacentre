<p>Секторні діаграми:</p>
<div id="pie-charts">
	<div class="diag-pie">
    	<div id="diag-pie-1-text">Перевезення вантажів автомобільним транспортом, млн. т</div>
		<div id="diag-pie-1" style="width:310px;height:250px;"></div>
    </div>
    <div class="diag-pie">
    	<div id="diag-pie-2-text">Вантажооборот автомобільного транспорту, млн. ткм</div>
		<div id="diag-pie-2" style="width:310px;height:250px;"></div>
    </div>
    <div class="diag-pie">
    	<div id="diag-pie-3-text">Середня відстань перевезення однієї тонни вантажівавтомобільним транспортом, км</div>
		<div id="diag-pie-3" style="width:310px;height:250px;"></div>
	</div>
</div>
<script type="text/javascript">
$(function () {
//W1, W2, W3, W4,W5,W6
	var data_1 = [];
	var data_2 = [];
	var data_3 = [];
	<?php 
    	include("../../../cgi-bin/db_functions.php");
		$OGR_FID=$_POST['id'];
	
    	$query="SELECT * FROM stat WHERE id=".$OGR_FID;
    	if(  $result=ExecuteQuery($query) )
    	{ 
        	$field=array();
        	$line = mysql_fetch_array($result, MYSQL_ASSOC);
        	foreach($line as $key => $value)
       	 	{
            	$field[$key]=$value;
        	}
	
			//  формуємо data 1
			$data_string=" data_1 = [ ";
			$data_string.=" {label: '1995', ";
			$data_string.="data: ".$field['W1'];
			$data_string.="},";
			$data_string.=" {label: '2000', ";
			$data_string.=" data: ".$field['W2'];
			$data_string.="},";
			$data_string.=" {label: '2005', ";
			$data_string.="data: ".$field['W3'];
			$data_string.="},";
			$data_string.=" {label: '2007', ";
			$data_string.=" data: ".$field['W4'];
			$data_string.="},";
			$data_string.=" {label: '2008', ";
			$data_string.=" data: ".$field['W5'];
			$data_string.="},";
			$data_string.=" {label: '2009', ";
			$data_string.=" data: ".$field['W6'];
			$data_string.="}];";
			

			print($data_string); 
			
			//  формуємо data 2
			$data_string=" data_2 = [ ";
			$data_string.=" {label: '1995', ";
			$data_string.="data: ".$field['W7'];
			$data_string.="},";
			$data_string.=" {label: '2000', ";
			$data_string.=" data: ".$field['W8'];
			$data_string.="},";
			$data_string.=" {label: '2005', ";
			$data_string.="data: ".$field['W9'];
			$data_string.="},";
			$data_string.=" {label: '2007', ";
			$data_string.=" data: ".$field['W10'];
			$data_string.="},";
			$data_string.=" {label: '2008', ";
			$data_string.=" data: ".$field['W11'];
			$data_string.="},";
			$data_string.=" {label: '2009', ";
			$data_string.=" data: ".$field['W12'];
			$data_string.="}];";
			print($data_string); 
			//  формуємо data 3
			$data_string=" data_3 = [ ";
			$data_string.=" {label: '1995', ";
			$data_string.="data: ".$field['W13'];
			$data_string.="},";
			$data_string.=" {label: '2000', ";
			$data_string.=" data: ".$field['W14'];
			$data_string.="},";
			$data_string.=" {label: '2005', ";
			$data_string.="data: ".$field['W15'];
			$data_string.="},";
			$data_string.=" {label: '2007', ";
			$data_string.=" data: ".$field['W16'];
			$data_string.="},";
			$data_string.=" {label: '2008', ";
			$data_string.=" data: ".$field['W17'];
			$data_string.="},";
			$data_string.=" {label: '2009', ";
			$data_string.=" data: ".$field['W18'];
			$data_string.="}];";
			print($data_string); 
			
			
			mysql_free_result($result);
		}
		else 
		{   
      		$data_string=" data_1 = [{label: 'Не отримані дані з бази даних', data_1:  0}]; "; 
	  		print($data_string); 
    	}
	?>   	

	$.plot($("#diag-pie-1"), data_1, 
	{
		series: {
			pie: { 
				show: true,
				radius: 3/4,
				label: {
					show: true,
					radius: 3/4,
					formatter: function(label, series){
						return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
					},
					background: { 
						opacity: 0.5,
						color: '#000'
					}
				}
			}
		},
		legend: {
			show: false
		}
	});
	$.plot($("#diag-pie-2"), data_2, 
	{
		series: {
			pie: { 
				show: true,
				radius: 3/4,
				label: {
					show: true,
					radius: 3/4,
					formatter: function(label, series){
						return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
					},
					background: { 
						opacity: 0.5,
						color: '#000'
					}
				}
			}
		},
		legend: {
			show: false
		}
	});
	$.plot($("#diag-pie-3"), data_3, 
	{
		series: {
			pie: { 
				show: true,
				radius: 3/4,
				label: {
					show: true,
					radius: 3/4,
					formatter: function(label, series){
						return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
					},
					background: { 
						opacity: 0.5,
						color: '#000'
					}
				}
			}
		},
		legend: {
			show: false
		}
	});
});
</script>

	




