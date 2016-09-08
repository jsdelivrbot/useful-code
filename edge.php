
<script>

	// insert code here
	$(window).scroll(function(e){
		adtop = $(document).scrollTop();
		if( adtop > 1000 ){
			sym.play();
		}else{
			sym.stop();
		}
	});

</script>


<!-- happy -->
<script src="js/jquery.waypoints.min.js"></script>
<script type="text/javascript" charset="utf-8" src="edge_includes/edge.5.0.1.min.js"></script>

<script>
	AdobeEdge.loadComposition('area4', 'EDGE-1119398011', {
		scaleToFit: "none",
		centerStage: "none",
		minW: "0",
		maxW: "undefined",
		width: "642px",
		height: "197px"
	}, {"dom":{}}, {"dom":{}});


	AdobeEdge.bootstrapCallback(function(compId) {
  ///// make the reference to the specific composition
  AdobeEdge.getComposition("area2").getStage().stop(0);
  AdobeEdge.getComposition("EDGE-1119398011").getStage().stop(0);
  AdobeEdge.getComposition("EDGE-1131589458").getStage().stop(0);
  AdobeEdge.getComposition("EDGE-1133503904").getStage().stop(0);

});
</script>


<script>

	$(window).load(function()
	{
		setTimeout(function(){

			$('.foearea2').waypoint(function(direction) {
				AdobeEdge.getComposition("area2").getStage().play(0);
			}, {
				offset: $(this).height()
			});
			$('.foearea2').waypoint(function(direction) {
				AdobeEdge.getComposition("area2").getStage().play(0);
			});

			$('.forarea4').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1119398011").getStage().play(0);
			}, {
				offset: '70%'
			});
			$('.forarea4').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1119398011").getStage().play(0);
			});

			$('.forarea5').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1131589458").getStage().play(0);
			}, {
				offset: '70%'
			});
			$('.forarea5').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1131589458").getStage().play(0);
			});

			$('.forarea6').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1133503904").getStage().play(0);
			}, {
				offset: '70%'
			});
			$('.forarea6').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1133503904").getStage().play(0);
			});
			$('.forarea7').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1134816183").getStage().play(0);
			}, {
				offset: '70%'
			});
			$('.forarea7').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1134816183").getStage().play(0);
			});
			$('.forarea8').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1137467302").getStage().play(0);
			}, {
				offset: '70%'
			});
			$('.forarea8').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1137467302").getStage().play(0);
			});
			$('.forarea9').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1138692325").getStage().play(0);
			}, {
				offset: '70%'
			});
			$('.forarea9').waypoint(function(direction) {
				AdobeEdge.getComposition("EDGE-1138692325").getStage().play(0);
			});

		}, 500);

});

</script>
