<!-- tutorial -->
http://api.tgos.nat.gov.tw/TGOS_MAP_API/web/default.aspx?id=MapZoom

http://www.w3schools.com/googleapi/google_maps_overlays.asp


<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
  function initialize()
  {
    var myLatLng = new google.maps.LatLng(25.051501,121.569621);
    var mapProp = {
      center:new google.maps.LatLng(25.051501,121.569621),
      zoom:16,
      scrollwheel: false,
    // draggable: false,
    styles: [ { stylers: [ { saturation: -100 } ] } ],
    mapTypeId:google.maps.MapTypeId.ROADMAP
  }


  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
   //googleMap 是div id

   // normal marker
   // var marker = new google.maps.Marker({
   //     position: myLatLng,
   //     map: map,
   //     title: 'Hello World!'
   //   });

   // for scale icon
   // var image = {
   //     url: 'images/logo_map-1.png',
   //     // This marker is 20 pixels wide by 32 pixels high.
   //     scaledSize : new google.maps.Size(160,78),
   //     // The origin for this image is (0, 0).
   //     origin: new google.maps.Point(0, 0),
   //     // The anchor for this image is the base of the flagpole at (0, 32).
   //     anchor: new google.maps.Point(0, 0)
   //   };
   var image = 'images/maplogo.png';
   var beachMarker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    icon: image
  });
 }

 google.maps.event.addDomListener(window, 'load', initialize);
</script>


<!-- multiple marker -->
<script>
  function initialize()
  {
    var myLatLng = new google.maps.LatLng(24.810180, 120.968116);
    var mapProp = {
      center:new google.maps.LatLng(24.810180, 120.968116),
      zoom:16,
      scrollwheel: false,
        // draggable: false,
        styles: [ { stylers: [ { saturation: -100 } ] } ],
        mapTypeId:google.maps.MapTypeId.ROADMAP
      }

      var bounds = new google.maps.LatLngBounds();
    // Multiple Markers
    var markers = [
    ['London Eye, London', 24.810180, 120.968116],
    ['Palace of Westminster, London', 24.811792, 120.965772]
    ];

    // link with mysql
    // var markers = [
    // <?php while ($row_Recstore_map = mysql_fetch_assoc($Recstore_map)) {
    //   $title=$row_Recstore_map['d_title'];
    //   $latlng=$row_Recstore_map['d_class5'];
    //   echo "['".$title."',".$latlng."],";
    // } ?>
    // ];

    // Info Window Content
    var infoWindowContent = [
    ['<div class="info_content">' +
    '<h3>London Eye</h3>' +
    '<p>The London Eye is a giant Ferris wheel situated on the banks of the River Thames. The entire structure is 135 metres (443 ft) tall and the wheel has a diameter of 120 metres (394 ft).</p>' +        '</div>'],
    ['<div class="info_content">' +
    '<h3>Palace of Westminster</h3>' +
    '<p>The Palace of Westminster is the meeting place of the House of Commons and the House of Lords, the two houses of the Parliament of the United Kingdom. Commonly known as the Houses of Parliament after its tenants.</p>' +
    '</div>']
    ];

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

    var image = {
      url: 'images/maplogo.png',
      scaledSize : new google.maps.Size(73,91),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(0, 0)
    };
    // Loop through our array of markers & place each one on the map
    for( i = 0; i < markers.length; i++ ) {
      var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
      bounds.extend(position);
      marker = new google.maps.Marker({
        position: position,
        map: map,
        title: markers[i][0],
        icon: image
      });

      // Allow each marker to have an info window
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infoWindow.setContent(infoWindowContent[i][0]);
          infoWindow.open(map, marker);
        }
      })(marker, i));

      // Automatically center the map fitting all markers on the screen
      map.fitBounds(bounds);
    }
   // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
   var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
    this.setZoom(14);
    google.maps.event.removeListener(boundsListener);
  });
 }
 google.maps.event.addDomListener(window, 'load', initialize);
</script>
