<style>
	#canvas{
		position: absolute;
		-webkit-filter: url("#goo");
		filter: url("#goo");
	}
</style>

<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
	<defs>
		<filter id="goo">
			<feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
			<feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 60 -9"/>
		</filter>
	</defs>
</svg>