        if(center && zoom){
                map.setCenter(center, zoom);
        }else{
                map.setCenter(mapBounds.getCenter(), map.getBoundsZoomLevel(mapBounds));
        }
	map.setMapType(mapType);

	map.addOverlay(new GPolyline(boundsToPoints(mapBounds), '#33FF99'));
        
	function getBounds(marker1, marker2){
          var bounds = new GLatLngBounds();
          bounds.extend(marker1.getPoint());
          bounds.extend(marker2.getPoint());
          return bounds;
        }
 
        var marker1;
        var marker2;
        var polyline;
        
        function clearBounds(){
          if(polyline) map.removeOverlay(polyline);
          map.removeOverlay(marker1);
          map.removeOverlay(marker2);
          document.form.submit.disabled=true;
        }
        
        
        function updateForm(){
          document.getElementById("marker1y").value = marker1.getPoint().lat();
          document.getElementById("marker1x").value = marker1.getPoint().lng();
          document.getElementById("marker2y").value = marker2.getPoint().lat();
          document.getElementById("marker2x").value = marker2.getPoint().lng();
        }
        
        function markerMoved(){
          map.removeOverlay(polyline);
          polyline = boundsToPolyline(getBounds(marker1, marker2));
          updateForm();
          map.addOverlay(polyline);
        }
        
        function addBounds(){
          clearBounds();
          map.addOverlay(marker1);
          map.addOverlay(marker2);
          map.addOverlay(polyline);
          document.form.submit.disabled=false;
        }
        
        function initializeBounds(){
		var icon = new GIcon(G_DEFAULT_ICON);
		icon.maxHeight = 0.1; // disable drag floating
		icon.dragCrossImage = ""; // hide drag cross
		icon.dragCrossSize = new GSize(0,0); // hide drag cross 
		var options = {icon: icon, draggable: true, bouncy: false, clickable: false};
          if(bounds){
            marker1 = new GMarker(bounds.getNorthEast(), options);
            marker2 = new GMarker(bounds.getSouthWest(), options);
            polyline = boundsToPolyline(bounds);
            addBounds();
          }else{
            marker1 = new GMarker(mapBounds.getCenter(), options);
            marker2 = new GMarker(mapBounds.getCenter(), options);
            clearBounds();
            polyline = boundsToPolyline(getBounds(marker1, marker2));
          }
          markerMoved();
        }
        
        function resetBounds(){
          if(bounds){
            marker1.setPoint(bounds.getNorthEast());
            marker2.setPoint(bounds.getSouthWest());
            clearBounds();
            polyline = boundsToPolyline(bounds);
            addBounds();
          }else{
            marker1.setPoint(mapBounds.getCenter());
            marker2.setPoint(mapBounds.getCenter());
            clearBounds();
            polyline = boundsToPolyline(getBounds(marker1, marker2));
          }
          markerMoved();
        }
        
        initializeBounds();
        
        GEvent.addListener(marker1, "dragend", function() {
          markerMoved();
        });
        GEvent.addListener(marker2, "dragend", function() {
          markerMoved();
        });
        
        GEvent.addListener(map, "click", function(overlay, point){
          if(point){
            clearBounds();
            addBounds();
            marker1.setPoint(point);
            marker2.setPoint(point);
            markerMoved();
            //map.panTo(point);
          }
        });
