<!-- both rotate to right -->
<style>
	&.is-open{
		.plus:before{
			transform: translate(-50%,-50%) rotate(180deg);
			opacity: 0;
		}
		.plus:after{
			transform: translate(-50%,-50%) rotate(270deg);
		}
	}
	.plus{
		display: inline-block;
		vertical-align: middle;
		margin-right: 5px;
		position: relative;
		top: -1px;
		width: 6px;
		height: 8px;
		&:before, &:after{
			content: '';
			display: block;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%) rotate(0deg);
			background-color: #6cc04a;
			transition: all 0.5s;
		}
		&:before{
			width: 100%;
			height: 2px;
		}
		&:after{
			width: 2px;
			height: 100%;
		}
	}
</style>