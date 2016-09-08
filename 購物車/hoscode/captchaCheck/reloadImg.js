function reloadImg(){
	var sNewUrl = $("#rand-img").attr("src") + "?rnd=" + Math.random();
	$("#rand-img").attr("src", sNewUrl);
}
$(document).ready(function() {
	$(".reload-img").click(function(){
		reloadImg();
		return false;
	});
});