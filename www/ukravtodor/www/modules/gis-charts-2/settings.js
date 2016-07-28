var map, base_layer, vector_layer, bounds, 
    saveStrategy, selectedFeature, report,
    panel, draw,edit,del,save, nav, click_ctrl,
    Style_Roads;
       
function init(baselayer){
/*      MAP SETTINGS        */      
    bounds = new OpenLayers.Bounds(
        22.139, 44.386,
        40.228, 52.38
    );
    OpenLayers.Lang.en={'overlays':"Основа карти<br>",'baseLayer':"Прошарки карти<br>"};
    map = new OpenLayers.Map('map',{
        controls: [],
        maxExtent: bounds,
        projection: "EPSG:4284",
	    scales: [10000000, 5000000, 2000000, 
                 1000000, 500000, 200000, 50000],
        units: 'degrees'
    });
    

    loadLayers(baselayer);  
    report = function(e) {OpenLayers.Console.log(e.type, e.feature.id);};
    loadPanel();
    
    map.zoomToExtent(bounds);     
}

function loadLayers(baselayer)
{
/*      VECTOR LAYER STYLE      */
    Style_Roads = new OpenLayers.StyleMap({
		"default": new OpenLayers.Style({
			pointRadius: 3,
			strokeColor: "red", 
            strokeWidth: 2, 
            strokeOpacity: 1, 
        	fillColor: 'yellow', 
            fillOpacity: 0.2,
			graphicZIndex: 1 
       }),
		"select": new OpenLayers.Style({ 
        	pointRadius: 3, 
            strokeColor: "#3399ff", 
            strokeWidth: 2, 
            strokeOpacity: 1, 
        	fillColor: '#66ccff', 
            fillOpacity: 0.2,
			graphicZIndex: 2 
       })
	});
    
/*      ADD LAYERS      */    
    base_layer= new OpenLayers.Layer.WMS(
        "Адміністративно-територіальний поділ", "http://"+ip_server+"/geoserver/wms",{
            LAYERS: baselayer,
            /*SLD: 'http://91.202.128.36/modules/gis-charts/SLD/ratings_1-1.sld',*/
            STYLES: '',
            format: 'image/png',
            tiled: true,
            tilesOrigin : map.maxExtent.left + ',' + map.maxExtent.bottom
        },{
            buffer: 0,
            displayOutsideMaxExtent: true,
            isBaseLayer: true,
            yx : {'EPSG:4284' : true}
    });
			
    vector_layer = new OpenLayers.Layer.Vector("Автодороги загального користування", {
        strategies: [new OpenLayers.Strategy.Fixed()],
        projection: new OpenLayers.Projection("EPSG:4284"),	
        protocol: new OpenLayers.Protocol.WFS({
            version: '1.1.0',
            url: '/geoserver/wfs',
            featureType: 'gis_roads',
            geometryName: "SHAPE",
            featureNS: 'http://ukravtodor.gov.ua',
            schema: "/geoserver/wfs/DescribeFeatureType?version=1.1.0&typename=Ukravtodor:gis_roads"
        }),
        styleMap: Style_Roads,
        visibility: false				
    });
    
    map.addLayers([ base_layer, vector_layer]);
	
}

function loadPanel(){
    
    //WMSGetFeatureInfo
    click_ctrl = new OpenLayers.Control.WMSGetFeatureInfo({
        url: "http://"+ip_server+"/geoserver/wms",
        layers: [base_layer],
        queryVisible: true,
        infoFormat: 'application/vnd.ogc.gml',
        autoActivate: true,
        eventListeners: {
            'getfeatureinfo': function(e) {
				loaddata(e.features[0].attributes.id, e.features[0].attributes.reg_title);
         }
    }
});
 
function loaddata(reg_id, reg_title)
{               $("#info-reg-title").html("Регіон, що розглядається: " + reg_title+" ");
                $("#diag-panel-line").load("modules/gis-charts-2/diag-line-1.php",{id: reg_id});
                $("#diag-panel-bars").load("modules/gis-charts-2/diag-bars-1.php",{id: reg_id});
                $("#diag-panel-pie").load("modules/gis-charts-2/diag-pie-1.php",{id: reg_id});
}
    
/*      CONTROLS        */
    map.addControl(new OpenLayers.Control.PanZoomBar({position: new OpenLayers.Pixel(2, 15)}));
    map.addControl(new OpenLayers.Control.Navigation());
    map.addControl(new OpenLayers.Control.Scale($('scale')));
    map.addControl(new OpenLayers.Control.MousePosition({element: $('location')}));
	map.addControl(new OpenLayers.Control.LayerSwitcher());
    map.addControl(click_ctrl);
    
 /*     PANEL FOR WFS LAYER       */    
    panel = new OpenLayers.Control.Panel({
        displayClass: 'customEditingToolbar',
        allowDepress: true
    });
     
    /*      HIGHLITE AND SELECT CONTROLS FOR VECTOR LAYER     */
    var highlightCtrl = new OpenLayers.Control.SelectFeature(vector_layer, {
                hover: true,
                highlightOnly: true,
                renderIntent: "temporary",
                eventListeners: {
                    beforefeaturehighlighted: report,
                    featurehighlighted: report,
                    featureunhighlighted: report
                }
            });
			
	 var selectCtrl = new OpenLayers.Control.SelectFeature(vector_layer,{
				clickout: true,
				onSelect: onFeatureSelect,
				onUnselect: onFeatureUnselect
			});
            
     map.addControl(highlightCtrl);
     map.addControl(selectCtrl);    
     highlightCtrl.activate();
     selectCtrl.activate();
}



function onFeatureSelect(feature) {
/*      Event when line selected        */
}

function onFeatureUnselect(feature) {
/*      Event when line unselected        */
}

