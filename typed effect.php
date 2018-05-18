https://github.com/mattboldt/typed.js

<style>
	.type-container{
		z-index: 99;
		position: fixed;
		top: 500px;
		left: 500px;
		.type{}
		/* Cursor */
		.typed-cursor {
			animation: typed-cursor 1s infinite;
		}
		@keyframes typed-cursor{
			0%{
				opacity: 1;
			}
			50%{
				opacity: 0;
			}
			100%{
				opacity: 1;
			}
		}
		/* If fade out option is set */
		.typed-fade-out {
			opacity: 0;
			transition: all .25s;
		}
	}
</style>

<div id="type-container">
	<span id="type"></span>
</div>

<script>
	import Typed from 'typed.js'

	var typed = new Typed(".type", {
		strings: [
			"website is under construction",
			"We do Architecture"
		],
		loop: true,
		fadeOut: false,
		typeSpeed: 100,
		backSpeed: 50,
		backDelay: 500,
		startDelay: 1000,
		cursorChar: '_',
	});
</script>