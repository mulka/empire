var cmarkers = [];
var hmarkers = [];
var cbounds = [];
var hbounds = [];

var altIcon = new GIcon();
altIcon.image = "/images/whiteMarker.png";
altIcon.shadow = "http://www.google.com/mapfiles/shadow50.png";
altIcon.iconSize = new GSize(20, 34);
altIcon.shadowSize = new GSize(37, 34);
altIcon.iconAnchor = new GPoint(9, 34);
altIcon.infoWindowAnchor = new GPoint(9, 2);
altIcon.infoShadowAnchor = new GPoint(18, 25);

// This function is invoked when the mouse goes over an entry in the side_bar
// It deletes the cold Icon marker and replaces it with the hot Icon marker      
function mymouseover(i) {
	map.removeOverlay(cmarkers[i]);
	map.addOverlay(hmarkers[i]);
	map.removeOverlay(cbounds[i]);
	map.addOverlay(hbounds[i]);
}

// This function is invoked when the mouse leaves an entry in the side_bar
// It deletes the hot Icon marker and replaces it with the cold Icon marker      
function mymouseout(i) {
	map.removeOverlay(hmarkers[i]);
	map.addOverlay(cmarkers[i]);
	map.removeOverlay(hbounds[i]);
	map.addOverlay(cbounds[i]);
	
	//not sure why I need these here again... but here they are
	GEvent.addListener(cmarkers[i], "mouseover", function() {
		cmarkers[i].showTooltip();
		
	});
	GEvent.addListener(cmarkers[i], "mouseout", function() {
		cmarkers[i].hideTooltip();
	});
}

function createPdMarker(point, tooltip, id, imageUrl) {
	var marker = new PdMarker(point, new GIcon(G_DEFAULT_ICON, imageUrl));
	marker.setId(id);
	marker.setTooltip('<div style="background-color: white; white-space: nowrap; border: 1px solid black; font-family: arial; font-size: 10px; font-weight: bold; padding: 2px;">' + tooltip + '</div>');
	marker.setOpacity(100);
	GEvent.addListener(marker, "click", function() {
// OMG... total hack, please fix!
if(window.location.pathname == "/iframe.php"){
		window.open('/loc/' + id, "_top");
}else{
		window.open('/loc/' + id, "_self");
}
		//marker.openInfoWindowHtml('locId: ' + locId + '<br><a target="_top" href="/loc/' + locId + '">View Location</a>');
	});
	cmarkers[id] = marker;
	hmarkers[id] = new GMarker(point,altIcon);
	
	GEvent.addListener(cmarkers[id], "mouseover", function() {
		cmarkers[id].showTooltip();        
		map.removeOverlay(cbounds[id]); 
		map.addOverlay(hbounds[id]);
	});
	GEvent.addListener(cmarkers[id], "mouseout", function() {
		cmarkers[id].hideTooltip();
		map.removeOverlay(hbounds[id]);
		map.addOverlay(cbounds[id]);
	});
	
	return cmarkers[id];
}

function createPdBounds(bounds, id){
        var points = boundsToPoints(bounds);
	var polyline = new GPolyline(points);
        polyline.id = id;
        cbounds[id] = polyline;
        hbounds[id] = new GPolyline(points, '#FFFFFF');
        return polyline;
}
