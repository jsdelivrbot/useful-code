<script src="js/jquery.validate.min.js"></script>

<script src="js/jquery.tooltipster.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/tooltipster.css">


<form id="messageForm" method="post" action="">
	<div class="leave">
		<div class="wantMessage">我要留言</div>

		<ul class="messageData">
			<li>
				<span class="dataTitle justify">姓名</span>：
				<input type="text" class="messageText" name="m_name" required>
				<input type="radio" id="sir" name="gender">
				<label for="sir">先生</label>
				<input type="radio" id="miss" name="gender">
				<label for="miss">小姐</label>
			</li>
			<li>
				<span class="dataTitle justify">電子郵件</span>：
				<input type="text" class="messageText medium" name="m_email" required>
			</li>
			<li>
				<span class="dataTitle justify">聯絡電話</span>：
				<input type="text" class="messageText medium" name="m_number" required>
				(格式：0412345678)
			</li>
			<li class="zap" data-mt="30">
				<a href="javascript:;" class="btn zap" data-mr="24" data-ml="480" id="clear">清除</a>
				<a href="javascript:;" class="btn" id="send">送出</a>
			</li>
		</ul>
	</div><!-- leave end -->
</form>

<script type="text/javascript">

	$('#dataForm :input[type=checkbox]').tooltipster({
       trigger: 'custom', // default is 'hover' which is no good here
       onlyOne: false,    // allow multiple tips to be open at a time
       position: 'left',  // display the tips to the right of the element
       theme: 'ryderisgood',
       offsetX: -20,
       offsetY: -20
   });

	$('#messageForm input[type="text"]').tooltipster({
       trigger: 'custom', // default is 'hover' which is no good here
       onlyOne: false,    // allow multiple tips to be open at a time
       position: 'top',  // display the tips to the right of the element
       theme: 'ryderisgood',
   });

	$("#messageForm").validate({
		ignore:[],
		// rules:{
		// 	m_email	: {
		// 		required: true,
		// 		email: true
		// 	},
		// m_checkword: {
		// 		equalTo: "#code"
		// 	}
		// },
		// messages: {
		// 	m_name: {
		// 		required: "必填欄位"
		// 	},
		// 	m_email	: {
		// 		required: "必填欄位"
		// 	},
		// m_checkword: {
		// 		equalTo: "驗證碼有分大小寫"
		// 	}
		// },
		errorPlacement: function (error, element) {
			$(element).tooltipster('update', $(error).text());
			$(element).tooltipster('show');
		},
		success: function (label, element) {
			$(element).tooltipster('hide');
		}
	})


	$("#send").click(function() {
		// console.log($("#messageForm").valid());
		// if($("#messageForm").valid()==true){
		// 	$("#insertC").val(1);
		// }
		$("#messageForm").submit();
	});

</script>


<style>
	.ryderisgood {
		border-radius: 5px;
		border: 1px solid #000;
		background: #4c4c4c;
		color: #fff;
	}
	.ryderisgood .tooltipster-content {
		font-family: @content-family;
		font-size: 15px;
		line-height: 20px;
		letter-spacing: 1px;
		padding: 8px 10px;
		overflow: hidden;
	}
</style>