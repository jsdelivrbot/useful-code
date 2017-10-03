<input type="text" id="T1" size="20" value="<?= $row_Recrooms_vr['file_link1'] ?>" style="display: none;"/>
<iframe id="iframe" src="ryder_vr.php" width="100%" height="308" frameborder="0" scrolling="no"></iframe>



<!-- ryder_vr.php -->
<html>
<head>
	<script src="http://threejs.org/build/three.min.js"></script>
	<script src="js/OrbitControls.js"></script>
	<script src="js/Detector.js"></script>
</head>
<body>
</body>
</html>

<script>
	var scene = new THREE.Scene();

	var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 1000);
	camera.position.x = 0.1;

	var renderer = Detector.webgl ? new THREE.WebGLRenderer() : new THREE.CanvasRenderer();
	renderer.setSize(window.innerWidth, window.innerHeight);

	var _vr_dir=parent.document.getElementById("T1").value;
	var sphere = new THREE.Mesh(
		new THREE.SphereGeometry(100, 20, 20),
		new THREE.MeshBasicMaterial({
			map: THREE.ImageUtils.loadTexture(_vr_dir)
		})
		);
	sphere.scale.x = -1;
	scene.add(sphere);

	var controls = new THREE.OrbitControls(camera);
	controls.noPan = true;
	controls.noZoom = true;
	controls.autoRotate = true;
	controls.autoRotateSpeed = 0.5;

	document.body.appendChild(renderer.domElement);

	render();

	function render() {
		controls.update();
		requestAnimationFrame(render);
		renderer.render(scene, camera);
	}

	function onMouseWheel(event) {
		event.preventDefault();

		if (event.wheelDeltaY) {
			// WebKit
			camera.fov -= event.wheelDeltaY * 0.05;
		} else if (event.wheelDelta) {
			// Opera / IE9
			camera.fov -= event.wheelDelta * 0.05;
		} else if (event.detail) {
			// Firefox
			camera.fov += event.detail * 1.0;
		}

		camera.fov = Math.max(40, Math.min(100, camera.fov));
		camera.updateProjectionMatrix();
	}

	document.addEventListener('mousewheel', onMouseWheel, false);
</script>
