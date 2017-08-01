<script src="js/markerwithlabel.js"></script>

<script>
	function initialize() {
	    var myLatLng = new google.maps.LatLng(24.810180, 120.968116);
	    var mapProp = {
	        center: new google.maps.LatLng(24.810180, 120.968116),
	        zoom: 16,
	        scrollwheel: false,
	        // draggable: false,
	        styles: [{
	            stylers: [{
	                saturation: -100
	            }]
	        }],
	        mapTypeId: google.maps.MapTypeId.ROADMAP
	    }

	    var bounds = new google.maps.LatLngBounds();
	    // Multiple Markers
	    var markers = [
	        ['London Eye, London', 24.810180, 120.968116],
	        ['Palace of Westminster, London', 24.811792, 120.965772]
	    ];

	    // Info Window Content
	    var infoWindowContent = [
	        ['<div class="info_content">' +
	            '<h3>Ostia</h3>' +
	            '<div class="info_address">No.166, Sec. 4, Chongcing N. Rd., Shihlin Dist., Taipei City 111, Taiwan (R.O.C.)</div>' +
	            '<div class="info_phone">02-88111814</div>' +
	            '</div>'
	        ],
	       	['<div class="info_content">' +
	       	    '<h3>Ostia</h3>' +
	       	    '<div class="info_address">No.166, Sec. 4, Chongcing N. Rd., Shihlin Dist., Taipei City 111, Taiwan (R.O.C.)</div>' +
	       	    '<div class="info_phone">02-88111814</div>' +
	       	    '</div>'
	       	],
	    ];

	    // Display multiple markers on a map
	    var infoWindow = new google.maps.InfoWindow(),
	        marker, i;

		var labelIndex = 0;

	    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

	    var image = 'images/maplogo.png';
	    // Loop through our array of markers & place each one on the map
	    for (i = 0; i < markers.length; i++) {
	        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
	        bounds.extend(position);
	        marker = new MarkerWithLabel({
	            position: position,
	            map: map,
	            title: markers[i][0],
	            icon: image,
	            labelContent: String(i + 1),
				labelClass: "my-custom-class-for-label",
				labelAnchor: new google.maps.Point(4, 29),
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