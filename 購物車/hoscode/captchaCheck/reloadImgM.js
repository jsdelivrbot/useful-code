function reloadImg(ci){
	//var sNewUrl = $("#rand-img").attr("src") + "?rnd=" + Math.random();
	//$("#rand-img").attr("src", sNewUrl);

	$("#rand-img").attr("src", '../captchaCheck/check/showrandimgM.php');
}
$(document).ready(function() {
	$(".reload-img").click(function(){
		$(this).data('ci');
		reloadImg($(this).data('ci'));
		return false;
	});
});