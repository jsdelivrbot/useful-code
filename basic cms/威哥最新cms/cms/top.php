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
     	<?php if(in_array(3,$_SESSION['MM_Limit']['a3'])){//文章分類 articleT?>
     	<li id="main_menu_3" class="main_menu">
     		<a href="javascript:adminSiteLink(3)"><div>文章分類</div></a>
     	</li>
	 	<?php } ?>
     	<?php if(in_array(3,$_SESSION['MM_Limit']['a4'])){//文章 article?>
     	<li id="main_menu_4" class="main_menu">
     		<a href="javascript:adminSiteLink(4)"><div>文章</div></a>
     	</li>
     	<?php } ?>

     	<?php if(in_array(3,$_SESSION['MM_Limit']['a11'])){//文章標籤 articleTag?>
     	<li id="main_menu_11" class="main_menu">
     		<a href="javascript:adminSiteLink(11)"><div>文章標籤</div></a>
     	</li>
     	<?php } ?>

     	<?php if(in_array(3,$_SESSION['MM_Limit']['a5'])){//作者管理 author?>
     	<li id="main_menu_5" class="main_menu">
     		<a href="javascript:adminSiteLink(5)"><div>作者管理</div></a>
     	</li>
	 	<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a6'])){//活動 events?>
        <li id="main_menu_6" class="main_menu">
        	<a href="javascript:adminSiteLink(6)"><div>活動</div></a>
        </li>
		<?php } ?>

     	<?php if(in_array(3,$_SESSION['MM_Limit']['a8'])){//關於我們 about?>
     	<li id="main_menu_8" class="main_menu">
     		<a href="javascript:adminSiteLink(8)"><div>關於我們</div></a>
     	</li>
     	<?php } ?>

		<?php if(in_array(3,$_SESSION['MM_Limit']['a7'])){//森林夥伴 partner?>
        <li id="main_menu_7" class="main_menu">
        	<a href="javascript:adminSiteLink(7)"><div>森林夥伴</div></a>
        </li>
		<?php } ?>

     	<?php if(in_array(3,$_SESSION['MM_Limit']['a9'])){//版權聲明 clause?>
     	<li id="main_menu_9" class="main_menu">
     		<a href="javascript:adminSiteLink(9)"><div>版權聲明</div></a>
     	</li>
     	<?php } ?>

     	<?php if(in_array(3,$_SESSION['MM_Limit']['a10'])){//誠徵作家 weneedu?>
     	<li id="main_menu_10" class="main_menu">
     		<a href="javascript:adminSiteLink(10)"><div>誠徵作家</div></a>
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
if($menu_is=="banners"){//首頁設定

	creatTableTop();
	if(in_array(3,$_SESSION['MM_Limit']['a2'])){
		creatList('首頁Banner', 'bannersHome');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a2'])){
		creatAdd('首頁Banner', 'bannersHome');
	}

	if(in_array(3,$_SESSION['MM_Limit']['a2'])){
		creatList('首頁影片', 'indexVideo');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a2'])){
		creatAdd('首頁影片', 'indexVideo');
	}*/

	if(in_array(0,$_SESSION['MM_Limit']['a2'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="articleT"){//文章分類

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a3'])){
		creatList('文章分類', 'articleT');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a3'])){
		creatAdd('文章分類', 'articleT');
	}*/
	if(in_array(3,$_SESSION['MM_Limit']['a3'])){
		creatList('文章子分類', 'articleSubT');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a3'])){
		creatAdd('文章子分類', 'articleSubT');
	}

	if(in_array(3,$_SESSION['MM_Limit']['a3'])){
		creatList('分類列表頁banner', 'articleTBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a3'])){
		creatAdd('分類列表頁banner', 'articleTBanner');
	}*/
	if(in_array(3,$_SESSION['MM_Limit']['a3'])){
		creatList('分類內容頁banner', 'articleTContentBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a3'])){
		creatAdd('分類內容頁banner', 'articleTContentBanner');
	}*/

	
	if(in_array(0,$_SESSION['MM_Limit']['a3'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="article"){//文章 

	creatTableTop();

	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('文章', 'article');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('文章', 'article');
	}
	
	if(in_array(0,$_SESSION['MM_Limit']['a4'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="articleTag"){//文章標籤 

	creatTableTop();

	if(in_array(3,$_SESSION['MM_Limit']['a11'])){
		creatList('文章標籤', 'articleTag');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a11'])){
		creatAdd('文章標籤', 'articleTag');
	}
	
	if(in_array(0,$_SESSION['MM_Limit']['a4'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="author"){//作者管理

	creatTableTop();

	if(in_array(3,$_SESSION['MM_Limit']['a5'])){
		creatList('作者管理', 'author');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a5'])){
		creatAdd('作者管理', 'author');
	}

	if(in_array(3,$_SESSION['MM_Limit']['a5'])){
		creatList('作者分類', 'authorT');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a5'])){
		creatAdd('作者分類', 'authorT');
	}*/

	if(in_array(3,$_SESSION['MM_Limit']['a5'])){
		creatList('專欄banner', 'authorBanner');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a5'])){
		creatAdd('專欄banner', 'authorBanner');
	}*/
	
	if(in_array(0,$_SESSION['MM_Limit']['a5'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="events"){//活動

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a6'])){
		creatList('活動', 'events');
	}	
	if(in_array(2,$_SESSION['MM_Limit']['a6'])){
		creatAdd('活動', 'events');
	}

	if(in_array(3,$_SESSION['MM_Limit']['a6'])){
		creatList('活動banner', 'eventsBanner');
	}	
	/*if(in_array(2,$_SESSION['MM_Limit']['a6'])){
		creatAdd('活動banner', 'eventsBanner');
	}*/
	
	//creatList('Releases', 'events');
	if(in_array(0,$_SESSION['MM_Limit']['a6'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="partner"){//森林夥伴

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('森林夥伴', 'partner');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a7'])){
		creatAdd('森林夥伴', 'partner');
	}
	//creatList('Video', 'video');
	if(in_array(0,$_SESSION['MM_Limit']['a7'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="about"){//關於我們

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a8'])){
		creatList('關於我們', 'about');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a8'])){
		creatAdd('關於我們', 'about');
	}*/
	
	if(in_array(3,$_SESSION['MM_Limit']['a8'])){
		creatList('關於我們banner', 'aboutBanner');
	}	
	/*if(in_array(2,$_SESSION['MM_Limit']['a8'])){
		creatAdd('關於我們banner', 'aboutBanner');
	}*/
	
	if(in_array(0,$_SESSION['MM_Limit']['a8'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="clause"){//版權聲明

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a9'])){
		creatList('版權聲明', 'clause');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a9'])){
		creatAdd('版權聲明', 'clause');
	}*/
	
	if(in_array(3,$_SESSION['MM_Limit']['a9'])){
		creatList('版權聲明banner', 'clauseBanner');
	}	
	/*if(in_array(2,$_SESSION['MM_Limit']['a9'])){
		creatAdd('版權聲明banner', 'clauseBanner');
	}*/

	if(in_array(0,$_SESSION['MM_Limit']['a9'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="weneedu"){//誠徵作家

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a10'])){
		creatList('誠徵作家', 'weneedu');
	}
	/*if(in_array(2,$_SESSION['MM_Limit']['a10'])){
		creatAdd('誠徵作家', 'weneedu');
	}*/
	
	if(in_array(3,$_SESSION['MM_Limit']['a10'])){
		creatList('誠徵作家上方banner', 'weneeduTopBanner');
	}	
	/*if(in_array(2,$_SESSION['MM_Limit']['a10'])){
		creatAdd('誠徵作家上方banner', 'weneeduTopBanner');
	}*/
	
	if(in_array(3,$_SESSION['MM_Limit']['a10'])){
		creatList('誠徵作家下方banner', 'weneeduBottomBanner');
	}	
	/*if(in_array(2,$_SESSION['MM_Limit']['a10'])){
		creatAdd('誠徵作家下方banner', 'weneeduBottomBanner');
	}*/

	if(in_array(0,$_SESSION['MM_Limit']['a10'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="years"){//其它設定

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a11'])){
		creatList('年份', 'years');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a11'])){
		creatAdd('年份', 'years');
	}

	if(in_array(3,$_SESSION['MM_Limit']['a11'])){
		creatList('關鍵字與描述', 'keywords');
	}
	
	if(in_array(0,$_SESSION['MM_Limit']['a11'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="epaper"){//其它設定

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a12'])){
		creatList('電子報', 'epaper');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a12'])){
		creatAdd('電子報', 'epaper');
	}
	
	if(in_array(0,$_SESSION['MM_Limit']['a12'])){header("Location:first.php");}
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