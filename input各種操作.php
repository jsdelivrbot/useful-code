<script type="text/javascript">

	$('input[name="abroad"]').change(function  () {
		if ($(this).prop("checked") == true) {
			$("#abroadToggle").show();
		} else{
			$("#abroadToggle").hide();
		};
	});

	// 設定value 式
	if($('input[name="invoice"]:checked').val() == 3){
		//code here
	}

	// jquery 不可勾選
	$("#wantInvoiceBox").attr("onclick","return false;");
	//取消
	$("#wantInvoiceBox").removeAttr("onclick");


	// onblur
	$(".input").on("blur",function () {
		$(".pwdWrap").fadeOut(800);
		$(this).val('');
	})

	// enter事件
	$(".input").keypress(function(e){
		code = (e.keyCode ? e.keyCode : e.which);
		if (code == 13)
		{
			// $("targetForm").submit();
			alert("表單已送出   才怪咧");
			$(".pwdWrap").fadeOut(800);
		}
	});
</script>