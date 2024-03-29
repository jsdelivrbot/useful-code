<!-- for MarkerClusterer -->
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>


<!-- 地址轉經緯度 (間隔約1.5s) -->
http://blog.xuite.net/uhoo/dc/65449068-%E8%BC%B8%E5%85%A5%E5%9C%B0%E5%9D%80%E6%89%B9%E6%AC%A1%E8%BD%89%E6%8F%9B%E7%B6%93%E7%B7%AF%E5%BA%A6%E5%B0%8F%E5%B7%A5%E5%85%B7

<script>
	function addressToLatLng(addr) {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({
			"address": addr
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				console.log(results[0].geometry.location.lat() + "," + results[0].geometry.location.lng())
			} else {
				alert("查無經緯度")
			}
		});
	}
</script>


<!-- 地址轉經緯度 + vue -->
<template lang="pug">
	.mapWrap.m-width.grid-x#shop
		.cell.large-auto(v-for="shop in shops")
			.title {{shop.title}}
			.content {{shop.address}}
			.phone 電話 &nbsp;&nbsp; {{shop.phone}}
			.maplink: a(:href="'https://maps.google.com?q=' + shop.address" target="_blank")
				img(src="/images/topmenu-deco.svg", alt="")
				| Google Map
			.googleMap(ref="map")
</template>

<script>
	var shop = new Vue({
		el: '#shop',
		data: {
			shops: []
		},
		methods: {},
		filters: {},
		created() {
			$.ajax({
				type: 'GET',
				url: 'http://kichi-cms.mounts-studio.com/shop'
			}).done((data) => {
				this.shops = data
			})
		},
		updated() {
			$(".mapWrap").ryderWaypoint({
				enter($e) {
					$e.addClass("is-show")
				}
			})

			var $map = this.$refs.map;

			this.shops.forEach( function(element, index) {
				function addressToLatLng(addr) {
					return new Promise((resolve) => {
						var geocoder = new google.maps.Geocoder();
						geocoder.geocode({
							"address": addr
						}, function (results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								resolve(results[0].geometry.location)
							} else {
								alert("查無經緯度")
							}
						});
					});
				}

				async function initialize() {
					var myLatLng = await addressToLatLng(element.address);
				    var mapProp = {
				        center: myLatLng,
				        zoom: 20,
				        scrollwheel: false,
				        // draggable: false,
						styles: [{
							"stylers": [{
								"hue": "#ff1a00"
							}, {
								"invert_lightness": true
							}, {
								"saturation": -100
							}, {
								"lightness": 33
							}, {
								"gamma": 0.5
							}]
						}, {
							"featureType": "water",
							"elementType": "geometry",
							"stylers": [{
								"color": "#2d333c"
							}]
						}],
				        mapTypeId: google.maps.MapTypeId.ROADMAP
				    }

			    	var map = new google.maps.Map($map[index], mapProp);

				    var svg = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="15px" viewBox="0 0 12 22.2" style="enable-background:new 0 0 12 22.2;" xml:space="preserve"> <g> <path class="st0" fill="#fff" d="M12,6c0,3.3-6,16.2-6,16.2S0,9.3,0,6s2.7-6,6-6S12,2.7,12,6z" /> <circle cx="6" cy="5.5" r="2.6" /> </g> </svg>';

				    var beachMarker = new google.maps.Marker({
				        position: myLatLng,
				        map: map,
				        icon: { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg) }
				    });
				}

				google.maps.event.addDomListener(window, 'load', initialize);
			});
		}
	})
</script>


<!-- 地址轉經緯度 + 地圖計算這區有幾個marker + marker filter + 自訂點了跳出說明框 -->
<ul class="store-catList row">
	<li class="column shrink current" data-cat="-1">全部據點</li>
	<li class="column shrink" data-cat="0">直營服務</li>
	<li class="column shrink" data-cat="1">合作店家</li>
</ul>

<script>
	$(function() {
		var markerCluster;
		var map;
		var markers = [];
		var geocoder = new google.maps.Geocoder();

		function initMap() {
			map = new google.maps.Map(document.getElementById('store-googleMap'), {
				zoom: 4,
				disableDefaultUI: false,
				// scrollwheel: false,
				styles: [{
				    stylers: [{
				        saturation: -100
				    }]
				}],
				// center: {
				// 	lat: 23.790390,
				// 	lng: 121.003835
				// }
			});

			var infoWindowContent = [
				[
					'<div class="info_content">' +
					'<div class="title">賓尚-大中廠</div>' +
					'<div class="content">07-3479899<br>高雄市左營區大中二路39之9號</div>' +
					'</div>'
				], [
					'<div class="info_content">' +
					'<div class="title">鯉魚王-紅色</div>' +
					'<div class="content">07-3479899<br>高雄市左營區大中二路39之9號</div>' +
					'</div>'
				], [
					'<div class="info_content">' +
					'<div class="title">賓尚-大中廠</div>' +
					'<div class="content">07-3479899<br>高雄市左營區大中二路39之9號</div>' +
					'</div>'
				]
			];

			var infoWindow = new google.maps.InfoWindow();

			// set marker image
			var images = ['images/contact-mapicon-red.png', 'images/contact-mapicon-yellow.png'];

			var locations = [{
				address: '台北市',
				lat: 25.0329694,
				lng: 121.56541770000001,
				cat: 0
			}, {
				address: '台中市',
				lat: 24.1477358,
				lng: 120.6736482,
				cat: 1
			}, {
				address: '台南市',
				lat: 24.1477358,
				lng: 120.6736482,
				cat: 1
			}]

			for (i = 0; i < locations.length; i++) {
				var _address = locations[i].address;
				var _image = images[locations[i].cat];
				var _cat = locations[i].cat;
				var _index = i;
				geocodeAddress(geocoder, map, _address, _image, _index, _cat);
			}

			var delayGeocodes = 1;

			// 地址轉經緯度
			function geocodeAddress(geocoder, resultsMap, address, image, index, cat) {
				geocoder.geocode({'address': address}, function(results, status) {
					if (status === 'OK') {

						// Add some markers to the map.
						var marker = new google.maps.Marker({
							map: resultsMap,
							icon: image,
							cat: cat,
							position: results[0].geometry.location
						});

						// set map center
						resultsMap.setCenter(results[0].geometry.location);

						// marker 另存一個陣列
						markers.push(marker);

						// 計算這區有幾個marker
						markerCluster.addMarker(marker);

						// Allow each marker to have an info window
						google.maps.event.addListener(marker, 'click', (function(marker, i) {
							return function() {
								infoWindow.setContent(infoWindowContent[i][0]);
								infoWindow.open(map, marker);
							}
						})(marker, index));

						// trigger event (let infoWindow open at beginning)
						// new google.maps.event.trigger( marker, 'click' );

					} else {

						if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {

							setTimeout(function () {
								var _address = locations[index].address;
								var _image = (locations[index].cat == 7) ? images[0] : images[1];
								var _cat = locations[index].cat;
								var _index = index;
								geocodeAddress(geocoder, map, _address, _image, _index, _cat);
							}, delayGeocodes * 50)

							delayGeocodes += 1;

						}else{
							console.log('Geocode was not successful for the following reason: ' + status)
						}
					}
				});
			}

			// 計算這區有幾個marker
			var clusterStyles = [{
				url: 'images/markerclusterer1.png',
				height: 30,
				width: 30
			}];

			var mcOptions = {
				styles: clusterStyles,
			};

			markerCluster = new MarkerClusterer(map, markers, mcOptions);
		}

		initMap();

		// markers filter
		function filterMarkers (category) {
			markerCluster.clearMarkers();

			for (i = 0; i < markers.length; i++) {
		        if (markers[i].cat == category || category === -1) {
		        	markers[i].setVisible(true);
		        	markerCluster.addMarker(markers[i]);
		        } else {
		        	markers[i].setVisible(false);
		        	markerCluster.removeMarker(markers[i]);
		        }
		    }
		}

		$(".store-catList li").on("click", function (){
			$(this).addClass("current").siblings().removeClass("current")
			filterMarkers($(this).data("cat"))
		})
	})
</script>


<!-- 有自訂的放大縮小 -->
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