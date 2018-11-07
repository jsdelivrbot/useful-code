<!-- pdo with class -->
<!-- php 7 不支持class跟function同名 所以class改成RyderPaginator -->
<?php
require_once 'Connections/connect2data.php';
require_once 'paginator.class.php';

$ryder_cat = (isset($_GET['c'])) ? $_GET['c'] : 0;

//page start
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$maxItem = 4;
$limit = ($page - 1) * $maxItem;

// 拿來計算全部有幾則
$workTotal = $DB->query("SELECT * FROM data_set WHERE d_class1='news' AND (d_class2=? || $ryder_cat=0) AND d_active=1 ORDER BY d_sort ASC", [$ryder_cat]);
$pageTotalCount = count($workTotal);
$totalpage = ceil($pageTotalCount / $maxItem);

//使用
$work = $DB->query("SELECT * FROM data_set WHERE d_class1='news' AND (d_class2=? || $ryder_cat=0) AND d_active=1 ORDER BY d_sort ASC LIMIT ?, ?", [$ryder_cat, $limit, $maxItem]);

$pages = new RyderPaginator;
$pages->items_total = $pageTotalCount;
$pages->items_per_page = $maxItem;
$pages->paginate();
//page end
?>



<!-- pdo -->
<?php
require_once 'Connections/connect2data.php';
require_once 'paginator.class.php';

$ryder_cat = (isset($_GET['c'])) ? $_GET['c'] : 0;

//page start
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$maxItem = 6;
$limit = ($page - 1) * $maxItem;

// 拿來計算全部有幾則
$sql = "SELECT * FROM data_set
WHERE d_class1 = 'competitionIntro'
AND (d_id >= :d_id || :d_id = 0)
AND d_active = 1
ORDER BY d_sort ASC";
$pageTotal = $conn->prepare($sql);
$pageTotal->bindParam(':d_id', $ryder_cat, PDO::PARAM_INT);
$pageTotal->execute();
$pageTotalCount = $pageTotal->rowCount();
$totalpage = ceil($pageTotalCount / $maxItem);

//使用
$sql .= " LIMIT :init_count, :page_count";
$work = $conn->prepare($sql);
$work->bindParam(':d_id', $ryder_cat, PDO::PARAM_INT);
$work->bindParam(':init_count', $limit, PDO::PARAM_INT);
$work->bindParam(':page_count', $maxItem, PDO::PARAM_INT);
$work->execute();
$count = $work->rowCount();

$pages = new Paginator;
$pages->items_total = $pageTotalCount;
$pages->items_per_page = $maxItem;
$pages->paginate();
//page end
?>



<!-- mysql_query -->
<?php
require_once 'paginator.class.php';
mysql_select_db($database_connect2data, $connect2data);

//page start
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$page_count = 9;
$init_count = ($page - 1) * $page_count;

//使用
$query_RecProjects = "SELECT * FROM data_set, file_set
	WHERE d_class1='house' AND d_id=file_d_id AND file_type='houseCover' AND d_active='1'
	ORDER BY d_sort ASC LIMIT $init_count, $page_count";
$RecProjects = mysql_query($query_RecProjects, $connect2data) or die(mysql_error());
// $row_RecProjects = mysql_fetch_assoc($RecProjects);
$totalRows_RecProjects = mysql_num_rows($RecProjects);

//$totalRows_RecProjects_count拿來計算全部有幾則
$query_RecProjects_count = "SELECT * FROM data_set, file_set
	WHERE d_class1='house' AND d_id=file_d_id AND file_type='houseCover' AND d_active='1'
	ORDER BY d_sort ASC";
$RecProjects_count = mysql_query($query_RecProjects_count, $connect2data) or die(mysql_error());
$row_RecProjects_count = mysql_fetch_assoc($RecProjects_count);
$totalRows_RecProjects_count = mysql_num_rows($RecProjects_count);

$totalpage = ceil($totalRows_RecProjects_count / $page_count);

$pages = new Paginator;
$pages->items_total = $totalRows_RecProjects_count;
$pages->items_per_page = $page_count;
$pages->paginate();
//page end
?>



<?php echo $pages->display_pages(); ?>



<!-- page箭頭 -->
<?php if($page!=1) {?> <a href="<?= $pages->prevpage(); ?>"><img src="images/pager-prev.png"><img src="images/pager-prev@2x.png" width="11"></a> <?php } ?>

<?php echo $pages->display_pages(); ?>

<?php if($page!=$totalpage && $totalpage>1) {?> <a href="<?= $pages->nextpage(); ?>"><img src="images/pager-next.png"><img src="images/pager-next@2x.png" width="11"></a> <?php } ?>




<!-- 增加錨點 -->
<script>
	$(".m-pager a").each(function(i, el){
		$(el).attr('href', $(el).attr('href') + '#newsAnchor')
	});
</script>