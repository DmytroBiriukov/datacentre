<? $layer=$_POST['layer'];
   $ip_server=$_POST['ip_server'];
?>
<link rel="stylesheet" type="text/css" href="css/ol/style.css"/>
<link rel="stylesheet" type="text/css" href="modules/gis-charts-2/gis-controls.css"/> 
<script src="js/ol/OpenLayers.js" type="text/javascript"></script>
<script src="modules/gis-charts-2/settings.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="js/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript">
	$(function() {$( "#accordion" ).accordion();});
	init(<? echo "'Ukravtodor:".$layer."'"; ?>); 
</script>
<img src="modules/gis-charts-2/gis-charts-2.png"/>
<div id="accordion">
	<h3><a href="#">Візуалізація даних по об'єктам</a></h3>   
	<div>
    <p>Для того щоб переглянути статистичні дані у вигляді діаграм - оберіть необхідний регіон на карті за допомогою лівої кнопки мишки.</p>

	</div> 
</div>    
		

        <div id="map-panel">
    		<div id="map"></div>            
		</div>
         
        <div id="info-reg-title"></div>
	<div id="diag-panel-pie"></div>	 
    <div id="diag-panel">
	<div id="diag-panel-line"></div>
     <div id="diag-panel-bars"></div>
     </div>
	



