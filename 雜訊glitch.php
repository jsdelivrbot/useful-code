<!-- scss -->
<style>
	@include keyframes(noise-anim){
		$steps:20;
		@for $i from 0 through $steps{
			#{percentage($i*(1/$steps))}{
				clip:rect(random(100)+px,9999px,random(120)+px,0);
			}
		}
	};
	@include keyframes(noise-anim-2){
		$steps:20;
		@for $i from 0 through $steps{
			#{percentage($i*(1/$steps))}{
				clip:rect(random(100)+px,9999px,random(120)+px,0);
			}
		}
	};
	#glitch{
		position: relative;
	}
	#glitch:after{
		content:attr(data-text);
		position:absolute;
		left:2px;
		text-shadow:-1px 0 red;
		top:0;
		color:$black;
		overflow:hidden;
		animation:noise-anim 2s infinite linear alternate-reverse;
	}
	#glitch:before{
		content:attr(data-text);
		position:absolute;
		left:-2px;
		text-shadow:1px 0 blue;
		top:0;
		color:$black;
		overflow:hidden;
		animation:noise-anim-2 3s infinite linear alternate-reverse;
	}
</style>

<div class="en" id="glitch" data-text="Portfolio">Portfolio</div>