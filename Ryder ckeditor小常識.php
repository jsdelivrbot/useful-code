<!--=============================
=            預覽功能            =
==============================-->
<!-- cms\ckeditor\config.js -->
<script>
	// 先新增id
	config.bodyId = 'contents_id';
</script>

<!-- cms\ckeditor\contents.css -->
<style>
	/*cms*/
	/*#contents_id[contenteditable]*/
	#contents_id[contenteditable] strong{
		display: block;
	    font-weight: 700;
	    font-size: 15px;
	    margin-bottom: 11px;
	}
	#contents_id[contenteditable] p{
		/*max-width: 790px;*/
		margin: 22px 0;
	}
	#contents_id[contenteditable] img{
		margin: 5px 0;
	}

	/*preview*/
	/*#contents_id:not([contenteditable])*/
	#contents_id:not([contenteditable]){
		max-width: 1120px;
		margin: 0 auto;
	}
	#contents_id:not([contenteditable]) strong{
		display: block;
	    font-weight: 700;
	    font-size: 15px;
	    margin-bottom: 11px;
	}
	#contents_id:not([contenteditable]) p{
		/*max-width: 790px;*/
		margin: 22px 0;
	}
	#contents_id:not([contenteditable]) img{
		margin: 5px 0;
		max-width: 100%;
		height: auto !important;
	}

	img{
		display: inline-block;	/*remove bottom space*/
		vertical-align: middle;
	}
</style>



<!--==============================================
=            ckeditor 自訂事件 (含範本)           =
===============================================-->
http://www.syscom.com.tw/ePaper_New_Content.aspx?id=631&EPID=240&TableName=sgEPArticle


<!--=============================
=            自訂樣版            =
==============================-->
D:\wamp64\www\bear\cms\ckeditor\config.js

<script>
	config.allowedContent = true;  //不然有些tag的class會不見
</script>

D:\wamp64\www\bear\cms\ckeditor\plugins\templates\templates\default.js

<script>
	CKEDITOR.addTemplates("default", {
		imagesPath: CKEDITOR.getUrl(CKEDITOR.plugins.getPath("templates") + "templates/images/"),
		templates: [{
	        //標題
	        title: '作品CREDIT',
	        image: 'default_image_s.jpg',//圖片
	        description: '作品CREDIT', //樣板描述
	        //自訂樣板內容
	        html: `
	        <ul class="creditList cell large-auto grid-x small-up-2 large-up-3">
	        	<li class="cell">
	        		<div class="name">Clident</div>
	        		<div class="ch">史上最潮有限公司</div>
	        		<div class="en">big tree crative</div>
	        	</li>
	        </ul>
	        `
	    }, {
			title: "Image and Title",
			image: "template1.gif",
			description: "One main image with a title and text that surround the image.",
			html: '\x3ch3\x3e\x3cimg src\x3d" " alt\x3d"" style\x3d"margin-right: 10px" height\x3d"100" width\x3d"100" align\x3d"left" /\x3eType the title here\x3c/h3\x3e\x3cp\x3eType the text here\x3c/p\x3e'
		}]
	});
</script>


<!--=================================
=           some config            =
==================================-->
<script>
	config.autoParagraph = false;  //關掉自動 <p> tag
</script>