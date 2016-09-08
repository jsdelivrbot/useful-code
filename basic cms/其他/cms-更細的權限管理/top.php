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
    	<?php if(in_array(3,$_SESSION['MM_Limit']['a2'])){//首頁設定 banners?>
     	<li id="main_menu_2" class="main_menu">
     		<a href="javascript:adminSiteLink(2)"><div>首頁設定</div></a>
     	</li>
     	<?php } ?>
     	<?php if(in_array(3,$_SESSION['MM_Limit']['a3'])){//最新消息 news?>
     	<li id="main_menu_3" class="main_menu">
     		<a href="javascript:adminSiteLink(3)"><div>最新消息</div></a>
     	</li>
	 	<?php } ?>
     	<?php if(in_array(3,$_SESSION['MM_Limit']['a4'])){//產品介紹 products?>
     	<li id="main_menu_4" class="main_menu">
     		<a href="javascript:adminSiteLink(4)"><div>產品介紹</div></a>
     	</li>
     	<?php } ?>
     	<?php if(in_array(3,$_SESSION['MM_Limit']['a5'])){//會員專區 member?>
     	<li id="main_menu_5" class="main_menu">
     		<a href="javascript:adminSiteLink(5)"><div>會員專區</div></a>
     	</li>
	 	<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a6'])){//訂單管理 orders?>
        <li id="main_menu_6" class="main_menu">
        	<a href="javascript:adminSiteLink(6)"><div>訂單管理</div></a>
        </li>
		<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a7'])){//關於我們 about?>
        <li id="main_menu_7" class="main_menu">
        	<a href="javascript:adminSiteLink(7)"><div>關於我們</div></a>
        </li>
		<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a8'])){//聯絡我們 contact?>
        <li id="main_menu_8" class="main_menu">
        	<a href="javascript:adminSiteLink(8)"><div>聯絡我們</div></a>
        </li>
		<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a9'])){//表單下載 download?>
        <li id="main_menu_9" class="main_menu">
        	<a href="javascript:adminSiteLink(9)"><div>表單下載</div></a>
        </li>
		<?php } ?>
		<?php if(in_array(3,$_SESSION['MM_Limit']['a10'])){//免運費設定 freight freight?>
        <li id="main_menu_10" class="main_menu">
        	<a href="javascript:adminSiteLink(10)"><div>免運費設定</div></a>
        </li>
		<?php } ?>
        <?php if(in_array(3,$_SESSION['MM_Limit']['a1'])){//權限管理?>
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
	
	if(in_array(0,$_SESSION['MM_Limit']['a2'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="news"){//最新消息

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a3'])){
		creatList('最新消息', 'news');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a3'])){
		creatAdd('最新消息', 'news');
	}	
	if(in_array(3,$_SESSION['MM_Limit']['a3'])){
		creatList('最新消息分類', 'newsC');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a3'])){
		creatAdd('最新消息分類', 'newsC');
	}
	
	if(in_array(0,$_SESSION['MM_Limit']['a3'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="products"){//產品介紹

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('產品介紹', 'products');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('產品介紹', 'products');
	}	
	if(in_array(3,$_SESSION['MM_Limit']['a4'])){
		creatList('產品介紹分類', 'productsT');
	}
	if(in_array(2,$_SESSION['MM_Limit']['a4'])){
		creatAdd('產品介紹分類', 'productsT');
	}
	
	//creatAll('產品介紹', 'products');
	//creatAll('產品介紹分類', 'productsT');
	//creatList('訂購單下載', 'purchaseOrder');
	if(in_array(0,$_SESSION['MM_Limit']['a4'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="member"){//會員專區

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a5'])){
		creatList('會員專區', 'member');
	}
	/*if(in_array(3,$_SESSION['MM_Limit']['a5'])){
		creatList('會員規範', 'member_rule');
	}*/
	
	//creatList('會員專區', 'member');
	//creatList('會員規範', 'member_rule');
	if(in_array(0,$_SESSION['MM_Limit']['a5'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="orders"){//訂單管理

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a6'])){
		creatList('訂單管理', 'orders');
	}	
	
	//creatList('訂單管理', 'orders');
	if(in_array(0,$_SESSION['MM_Limit']['a6'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="about"){//關於我們

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a7'])){
		creatList('關於我們', 'about');
	}
	//creatList('關於我們', 'about');
	if(in_array(0,$_SESSION['MM_Limit']['a7'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="contact"){//聯絡我們

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a8'])){
		creatList('聯絡我們', 'contact');
	}
	//creatList('聯絡我們', 'contact');
	if(in_array(0,$_SESSION['MM_Limit']['a8'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="download"){//表單下載

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a9'])){
		creatList('表單下載', 'download');
	}
	//creatList('表單下載', 'download');
	if(in_array(0,$_SESSION['MM_Limit']['a9'])){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="freight"){//免運費設定

	creatTableTop();
	
	if(in_array(3,$_SESSION['MM_Limit']['a10'])){
		creatList('免運費設定', 'freight');
	}
	//creatList('免運費設定', 'freight');
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