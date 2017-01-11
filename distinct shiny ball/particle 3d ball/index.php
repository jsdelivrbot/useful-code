<canvas id="is2-canvas"></canvas>

<script>
	var is2_particle=new Ryder3dParticle({
		el: document.getElementById('is2-canvas'),
		number: 1000,
		horizon: 150,
		verticle: 500
	});

	// 使用
	is2_particle.UpdateParticles();
	// 停止
	is2_particle.cancelanimation();
</script>