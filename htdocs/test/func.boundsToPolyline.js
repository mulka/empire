function boundsToPolyline(bounds){
	var southWest = bounds.getSouthWest();
	var northEast = bounds.getNorthEast();
	var northWest = new GLatLng(northEast.lat(), southWest.lng()); 
	var southEast = new GLatLng(southWest.lat(), northEast.lng());
	var top = new GLatLng(northEast.lat(), (northEast.lng() + northWest.lng()) /2);
	var bottom = new GLatLng(southEast.lat(), (southEast.lng() + southWest.lng()) /2);
	return new GPolyline([southWest, northWest, top, northEast, southEast, bottom, southWest]);
}