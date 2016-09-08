<?php
function creatSet($title, $menuType){
	$addList = $menuType."_list.php";
	echo "<a href=\"".$addList."\" class=\"submenu\"><img src=\"../cms/image/table.gif\" width=\"16\" height=\"16\" border=\"0\" align=\"absbottom\">".$title."設定</a>&nbsp;&nbsp;";
}
function creatList($title, $menuType){
	$addList = $menuType."_list.php";
	echo "<a href=\"".$addList."\" class=\"submenu\"><img src=\"../cms/image/table.gif\" width=\"16\" height=\"16\" border=\"0\" align=\"absbottom\">".$title."列表</a>&nbsp;&nbsp;";
}
function creatAdd($title, $menuType){
	$addTxt = $menuType."_add.php";
	echo "<a href='".$addTxt."'class=\"submenu\"><img src='../cms/image/add.png' width='16' height='16' border='0' align='absbottom'>新增".$title."</a>&nbsp;&nbsp;";
}
function creatAll($title, $menuType){
	$addList = $menuType."_list.php";
	$addTxt = $menuType."_add.php";
	//echo "<a href='".$addList."'><img src='../cms/image/table.gif' width='16' height='16' border='0' align='absbottom'></a><a href='".$addList."' class='submenu'>".$title."列表</a>&nbsp;&nbsp;<a href='".$addTxt."'><img src='../cms/image/add.png' width='16' height='16' border='0' align='absbottom'></a><a href='".$addTxt."' class='submenu'>新增".$title."</a>&nbsp;&nbsp;";
	echo "<a href='".$addList."' class='submenu'><img src='../cms/image/table.gif' width='16' height='16' border='0' align='absbottom'>".$title."列表</a>&nbsp;&nbsp;<a href='".$addTxt."' class='submenu'><img src='../cms/image/add.png' width='16' height='16' border='0' align='absbottom'>新增".$title."</a>&nbsp;&nbsp;";
}
function creatTableTop(){
	echo "<table width='100%' height='25' border='0' align='center' cellpadding='3' cellspacing='0' bgcolor='#E4E4E4' ><tr><td width='10'></td><td align='left'>";
}
function creatTablBottom(){
	echo "</td></tr></table>";
}

/*var_dump($_SESSION['MM_Limit']);
if(in_array(3,$_SESSION['MM_Limit']['a2'])){
	echo 'inarray'	;
}else{
	echo "not";
}*/
require_once('primeFactors.php');
/*var_dump(primeFactors('20')); echo ' <= 2 <br>';
var_dump(primeFactors('3')); echo ' <= 3 <br>';
var_dump(primeFactors('5')); echo ' <= 5 <br>';
var_dump(primeFactors('7')); echo ' <= 7 <br>';

$tmp = primeFactors('20');
echo count($tmp).'<br>';
if(primeFactors('7')){
	echo 'have array';
}else{
	echo 'no array';
}*/
?>
<script src="js/menu.js?0.1"></script> 
<div id="cmsMenu">
	<ul>
    	<?php if(in_array(3,$_SESSION['MM_Limit']['a2'])){//首頁設定 indexSet banners?>
     	<li id="main_menu_2" class="main_menu">
     		<a href="javascript:adminSiteLink(2)"><div>首頁設定</div></a>
     	</li>
     	<?php } ?>
     	<?php if(in_array(3,$_SESSION['MM_Limit']['a3'])){//關於四季-創辦人 about?>
     	<li id="main_menu_3" class="main_menu">
     		<a href="javascript:adminSiteLink(3)"><div>關於四季-創辦人</div></a>
     	</li>
	 	<?php } ?>
     	<?php if(in_array(3,$_SESSION['MM_Limit']['a4'])){//關於四季-我們的故事 story?>
     	<li id="main_menu_4" class="main_menu">
     		<a href="javascript:adminSiteLink(4)"><div>關於四季-我們的故事</div></a>
     	</li>
     	<?php } ?>
     	<?php if(in_array(3,$_SESSION['MM_Limit']['a11'])){//關於四季-四季教育學院 schooleducation?>
     	<li id="main_menu_11" class="main_menu">
     		<a href="javascript:adminSiteLink(11)"><div>關於四季-四季教育學院</div></a>
     	</li>
     	<?php } ?>
     	<?php if(in_array(3,$_SESSION['MM_Limit']['a5'])){//最新消息 news?>
     	<li id="main_menu_5" class="main_menu">
     		<a href="javascript:adminSiteLink(5)"><div>最新消息</div></a>
     	</li>
	 	<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a6'])){//課程分享 share?>
        <li id="main_menu_6" class="main_menu">
        	<a href="javascript:adminSiteLink(6)"><div>課程分享</div></a>
        </li>
		<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a7'])){//四季入學 characteristic?>
        <li id="main_menu_7" class="main_menu">
        	<a href="javascript:adminSiteLink(7)"><div>四季入學</div></a>
        </li>
		<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a8'])){//四季分校 branch?>
        <li id="main_menu_8" class="main_menu">
        	<a href="javascript:adminSiteLink(8)"><div>四季分校</div></a>
        </li>
		<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a12'])){//四季環境 environment?>
        <li id="main_menu_12" class="main_menu">
        	<a href="javascript:adminSiteLink(12)"><div>四季環境</div></a>
        </li>
		<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a9'])){//美術館 gallery?>
        <li id="main_menu_9" class="main_menu">
        	<a href="javascript:adminSiteLink(9)"><div>美術館</div></a>
        </li>
		<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a10'])){//其它設定 years?>
        <li id="main_menu_10" class="main_menu">
        	<a href="javascript:adminSiteLink(10)"><div>其它設定</div></a>
        </li>
		<?php } ?>

        <?php if((isset($_SESSION['MM_Limit']['a1'])) && (in_array(3,$_SESSION['MM_Limit']['a1']))){//權限管理?>
        <li id="main_menu_1" class="main_menu">
        	<a href="javascript:adminSiteLink(1)"><div>權限管理</div></a>
        </li>
        <?php } ?>
	</ul>
</div>    
<?php 
if($menu_is=="indexSet"){//首頁設定

	creatTableTop();
	if(in_array(3,$_SESSION['MM_Limit']['a2'])){
		creatList('首頁Banner', 'bannersHome');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a2'])){
		creatAdd('首頁Banner', 'bannersHome');
	}
	if(in_array(3,$_SESSION['MM_Limit']['a2'])){
		creatList('四季環境', 'indexEnvironment');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a2'])){
		creatAdd('四季環境', 'indexEnvironment');
	}

	if(in_array(0,$_SESSION['MM_Limit']['a2'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="about"){//關於四季-創辦人

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a3'])){
		creatList('創辦人簡介', 'about');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a3'])){
		creatAdd('創辦人簡介', 'about');
	}*/
	
	if(in_array(3,$_SESSION['MM_Limit']['a3'])){
		creatList('創辦人簡介 Banner', 'aboutBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a3'])){
		creatAdd('創辦人簡介 Banner', 'aboutBanner');
	}*/

	
	if(in_array(3,$_SESSION['MM_Limit']['a3'])){
		creatList('創辦人的話', 'founder');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a3'])){
		creatAdd('創辦人的話', 'founder');
	}
	
	if(in_array(3,$_SESSION['MM_Limit']['a3'])){
		creatList('創辦人的話 Banner', 'founderBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a3'])){
		creatAdd('創辦人的話 Banner', 'founderBanner');
	}*/
	
	if(in_array(0,$_SESSION['MM_Limit']['a3'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="story"){//關於四季-我們的故事 

	creatTableTop();

	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('四季LOGO', 'story');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('四季LOGO', 'story');
	}*/
	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('四季LOGO Banner', 'storyBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('四季LOGO Banner', 'storyBanner');
	}*/

	echo "<br>";

	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('創校理念', 'schoolidea');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('創校理念', 'schoolidea');
	}*/
	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('創校理念 Banner', 'schoolideaBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('創校理念 Banner', 'schoolideaBanner');
	}*/

	echo "<br>";

	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('創校歷史', 'schoolhistory');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('創校歷史', 'schoolhistory');
	}*/
	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('創校歷史 Banner', 'schoolhistoryBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('創校歷史 Banner', 'schoolhistoryBanner');
	}*/

	echo "<br>";

	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('外界肯定', 'schoolaward');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('外界肯定', 'schoolaward');
	}*/
	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('外界肯定 Banner', 'schoolawardBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('外界肯定 Banner', 'schoolawardBanner');
	}*/

	echo "<br>";

	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('大事記', 'schoolevent');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('大事記', 'schoolevent');
	}
	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('大事記 Banner', 'schooleventBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('大事記 Banner', 'schooleventBanner');
	}*/
	
	if(in_array(0,$_SESSION['MM_Limit']['a4'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="schooleducation"){//關於四季-四季教育學院 

	creatTableTop();

	if(in_array(3,$_SESSION['MM_Limit']['a11'])){
		creatList('四季教育學院', 'schooleducation');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a11'])){
		creatAdd('四季教育學院', 'schooleducation');
	}*/
	if(in_array(3,$_SESSION['MM_Limit']['a11'])){
		creatList('四季教育學院 Banner', 'schooleducationBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a11'])){
		creatAdd('四季教育學院 Banner', 'schooleducationBanner');
	}*/
	
	if(in_array(0,$_SESSION['MM_Limit']['a11'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="news"){//最新消息

	creatTableTop();

	if(in_array(3,$_SESSION['MM_Limit']['a5'])){
		creatList('最新消息', 'news');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a5'])){
		creatAdd('最新消息', 'news');
	}

	if(in_array(3,$_SESSION['MM_Limit']['a5'])){
		creatList('最新消息分類', 'newsC');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a5'])){
		creatAdd('最新消息分類', 'newsC');
	}

	if(in_array(3,$_SESSION['MM_Limit']['a5'])){
		creatList('最新消息 Banner', 'newsBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a5'])){
		creatAdd('最新消息 Banner', 'newsBanner');
	}*/
	
	if(in_array(0,$_SESSION['MM_Limit']['a5'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="share"){//課程分享

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a6'])){
		creatList('課程分享', 'share');
	}	
	if(in_array(2,$_SESSION['MM_Limit']['a6'])){
		creatAdd('課程分享', 'share');
	}

	if(in_array(3,$_SESSION['MM_Limit']['a6'])){
		creatList('課程分享 Banner', 'shareBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a6'])){
		creatAdd('課程分享 Banner', 'shareBanner');
	}*/

	if(in_array(0,$_SESSION['MM_Limit']['a6'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="characteristic"){//四季入學

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('招生說明', 'characteristic');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('招生說明', 'characteristic');
	}*/

	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('招生說明 Banner', 'characteristicBanner');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('招生說明 Banner', 'characteristicBanner');
	}

	echo "<br>";
	
	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('新生入園須知', 'notice');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('新生入園須知', 'notice');
	}*/

	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('新生入園須知 Banner', 'noticeBanner');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('新生入園須知 Banner', 'noticeBanner');
	}

	echo "<br>";
	
	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('幼兒接送', 'shuttle');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('幼兒接送', 'shuttle');
	}*/

	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('幼兒接送 Banner', 'shuttleBanner');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('幼兒接送 Banner', 'shuttleBanner');
	}

	echo "<br>";
	
	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('衛生與餐點', 'health');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('衛生與餐點', 'health');
	}*/

	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('衛生與餐點 Banner', 'healthBanner');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('衛生與餐點 Banner', 'healthBanner');
	}
	echo "<br>";
	
	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('請假與收退費', 'refund');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('請假與收退費', 'refund');
	}*/

	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('請假與收退費 Banner', 'refundBanner');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('請假與收退費 Banner', 'refundBanner');
	}


	echo "<br>";

	if(in_array(0,$_SESSION['MM_Limit']['a7'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="branch"){//四季分校

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a8'])){
		creatList('四季分校', 'branch');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a8'])){
		creatAdd('四季分校', 'branch');
	}

	if(in_array(0,$_SESSION['MM_Limit']['a8'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="environment"){//四季環境

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a12'])){
		creatList('接近自然的戶外空間', 'environment');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a12'])){
		creatAdd('接近自然的戶外空間', 'environment');
	}
	if(in_array(3,$_SESSION['MM_Limit']['a12'])){
		creatList('接近自然的戶外空間 Banner', 'environmentBanner');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a12'])){
		creatAdd('接近自然的戶外空間 Banner', 'environmentBanner');
	}

	echo '<br>';
	
	if(in_array(3,$_SESSION['MM_Limit']['a12'])){
		creatList('人文的環境', 'environment2');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a12'])){
		creatAdd('人文的環境', 'environment2');
	}
	if(in_array(3,$_SESSION['MM_Limit']['a12'])){
		creatList('人文的環境 Banner', 'environmentBanner2');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a12'])){
		creatAdd('人文的環境 Banner', 'environmentBanner2');
	}

	echo '<br>';
	
	if(in_array(3,$_SESSION['MM_Limit']['a12'])){
		creatList('寬敞、舒適、安全、衛生', 'environment3');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a12'])){
		creatAdd('寬敞、舒適、安全、衛生', 'environment3');
	}
	if(in_array(3,$_SESSION['MM_Limit']['a12'])){
		creatList('寬敞、舒適、安全、衛生 Banner', 'environmentBanner3');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a12'])){
		creatAdd('寬敞、舒適、安全、衛生 Banner', 'environmentBanner3');
	}

	echo '<br>';
	//五校環境美學
	
	if(in_array(3,$_SESSION['MM_Limit']['a12'])){
		creatList('五校環境美學', 'environment4');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a12'])){
		creatAdd('五校環境美學', 'environment4');
	}
	if(in_array(3,$_SESSION['MM_Limit']['a12'])){
		creatList('五校環境美學 Banner', 'environmentBanner4');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a12'])){
		creatAdd('五校環境美學 Banner', 'environmentBanner4');
	}

	if(in_array(0,$_SESSION['MM_Limit']['a12'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="gallery"){//線上兒童美術館

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a9'])){
		creatList('美術館', 'gallery');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a9'])){
		creatAdd('美術館', 'gallery');
	}
	
	if(in_array(3,$_SESSION['MM_Limit']['a9'])){
		creatList('美術館 Banner', 'galleryBanner');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a9'])){
		creatAdd('美術館 Banner', 'galleryBanner');
	}
	//creatList('雜談', 'blabla');
	if(in_array(0,$_SESSION['MM_Limit']['a9'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="otherSet"){//其它設定

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a10'])){
		creatList('年份', 'years');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a10'])){
		creatAdd('年份', 'years');
	}

	if(in_array(3,$_SESSION['MM_Limit']['a10'])){
		creatList('關鍵字與描述', 'keywords');
	}

	if(in_array(0,$_SESSION['MM_Limit']['a10'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="authority"){
	
	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a1'])){
		creatList('管理員', 'authority');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a1'])){
		creatAdd('管理員', 'authority');
	}	
	if(in_array(3,$_SESSION['MM_Limit']['a1'])){
		creatList('權限管理群組', 'authorityC');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a1'])){
		creatAdd('權限管理群組', 'authorityC');
	}
	
	//creatAll('管理員', 'authority');
	//creatAll('權限管理群組', 'authorityC');
	if(in_array(0,$_SESSION['MM_Limit']['a1'])){header("Location:first.php");}
	creatTablBottom();

}
?>

<div style="clear:both; height:20px;"></div>