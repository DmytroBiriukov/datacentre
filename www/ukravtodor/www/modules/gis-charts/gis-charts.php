<? $layer=$_POST['layer'];
   $ip_server=$_POST['ip_server'];
?>
<link rel="stylesheet" type="text/css" href="css/ol/style.css"/>
<link rel="stylesheet" type="text/css" href="modules/gis-charts/gis-controls.css"/> 
<script src="js/ol/OpenLayers.js" type="text/javascript"></script>
<script src="modules/gis-charts/settings.js" type="text/javascript"></script>
<div id="map_panel">
    <div id="map"></div>
</div>
<script>init(<? echo "'Ukravtodor:".$layer."'"; ?>); </script>

