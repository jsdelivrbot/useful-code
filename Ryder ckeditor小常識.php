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