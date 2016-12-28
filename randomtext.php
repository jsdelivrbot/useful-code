<script src="js/jquery.shuffleLetters.js"></script>

<script>
	$(".ryder-deco-title").mouseenter(function () {
		$(".randomText").shuffleLetters({
			"step": 14,
			"fps": 19,
			"text" : ""
		});
	})
</script>

<!-- ================================================================= -->

<div class="ryder-passion"></div>
<div class="ryder-passion"></div>
<div class="ryder-passion"></div>

<script>
	$(".ryder-passion").each(function () {
		new RandomText($(this),{
			custom: "<span></span><span></span><span></span>",
			repeat: true
		});
	})

	function RandomText (el, options) {
		var _this=el;
		var theLetters = "qwertyuiopasdfghjklzxcvbnm";
		var speed = options.speed || 40;
		var increment = options.increment || 8;
		var si = 0;
		var stri = 0;
		var ctnt_array=[_this.text(), "creation", "money", "headsome"];
		var ctnt = ctnt_array[Math.floor(Math.random()*4)];
		var clen = ctnt.length;
		var time = clen * increment + 1;
		var block = "";
		var fixed = "";
		var custom = options.custom || "";
		var repeat = options.repeat || false;

		//Call self x times, whole function wrapped in setTimeout
		var rustle = function(i) {
			setTimeout(function() {
				if (--i) {
					rustle(i);
				}
				nextFrame(i);
				si = si + 1;
			}, speed);
		}

		function nextFrame(pos) {
			for (var i = 0; i < clen - stri; i++) {
				//Random number
				var num = Math.floor(theLetters.length * Math.random());
				//Get random letter
				var letter = theLetters.charAt(num);
				block = block + letter;
			}
			if (si == (increment - 1)) {
				stri++;
			}
			if (si == increment) {
				fixed = fixed + ctnt.charAt(stri - 1);
				si = 0;
			}
			_this.html(fixed + block + custom);
			block = "";
		}

		rustle(time);

		if (repeat) {
			setInterval(function () {
				// reset
				fixed = "";
				stri = 0;
				ctnt = ctnt_array[Math.floor(Math.random()*4)];
				clen = ctnt.length;

				rustle(time);
			},6000);
		}
	}
</script>