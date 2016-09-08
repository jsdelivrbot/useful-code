<!--=================================
=            bootstrap            =
=================================-->

<link rel="stylesheet" href="js/bootstrap-datepicker/css/datepicker3.css">
<script src="js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
	$('#m_birthday').datepicker({
		format: "yyyy/mm/dd",
		language: "zh-TW",
		autoclose: true,
		todayHighlight: true
	});

	// getFormattedDate
	var picker = $('.arrivalTimePic').datepicker({
		format: "yyyy/mm/dd",
		language: "zh-TW",
		autoclose: true,
		todayHighlight: true
	});
	picker.on("changeDate", function(e) {
		var value = $(this).data('datepicker').getFormattedDate('yyyy/mm/dd');
		$("#m_time").val(value);
	});

</script>


<!--==============================
=            jquery            =
==============================-->

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<input type="text" class="datepicker">


<script type="text/javascript">
	$(".datepicker").datepicker({dateFormat:"yy年mm月dd日"});
</script>