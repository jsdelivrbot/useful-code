add down below at line 296:
Pace.trigger('update', this.progress);

<script src="js/pace.js"></script>

<script>
	Pace.on("update", function(percent){
		console.log(percent)
	});
</script>