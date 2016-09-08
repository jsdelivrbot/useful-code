<link href="css/forpace.css" rel="stylesheet" />    <!-- 去官網可用現成 -->
<script data-pace-options='{ "ajax": false , "startOnPageLoad": false}' src='js/pace.js'></script>

<script type="text/javascript">
	// paceOptions = {
	//   ajax: false,
	//   document: false,
	//   eventLag: false,
	//   restartOnPushState: false,
	//   restartOnRequestAfter: false,
	//   elements: {
	//     selectors: ['body']
	//   }
	// };
	Pace.start();
</script>

<script type="text/javascript">
	$(window).load(function() {
		$('#paceblock').fadeOut('slow');
		Pace.stop();
	}
</script>