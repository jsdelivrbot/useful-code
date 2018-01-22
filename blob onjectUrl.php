https://juejin.im/entry/591841d70ce4630069f118e6?utm_medium=hao.caibaojian.com&utm_source=hao.caibaojian.com

<video id="video" playsinline autoplay muted></video>

<script>
	window.URL = window.URL || window.webkitURL;  // 兼容處理

	var xhr = new XMLHttpRequest();
	xhr.responseType = 'blob';
	xhr.open('GET', 'forever.mp4', true);
	xhr.onload = function() {
		if (this.status == 200) {
			let blob = this.response;
			let objectUrl = URL.createObjectURL(blob);
			let $video = document.getElementById("video");
			$video.src = objectUrl;
		}
	};
	xhr.send();
</script>