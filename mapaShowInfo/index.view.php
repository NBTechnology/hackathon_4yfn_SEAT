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
    var routes = [];
    <?php $i = 0; foreach ($routesDecrypt as $key => $value):?>
      routes[<?php echo $i; ?>] = <?php echo json_encode($value); $i++;?>;
    <?php endforeach;?>
      
      var stops = [];
      <?php $i = 0; foreach ($stops as $key => $value):?>
      
      stops[<?php echo $i; ?>] = [];
      <?php $j = 0; foreach ($value as $subKey => $subValue):?>
      
        <?php if(isset($subValue['point'])):?>
          stops[<?php echo $i; ?>][<?php echo $j ?>] = {lat: <?php echo $subValue['point']['_latitude'];?>, lon:<?php echo $subValue['point']['_longitude'];?>}<?php $j++;?>;
          <?php endif;?>
        <?php endforeach; $i++;?>
      <?php endforeach;?>
      
      
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8,
          center: {lat: 41.4050991151482, lng: 2.148425279791546}
        });
        routes.forEach(element => {

          //POLYLINE
          var flightPlanCoordinates = [];
          var i = 0;
          for (let index = 0; index < element.length - 1; index+=2) {
          flightPlanCoordinates[i] = {lat: element[index], lng: element[index + 1]};
          i++;

          }
          
        var flightPath = new google.maps.Polyline({
          path: flightPlanCoordinates,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);


        // STOPS
        for (let index = 0; index < stops.length; index++) {
          for (let indexSub = 0; indexSub < stops[index].length; indexSub++) {
            const element = stops[index][indexSub];
            console.log("ELEMENT -> " + element['lat']);
            
            marker = new google.maps.Marker({
              map: map,
              draggable: false,
              animation: google.maps.Animation.DROP,
              position: {lat: element['lat'], lng: element['lon']}
            });
          //marker.addListener('click', toggleBounce);

          }
        }
        

        });
        
        
        
      
      
      }

      function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
    

     

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnylhyqEukDoV86vk8PAiQ1fVNfWrZi-Q&callback=initMap" async defer></script>
  </body>
</html>