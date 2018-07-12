pjax
djax

barba.js
smoothstate.js

https://codyhouse.co/gem/animated-page-transition/

<!-- barba.js -->
<template lang="pug">
	#barba-wrapper
		.barba-container(data-namespace="products")
</template>

<script>
	import Barba from 'barba.js';

	const Technic = Barba.BaseView.extend({
		namespace: 'technic',
		onEnter() {},
		onEnterCompleted() {
			setTimeout(function () {
				$.getScript('dist/technic.js');
				$.getScript('js/jquery.parallax-scroll.js');
			}, 1000)
		},
		onLeave() {},
		onLeaveCompleted() {}
	}).init();

	Barba.Pjax.init();

	Barba.Dispatcher.on('newPageReady', (currentStatus, oldStatus, container) => {
		$('.lazy').lazy({
			chainable: false,
			effect: "fadeIn",
			effectTime: 1000,
			// defaultImage: 'images/lazy-default.svg',
		});
	});

	const BigFatLp = Barba.BaseTransition.extend({
		async start() {
			await this.newContainerLoading;
			await this.fadeOut();
			this.fadeIn();
		},
		fadeOut() {
			let deferred = Barba.Utils.deferred();

			TweenMax.to( $("#transformWrap .logo"), 0.5, {
				opacity: 1,
				onComplete() {
					deferred.resolve();
				}
			});

			return deferred.promise;
		},
		fadeIn() {
			TweenMax.to( $("#transformWrap .logo"), 0.5, {
				opacity: 0,
				delay: 0.5,
				onComplete() {
					_transform.reverse();
				}
			});

			window.scroll(0, 0);
			this.done();
		}
	})

	Barba.Pjax.getTransition = () => BigFatLp;
</script>

<!-- a simple and easy jQuery plugin for CSS animated page transitions -->
https://github.com/blivesta/animsition

<!-- 最好放在最上面 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/css/animsition.css">

<body class="animsition">
	<a href="detail.php" class="animsition-link"></a>
</body>

<script>
	$(".animsition").animsition({
		inClass: 'fade-in',
		outClass: 'fade-out',
		inDuration: 1500,
		outDuration: 800,
		transition(url){
			window.location.href = url;
			if (location.href.indexOf(url) != -1 && url.indexOf("#") != -1) {
				$("body").animsition('in');
			}
		}
	});
</script>