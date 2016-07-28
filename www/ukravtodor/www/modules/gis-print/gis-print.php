<? $layer=$_POST['layer'];
   $ip_server=$_POST['ip_server'];
?>
<link rel="stylesheet" type="text/css" href="css/ol/style.css"/>
<link rel="stylesheet" type="text/css" href="modules/gis-print/gis-controls.css"/> 
<script src="js/ol/OpenLayers.js" type="text/javascript"></script>
<script src="modules/gis-print/settings.js" type="text/javascript"></script>
<img src="modules/gis-print/gis-print-large.png"  />
<div id="map_panel">
    <div id="map"></div>
</div>
<script>init(<? echo "'Ukravtodor:".$layer."'"; ?>); </script>