<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&key=ABQIAAAAIgkf_4LoiNSc_U8b1dpNDRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxTYam1TcrpJqwNattci-1PClE6u3g"
            type="text/javascript"></script>
    <script src="func.boundsToPolyline.js" type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
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
        
        function markerMoved(){
          map.removeOverlay(polyline);
          polyline = boundsToPolyline(getBounds(marker1, marker2));
          map.addOverlay(polyline);
        }
        
        GEvent.addListener(marker1, "dragend", function() {
          markerMoved();
        });
        GEvent.addListener(marker2, "dragend", function() {
          markerMoved();
        });

        map.addOverlay(marker1);
        map.addOverlay(marker2);
        map.addOverlay(polyline);

      }
    }
    //]]>
    </script>
  </head>

  <body onload="load()" onunload="GUnload()">
    <div id="map" style="width: 500px; height: 300px"></div>
  </body>
</html>
