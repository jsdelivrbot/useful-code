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
?>
<script src="js/menu.js"></script>
<div id="cmsMenu">
	<ul>
		<?php if($row_RecLevelAuthority['a_2']=='1'){// ?>
		<li id="main_menu_2" class="main_menu <?php if ($menu_is=='news'): ?>main_menu_now<?php endif ?>">
			<a href="javascript:adminSiteLink(2)"><div>news</div></a>
		</li>
		<?php } ?>

		<?php if($row_RecLevelAuthority['a_3']=='1'){// ?>
		<li id="main_menu_3" class="main_men">
			<a href="javascript:adminSiteLink(3)"><div>media</div></a>
		</li>
		<?php } ?>

		<?php if($row_RecLevelAuthority['a_4']=='1'){// ?>
		<li id="main_menu_4" class="main_menu">
			<a href="javascript:adminSiteLink(4)"><div>store</div></a>
		</li>
		<?php } ?>

		<?php if($row_RecLevelAuthority['a_5']=='1'){// ?>
		<!-- <li id="main_menu_5" class="main_menu">
			<a href="javascript:adminSiteLink(5)"><div>menu</div></a>
		</li> -->
		<?php } ?>
		<?php if($row_RecLevelAuthority['a_8']=='1'){// ?>
     	<!-- <li id="main_menu_8" class="main_menu">
     		<a href="javascript:adminSiteLink(8)"><div>媒體報導</div></a>
     	</li> -->
     	<?php } ?>
     	<?php if($row_RecLevelAuthority['a_6']=='1'){//  ?>
     	<!-- <li id="main_menu_6" class="main_menu">
     		<a href="javascript:adminSiteLink(6)"><div>獲獎記錄</div></a>
     	</li> -->
     	<?php } ?>
     	<?php if($row_RecLevelAuthority['a_7']=='1'){?>
     	<!-- <li id="main_menu_7" class="main_menu">
     		<a href="javascript:adminSiteLink(7)"><div>作品</div></a>
     	</li> -->
     	<?php } ?>
     	<?php if($row_RecLevelAuthority['a_10']=='1'){//  ?>
     	<li id="main_menu_10" class="main_menu <?php if ($menu_is=='keywords'): ?>main_menu_now<?php endif ?>">
     		<a href="javascript:adminSiteLink(10)"><div>關鍵字seo</div></a>
     	</li>
     	<?php } ?>
     	<?php if($row_RecLevelAuthority['a_1']=='1'){//權限管理?>
        <li id="main_menu_1" class="main_menu">
        	<a href="javascript:adminSiteLink(1)"><div>權限管理</div></a>
        </li>
        <?php } ?>
    </ul>
</div>
<?php
if($menu_is=="news"){//news

	creatTableTop();
	creatAll('news', 'news');
	if($row_RecLevelAuthority['a_2']=='0'){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="media"){//event

	creatTableTop();
	creatAll('media', 'media');
	if($row_RecLevelAuthority['a_3']=='0'){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="store"){

	creatTableTop();
	creatAll('商店', 'store');
	creatAll('商店', 'storeC');
	if($row_RecLevelAuthority['a_4']=='0'){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="menu"){

	creatTableTop();
	creatAll('菜單', 'menu');
	creatAll('菜單', 'menuC');
	if($row_RecLevelAuthority['a_5']=='0'){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="keywords"){//keywords

	creatTableTop();
	creatList('關鍵字seo', 'keywords');
	if($row_RecLevelAuthority['a_10']=='0'){header("Location:first.php");}
	creatTablBottom();

}else if($menu_is=="authority"){

	creatTableTop();
	creatAll('管理員', 'authority');
	creatAll('權限管理群組', 'authorityC');
	if($row_RecLevelAuthority['a_1']=='0'){header("Location:first.php");}
	creatTablBottom();

}
?>

<div style="clear:both; height:20px;"></div>