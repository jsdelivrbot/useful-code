

(function($) {
	$.fn.validationEngineLanguage = function() {};
	$.validationEngineLanguage = {
		newLang: function() {
			$.validationEngineLanguage.allRules = 	{"required":{    			// Add your regex rules here, you can take telephone as an example
						"regex":"none",
						"alertText":"* 请输入您的资料！",
						"alertTextCheckboxMultiple":"* ,请选择一个选项！",
						"alertTextCheckboxe":"* 此为必填之选项！"},
					"requiredC":{    			// Add your regex rules here, you can take telephone as an example
						"regex":"none",
						"alertText":"* 请输入验证码！"},
					"length":{
						"regex":"none",
						"alertText":"* 请输入 ",
						"alertText2":" 到 ",
						"alertText3": " 之间字元数！"},
					"maxCheckbox":{
						"regex":"none",
						"alertText":"* 所选择之选项，超出数量！"},	
					"minCheckbox":{
						"regex":"none",
						"alertText":"* 请选择",
						"alertText2":" 选项"},	
					"confirm":{
						"regex":"none",
						"alertText":"* 你所输入的密码有错误！"},		
					"telephone":{
						"regex":"/^[0-9\-\(\)\ ]+$/",
						"alertText":"* 无效的电话号码！"},	
					"email":{
						"regex":"/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/",
						"alertText":"* 无效的电子邮件！"},	
					"date":{
                         "regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
                         "alertText":"* 无效的日期，必须为 YYYY - MM - DD格式！"},
					"onlyNumber":{
						"regex":"/^[0-9\ ]+$/",
						"alertText":"* 只允许输入数字！"},	
					"noSpecialCaracters":{
						"regex":"/^[0-9a-zA-Z\-\_\ ]+$/",
						"alertText":"* 不允许特殊字元！"},	
					"ajaxUser":{
						"file":"flashJson/formValidator/validateUser.php",
						"extraData":"name=eric",
						"alertTextOk":"* 此帐号还没有被注册哦！",	
						"alertTextLoad":"* 读取中，请稍后！",
						"alertText":"* 此帐号已经被使用了哦！"},	
					"ajaxCaptcha":{
						"file":"flashJson/formValidator/validateCaptcha.php",
						"alertText":"* 输入的验证错误！",
						"alertTextOk":"* 输入的验证正确！",	
						"alertTextLoad":"* 读取中，请稍后！"},	
					"captchaCheck":{
						"regex":"/^[0-9a-zA-Z\-\_\ ]+$/",
						"alertText":"* 不允许特殊字元！"},	
					"onlyLetter":{
						"regex":"/^[a-zA-Z\ \']+$/",
						"alertText":"* Letters only"},
					"AllLetter":{
						"regex":"none",
						"alertText":"* 请输入姓名！"},
					"validate2fields":{
    					"nname":"validate2fields",
    					"alertText":"* 输入的验证错误！"}	
					}	
					
		}
	}
})(jQuery);

$(document).ready(function() {	
	$.validationEngineLanguage.newLang()
});