<img src="" id="output">

<script src="js/gif.js"></script>

<script>
	var gif = new GIF({
	    workers: 2,
	    quality: 200,
	    workerScript: "js/gif.worker.js",
	    debug: true
	});

	var imgList = [
	    'images/maze-1.jpg',
	    'images/maze-2.jpg',
	    'images/maze-3.jpg',
	    'images/maze-4.jpg',
	    'images/maze-5.jpg',
	];

	var fetchImg = imgList.map((resource) => {
	    return new Promise((resolve, reject) => {
	        var tmp = new Image();
	        tmp.src = resource;
	        tmp.onload = () => {
	        	gif.addFrame(tmp);
	        	resolve(tmp);
	        };
	    });
	});

	Promise.all(fetchImg).then(() => {
		gif.render();
	})

	gif.on('finished', function(blob) {
	    document.getElementById('output').src = URL.createObjectURL(blob);
	});
</script>