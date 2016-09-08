/**
*
* 利用空白調整
*
*/

<span>回 首 頁</span>
<style>
	span{
		word-spacing:23px;
		white-space:nowrap;
		text-indent: -22px; //修正手機位移問題
	}
</style>


/**
*
* 用在span記得調整vertical-align
* 只有chrome有效  弱弱der...........
*
*/

<style type="text/css">
	.justify {
		　text-align: justify;
		　text-justify: inter-ideograph;
		　-ms-text-justify: inter-ideograph; /*IE9*/
		　-moz-text-align-last:justify; /*Firefox*/
		　-webkit-text-align-last:justify; /*Chrome*/
	}
	.justify:after {
		　content: '';
		　display: inline-block;
		　width: 100%;
	}
</style>

