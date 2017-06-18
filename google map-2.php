<!-- for MarkerClusterer -->
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

<div class="googleMapFilterWrap">
	<div class="item" data-cat="1">總公司</div>
	<div class="item" data-cat="2">專賣店</div>
	<div class="item" data-cat="3">經銷商</div>
</div>

<script>
	$(function() {
		var markers;
		var markerCluster;
		var map;

		function initMap() {
			map = new google.maps.Map(document.getElementById('agencyGoogleMap'), {
				zoom: 4,
				disableDefaultUI: true,
				// scrollwheel: false,
				styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}],
				center: {
					lat: -28.024,
					lng: 140.887
				}
			});

			// 自訂放大縮小鍵
			function ZoomControl(controlDiv, map) {
			  // Set CSS for the control wrapper
			  var controlWrapper = document.createElement('div');
			  controlWrapper.style.cursor = 'pointer';
			  controlWrapper.style.width = '28px';
			  controlWrapper.style.height = '64px';
			  controlWrapper.style.position = 'relative';
			  controlWrapper.style.top = '15px';
			  controlWrapper.style.left = '-15px';
			  controlDiv.appendChild(controlWrapper);

			  // Set CSS for the zoomIn
			  var zoomInButton = document.createElement('div');
			  zoomInButton.style.width = '29px';
			  zoomInButton.style.height = '29px';
			  zoomInButton.style.marginBottom = '6px';
			  zoomInButton.style.backgroundImage = 'url("images/zoomIn.png")';
			  controlWrapper.appendChild(zoomInButton);

			  // Set CSS for the zoomOut
			  var zoomOutButton = document.createElement('div');
			  zoomOutButton.style.width = '29px';
			  zoomOutButton.style.height = '29px';
			  zoomOutButton.style.backgroundImage = 'url("images/zoomOut.png")';
			  controlWrapper.appendChild(zoomOutButton);

			  // Setup the click event listener - zoomIn
			  google.maps.event.addDomListener(zoomInButton, 'click', function() {
			    map.setZoom(map.getZoom() + 1);
			  });

			  // Setup the click event listener - zoomOut
			  google.maps.event.addDomListener(zoomOutButton, 'click', function() {
			    map.setZoom(map.getZoom() - 1);
			  });

			}

			var infoWindowContent = [
				[
					'<div class="info_content">' +
					'<div class="title">INTELLIGENT 因特力淨</div>' +
					'<div class="content">100台北市中正區衡陽路7號15F<br>02-23817978</div>' +
					'</div>'
				], [
					'<div class="info_content">' +
					'<div class="title">INTELLIGENT 因特力淨22</div>' +
					'<div class="content">第二間<br>02-23817978</div>' +
					'</div>'
				],
			];

			var infoWindow = new google.maps.InfoWindow();

			// set marker image
			var image = 'images/maplogo.png';

			// Add some markers to the map.
			// Note: The code uses the JavaScript Array.prototype.map() method to
			// create an array of markers based on a given "locations" array.
			// The map() method here has nothing to do with the Google Maps API.
			markers = locations.map(function(location, i) {
				var maker=new google.maps.Marker({
					position: location,
					icon: image,
					category: location.cat,
				});

				// Allow each marker to have an info window
				google.maps.event.addListener(maker, 'click', (function(maker, i) {
					return function() {
						infoWindow.setContent(infoWindowContent[i][0]);
						infoWindow.open(map, maker);
					}
				})(maker, i));

				return maker;
			});

			// 計算這區有幾個marker
			var clusterStyles = [
			  {
			    url: 'images/markerclusterer1.png',
			    height: 34,
			    width: 34
			  },
			];
			var mcOptions = {
			    styles: clusterStyles,
			};
			markerCluster = new MarkerClusterer(map, markers, mcOptions);

			// 寫入自訂的放大縮小
			var zoomControlDiv = document.createElement('div');
			var zoomControl = new ZoomControl(zoomControlDiv, map);

			zoomControlDiv.index = 1;
			map.controls[google.maps.ControlPosition.RIGHT_TOP].push(zoomControlDiv);
		}

		var locations = [{
			lat: -31.563910,
			lng: 147.154312,
			cat: 1
		}, {
			lat: -33.718234,
			lng: 150.363181,
			cat: 2
		}]

		initMap();

		// markers filter
		$(".googleMapFilterWrap .item").on("click", function  () {
			$(this).toggleClass("active").siblings().removeClass("active");

			if (!$(this).hasClass("active")) {
				filterMarkers("-1");
			}else{
				filterMarkers($(this).data("cat"));
			}
		})

		function filterMarkers(cat) {
			for (var i = 0; i < markers.length; i++) {
				if (markers[i].category == cat || cat=='-1') {
					markers[i].setMap(map);
					markerCluster.addMarker(markers[i]);
				} else {
					markers[i].setMap(null);
					markerCluster.removeMarker(markers[i]);
				}
			}
		}
	})
</script>