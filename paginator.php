<?php
require_once('paginator.class.php');
mysql_select_db($database_connect2data, $connect2data);

//page start
$page=(isset($_GET['page'])) ? $_GET['page']:1;
$page_count=9;
$init_count=($page-1)*$page_count;

//使用
$query_RecProjects = "SELECT * FROM data_set, file_set
  WHERE d_class1='house' AND d_id=file_d_id AND file_type='houseCover' AND d_active='1'
  ORDER BY d_sort ASC limit $init_count,$page_count";
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

$totalpage=ceil($totalRows_RecProjects_count/9);

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

<?php if($page!=$totalpage) {?> <a href="<?= $pages->nextpage(); ?>"><img src="images/pager-next.png"><img src="images/pager-next@2x.png" width="11"></a> <?php } ?>