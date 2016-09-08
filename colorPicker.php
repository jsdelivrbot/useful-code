<script src="js/bootstrap-colorpicker-master/dist/js/bootstrap-colorpicker.js"></script>
<link rel="stylesheet" href="js/bootstrap-colorpicker-master/dist/css/bootstrap-colorpicker.css">
<style>
	.dropdown-menu {
		position: absolute;
		top: 100%;
		left: 0;
		z-index: 1000;
		display: none;
		float: left;
		min-width: 160px;
		padding: 5px 0;
		margin: 2px 0 0;
		font-size: 14px;
		text-align: left;
		list-style: none;
		background-color: #fff;
		-webkit-background-clip: padding-box;
		background-clip: padding-box;
		border: 1px solid #ccc;
		border: 1px solid rgba(0,0,0,.15);
		border-radius: 4px;
		-webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
		box-shadow: 0 6px 12px rgba(0,0,0,.175);
	}
</style>


<input type="text" class="demo1" value="#5367ce"/>


<script>
	$('.demo1').colorpicker();
	$('.demo1').colorpicker().on('changeColor', function(event){
		console.log($(".demo1").val());
	});
</script>