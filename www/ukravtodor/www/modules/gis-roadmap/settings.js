var map, base_layer, vector_layer, bounds, 
    saveStrategy, selectedFeature, report,
    panel, draw,edit,del,save, nav, 
    Style_Roads;
 
function reloadmap(ip_server_new)
{ ip_server=ip_server_new;
  document.getElementById("map").innerHTML = "";
  init();
}
   
var DeleteFeature = OpenLayers.Class(OpenLayers.Control, {
    initialize: function(layer, l_options) {
        OpenLayers.Control.prototype.initialize.apply(this, [l_options]);
        this.layer = layer;
        this.handler = new OpenLayers.Handler.Feature(
            this, layer, {click: this.clickFeature}
        );
    },
    clickFeature: function(feature) {
        if(feature.fid == undefined) {
            this.layer.destroyFeatures([feature]);
        } else {
            feature.state = OpenLayers.State.DELETE;
            this.layer.events.triggerEvent("afterfeaturemodified", 
                                           {feature: feature});
            feature.renderIntent = "select";
            this.layer.drawFeature(feature);
        }
    },
    setMap: function(map) {
        this.handler.setMap(map);
        OpenLayers.Control.prototype.setMap.apply(this, arguments);
    },
    CLASS_NAME: "OpenLayers.Control.DeleteFeature"
});
       
function init(){
    
/*      MAP SETTINGS        */      
    bounds = new OpenLayers.Bounds(
        22.139, 44.386,
        40.228, 52.38
    );
    
    map = new OpenLayers.Map('map',{
        controls: [],
        maxExtent: bounds,
        projection: "EPSG:4284",
	    scales: [10000000, 5000000, 2000000, 
                 1000000, 500000, 200000, 50000],
        units: 'degrees'
    });
    
    saveStrategy = new OpenLayers.Strategy.Save();
    loadLayers();  
    report = function(e) {OpenLayers.Console.log(e.type, e.feature.id);};
    loadPanel();
    
    map.zoomToExtent(bounds);     
}

function loadLayers()
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
            LAYERS: 'Ukravtodor',
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
			
    vector_layer = new OpenLayers.Layer.Vector("Автодороги загального призначення", {
        strategies: [new OpenLayers.Strategy.Fixed(), saveStrategy],
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

function loadPanel()
{   /*      CONTROLS        */
    map.addControl(new OpenLayers.Control.PanZoomBar({position: new OpenLayers.Pixel(2, 15)}));
    map.addControl(new OpenLayers.Control.Navigation());
    map.addControl(new OpenLayers.Control.Scale($('scale')));
    map.addControl(new OpenLayers.Control.MousePosition({element: $('location')}));
	map.addControl(new OpenLayers.Control.LayerSwitcher());
    /*     PANEL FOR WFS LAYER       */    
    panel = new OpenLayers.Control.Panel({
        displayClass: 'customEditingToolbar',
        allowDepress: true
    });
    /*      Draw line       */
    draw = new OpenLayers.Control.DrawFeature(
        vector_layer, OpenLayers.Handler.Path,{
            title: "Додати об\'єкт",
            displayClass: "olControlDrawFeaturePath",
            multi: true
        }
    );
    /*      Edit line       */
    edit = new OpenLayers.Control.ModifyFeature(vector_layer, {
        title: "Внести зміни",
        displayClass: "olControlModifyFeature",
		onModificationStart: onFeatureUpdate
    });

    /*      Delete line     */
    del = new DeleteFeature(vector_layer, {title: "Видалити об\'єкт"});
   
    /*      Save line       */
    save = new OpenLayers.Control.Button({
        title: "Зберeгти зміни",
        trigger: function() {
            if(edit.feature) {edit.selectControl.unselectAll();}
            saveStrategy.save();},
        displayClass: "olControlSaveFeatures"
    });
    
    /*      Navigate        */
	nav = new OpenLayers.Control.MouseDefaults({title:'Навігація',});

    /*      Print        */
	print_button = new OpenLayers.Control.Button({
	    displayClass: "olControlPrint", trigger: PrintMap
    	});
		        
    panel.addControls([print_button, save, del, edit, draw, nav]);
    map.addControl(panel);
    
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
function onFeatureUpdate(feature)
{/*      Event when line edit control selected (update line information)        */
    document.getElementById("update_place").style.display='block';
	$("#update_place").load("modules/gis-roadmap/roads-data.php", { id : feature.fid.slice(10)} );
}
function onFeatureSelect(feature) 
{/*      Event when line selected        */
}
function onFeatureUnselect(feature) 
{/*      Event when line unselected        */
}

var print_wait_win = null;
function PrintMap() 
{   //-- post a wait message
    //print_wait_win = window.open("pleasewait.html", "print_wait_win", "scrollbars=no, status=0, height=15, width=20, resizable=1");
    // go through all layers, and collect a list of objects
    // each object is a tile's URL and the tile's pixel location relative to the viewport
    var offsetX = parseInt(map.layerContainerDiv.style.left);
    var offsetY = parseInt(map.layerContainerDiv.style.top);	
    var size  = map.getSize();
    var tiles = [];
    for (layername in map.layers) 
	{   // if the layer isn't visible at this range, or is turned off, skip it
        var layer = map.layers[layername];
        if (!layer.getVisibility()) continue;
        if (!layer.calculateInRange()) continue;
        // iterate through their grid's tiles, collecting each tile's extent and pixel location at this moment
        for (tilerow in layer.grid) 
		{ for (tilei in layer.grid[tilerow]) 
		  {     var tile     = layer.grid[tilerow][tilei]
                var url      = layer.getURL(tile.bounds);
                var position = tile.position;
                var tilexpos = position.x + offsetX;
                var tileypos = position.y + offsetY;				
                var opacity  = layer.opacity ? parseInt(100*layer.opacity) : 100;
                tiles[tiles.length] = {url:url, x:tilexpos, y:tileypos, opacity:opacity};
           }
        }
    }
    print_wait_win = window.open("src/pleasewait.htm", "Зачекайте виконання операції на сервері", "scrollbars=no, status=0, height=150, width=200, resizable=1");
    // hand off the list to our server-side script, which will do the heavy lifting
    var tiles_json = JSON.stringify(tiles);
//    var printparams = 'width='+size.w + '&height='+size.h + '&tiles='+escape(tiles_json) ;
    var printparams = 'width='+size.w + '&height='+size.h + '&tiles='+escape(tiles_json) ;
    
//	alert(printparams);
    
	OpenLayers.Request.POST(
      { url:'src/printmap.php',
        data:OpenLayers.Util.getParameterString({width:size.w,height:size.h,tiles:tiles_json}),
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        callback: function(request) 
					{  print_wait_win.close();
			           window.open(request.responseText);
        			}
      }
    );
}