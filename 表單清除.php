<script type="text/javascript">


	$("#clear").click(function  () {

		$(".leave").find(":text,textarea").each(function() {
			$(this).val("");
		});
		$(".leave").find(":radio").each(function() {
			$(this).attr("checked", false);
		});

	})


	//參考
	$(".leave").find(":input").each(function() {
		switch($(this).attr('type')){
			case 'radio':
			/* 取消所有選取 */
			$(this).attr("checked", false);
			case 'checkbox':
			/* 取消所有選取 */
			$(this).attr("checked", false);
			break;
			case 'select-one':
			/* 把 select 元件都歸到選第一項 */
			$(this)[0].selectedIndex = 0;
			break;
			case 'text':
			/* 清空 text 來欄位 */
			$(this).val("");
			break;
			case 'password':
			/* 清空 password 來欄位 */
			$(this).attr("value", "");
			case 'hidden':
	      /*
	      * 不清空 hidden，通常保純此欄位
	      */
	      case 'textarea':
	      /* 清空 textarea 來欄位 */
	      $(this).val("");
	      break;
	  }
	});

</script>