
<script>
	// 求兩個時間的天數差 日期格式為 YYYY-MM-dd
	function daysBetween(DateOne,DateTwo)
	{
		var OneMonth = DateOne.substring(5,DateOne.lastIndexOf ('-'));
		var OneDay = DateOne.substring(DateOne.length,DateOne.lastIndexOf ('-')+1);
		var OneYear = DateOne.substring(0,DateOne.indexOf ('-'));

		var TwoMonth = DateTwo.substring(5,DateTwo.lastIndexOf ('-'));
		var TwoDay = DateTwo.substring(DateTwo.length,DateTwo.lastIndexOf ('-')+1);
		var TwoYear = DateTwo.substring(0,DateTwo.indexOf ('-'));

		var cha=((Date.parse(OneMonth+'/'+OneDay+'/'+OneYear)- Date.parse(TwoMonth+'/'+TwoDay+'/'+TwoYear))/86400000);
		return Math.abs(cha);
	}


	//格式化  (取現在時間  並非傳入一個值然後格式化)
	Date.prototype.Format = function (fmt) {
		var o = {
			"M+": this.getMonth() + 1,
			"d+": this.getDate(),
			"h+": this.getHours(),
			"m+": this.getMinutes(),
			"s+": this.getSeconds(),
			"q+": Math.floor((this.getMonth() + 3) / 3),
			"S": this.getMilliseconds()
		};
		if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
		for (var k in o)
			if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
		return fmt;
	}
	var _date = new Date().Format("yyyy-MM-dd");
</script>