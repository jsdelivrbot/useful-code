<style type="text/css">
	.class:hover:{
		img{
			-webkit-filter: grayscale(0%);
			transition:all 1s;
			-webkit-transition:all 1s;
		}
	}
	img{
		mask: url(#theMask); /*for firefox 寫在前端php*/
		-webkit-mask-image: url(images/block.png);   /*圖片遮罩 for chrome*/
		-webkit-filter: grayscale(100%);
		transition:all 1s;
		-webkit-transition:all 1s;
	}


	/*div也可遮罩   圖片要變黑白之外的顏色可用*/
	.block{
		position: absolute;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		background-color: rgba(255,223,214,0.7);
		mask: url(#theMask); /*for firefox 寫在前端php*/
		-webkit-mask-image: url(images/smallmask.png); /*圖片遮罩 for chrome*/
		transition:all 0.6s;
		-webkit-transition:all 0.6s;
	}
	parents:hover{
		.block{
			background-color: transparent;
			transition:all 0.6s;
			-webkit-transition:all 0.6s;
		}
	}
</style>


<svg height="0" style="position:absolute">
	<defs>
		<mask id="theMask">
			<g>
				<path opacity="0.5" fill="#FFFFFF" stroke="#FFFFFF" stroke-width="0.8863" stroke-miterlimit="10" d="M16.047,330.404
				C6.748,228.508,105.146,85.735,143.72,13.854c9.059,102.244,132.622,206.456,99.725,312.19
				C217.721,408.752,95.3,472.418,34.233,383.401C23.489,367.726,17.829,349.799,16.047,330.404z"/>
			</g>
		</mask>
	</defs>
</svg>