<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>

          /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
<!--     <span class="metadata-marker" style="display: none;" data-region_tag="css"></span>--> 

<span class="metadata-marker" style="display: none;" data-region_tag="html-body"></span>    
<div id="map"></div>
    <script>
    var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }

      var routes = [];
      <?php $i = 0; foreach ($routesDecrypt as $key => $value):?>
      routes[<?php echo $i; ?>] = <?php echo json_encode($value); $i++;?>;
    <?php endforeach;?>

      routes.forEach(element => {
        var flightPlanCoordinates = [
          {lat: 37.772, lng: -122.214},
          {lat: 21.291, lng: -157.821},
          {lat: -18.142, lng: 178.431},
          {lat: -27.467, lng: 153.027}
        ];
        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });
      });
    

      console.log(routes);
      

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnylhyqEukDoV86vk8PAiQ1fVNfWrZi-Q&callback=initMap" async defer></script>
  </body>
</html>