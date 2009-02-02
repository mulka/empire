var map = new GMap2(document.getElementById("map"));

map.getBoundsZoomLevel = function (bounds){
	var zoom = GMap2.prototype.getBoundsZoomLevel.call(this, bounds);
	if(zoom > 3){
		zoom = 3;
	}
	return zoom;
};

var custommap = new GMapType(tilelayers, new EuclideanProjection(18), "Photo");
map.setCenter(bounds.getCenter(), map.getBoundsZoomLevel(bounds), custommap);
map.addControl(new GLargeMapControl());
map.enableDoubleClickZoom();
map.enableContinuousZoom();
if(showBounds){
map.addOverlay(boundsToPolyline(bounds));
map.addOverlay(new GMarker(bounds.getCenter(), new GIcon(G_DEFAULT_ICON, "images/marker.png")));
}
