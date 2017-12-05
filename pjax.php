pjax
djax

barba.js
smoothstate.js

https://codyhouse.co/gem/animated-page-transition/

<!-- barba.js -->
<script>
	import Barba from 'barba.js';

	Barba.Pjax.init();

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
			this.done();

			TweenMax.to( $("#transformWrap .logo"), 0.5, {
				opacity: 0,
				delay: 0.5,
				onComplete() {
					_transform.reverse();
				}
			});
		}
	})

	Barba.Pjax.getTransition = () => BigFatLp;
</script>