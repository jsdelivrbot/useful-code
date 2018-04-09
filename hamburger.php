<!-- normal -->
<div class="hamburger">
	<span class="item1"></span>
	<span class="item2"></span>
	<span class="item3"></span>
</div>

<script>
	$(".hamburger").click(function () {
		$(this).toggleClass("hamburger-show");
	})
</script>

<style>
	.hamburger{
		width: 20px;
		height: 14px;
		position: absolute;
		top: 50%;
		right: 30px;
		margin-top: -7px;
		span{
			display: block;
			width: 100%;
			height: 2px;
			background-color: #515151;
		}
		.item1{
			position: absolute;
			top: 0;
			transition:transform 0.4s ,top 0.4s 0.4s;
		}
		.item2{
			position: absolute;
			top: 50%;
			transition: opacity 0.8s;
		}
		.item3{
			position: absolute;
			top: 100%;
			transition:transform 0.4s ,top 0.4s 0.4s;
		}
	}
	.hamburger-show{
		.item1{
			top: 50%;
			transform: rotate(45deg);
			transition: top 0.4s ,transform 0.4s 0.4s;
		}
		.item2{
			opacity: 0;
		}
		.item3{
			top: 50%;
			transform: rotate(-45deg);
			transition: top 0.4s ,transform 0.4s 0.4s;
		}
	}
</style>


<!-- 短中長 -->
<div class="hamburger">
	<span></span>
	<span></span>
	<span></span>
</div>

<style>
	.hamburger{
		width: 46px;
		height: 30px;
		position: relative;
		span{
			display: block;
			height: 2px;
			background-color: #e25423;
			position: absolute;
			right: 0;
			transition: all 0.7s;
			&:nth-child(1){
				top: 0;
				width: 33%;
			}
			&:nth-child(2){
				width: 66%;
				top: 50%;
			}
			&:nth-child(3){
				width: 100%;
				top: 100%;
			}
		}
		&:hover{
			span{
				&:nth-child(1){
					top: 0;
					width: 33%;
				}
				&:nth-child(2){
					width: 100%;
					top: 50%;
				}
				&:nth-child(3){
					width: 66%;
					top: 100%;
				}
			}
		}
	}
</style>