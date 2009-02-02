function addLocation(bounds, tooltip, id){
	map.addOverlay(createPdMarker(bounds.getCenter(), tooltip, id));
	map.addOverlay(createPdBounds(bounds, id));
}
