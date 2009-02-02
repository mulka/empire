<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&key=ABQIAAAAIgkf_4LoiNSc_U8b1dpNDRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxTYam1TcrpJqwNattci-1PClE6u3g"
            type="text/javascript"></script>
    <script src="func.boundsToPolyline.js" type="text/javascript"></script>

  </head>

  <body onunload="GUnload()">
    <div id="map" style="width: 500px; height: 300px"></div>
    <input type="button" onclick="clearBounds();" value="Clear Bounds">
        <script type="text/javascript">
    //<![CDATA[

      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GLargeMapControl());
        var center = new GLatLng(37.4419, -122.1419);
        map.setCenter(center, 13);
        
        function getBounds(marker1, marker2){
          var bounds = new GLatLngBounds();
          bounds.extend(marker1.getPoint());
          bounds.extend(marker2.getPoint());
          return bounds;
        }

        var marker1 = new GMarker(new GLatLng(37.43, -122.11), {draggable: true});
        var marker2 = new GMarker(center, {draggable: true});
        var polyline = boundsToPolyline(getBounds(marker1, marker2));
        var bounds = getBounds(marker1, marker2);
        var boundsShowing;
        
        function clearBounds(){
          map.removeOverlay(polyline);
          map.removeOverlay(marker1);
          map.removeOverlay(marker2);
          boundsShowing = 0;
        }
        
        function markerMoved(){
          map.removeOverlay(polyline);
          polyline = boundsToPolyline(getBounds(marker1, marker2));
          map.addOverlay(polyline);
        }
        
        var listener1;
        var listener2;
        
        function addListeners(){
          listener1 = GEvent.addListener(marker1, "dragend", function() {
            markerMoved();
          });
          listener2 = GEvent.addListener(marker2, "dragend", function() {
            markerMoved();
          });
        }
        
        GEvent.addListener(map, "click", function(overlay, point){
          if(point && !boundsShowing){
            addBounds();
            marker1.setPoint(point);
            marker2.setPoint(point);
            markerMoved();
          }
        });
        
        function addBounds(){
          map.addOverlay(marker1);
          map.addOverlay(marker2);
          map.addOverlay(polyline);        
          boundsShowing = 1;
        }
        
        addListeners();
        addBounds();


      }
    

    //]]>
    </script>
  </body>
</html>
