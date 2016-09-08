<?php
require_once('Connections/connect2data.php');
require_once('paginator.class.php');
require_once('js/fun_changeStr.php');

//page start

if(isset($_GET['page']) && $_GET['page']!=''){
  $page=$_GET['page'];
}else{ $page=1;}
$page_count=12;
$init_count=($page-1)*$page_count;


//使用
mysql_select_db($database_connect2data, $connect2data);
$query_RecProjects = "SELECT *
FROM data_set AS D, file_set AS F, terms AS T, term_relationships AS TR
WHERE D.d_class1 =  'award'
AND D.d_active =  '1'
AND TR.object_id = D.d_id
AND T.term_id = D.d_tag
AND F.file_d_id = D.d_id
AND F.file_type =  'indexImg' GROUP BY d_id ORDER BY T.term_sort ASC
limit $init_count,$page_count";
$RecProjects = mysql_query($query_RecProjects, $connect2data) or die(mysql_error());
$row_RecProjects = mysql_fetch_assoc($RecProjects);
$totalRows_RecProjects = mysql_num_rows($RecProjects);




//$totalRows_RecProjects_count拿來計算全部有幾則
mysql_select_db($database_connect2data, $connect2data);
$query_RecProjects_count = "SELECT *
FROM data_set AS D, file_set AS F, terms AS T, term_relationships AS TR
WHERE D.d_class1 =  'award'
AND D.d_active =  '1'
AND TR.object_id = D.d_id
AND T.term_id = D.d_tag
AND F.file_d_id = D.d_id
AND F.file_type =  'indexImg' GROUP BY d_id ORDER BY T.term_sort ASC";
$RecProjects_count = mysql_query($query_RecProjects_count, $connect2data) or die(mysql_error());
$row_RecProjects_count = mysql_fetch_assoc($RecProjects_count);
$totalRows_RecProjects_count = mysql_num_rows($RecProjects_count);
if($totalRows_RecProjects_count/12 != 1){
  $totalpage=floor($totalRows_RecProjects_count/12)+1;
}else {
  $totalpage=floor($totalRows_RecProjects_count/12);
}
$pages = new Paginator;
$pages->items_total = $totalRows_RecProjects_count;
$pages->items_per_page = $page_count;
$pages->paginate();

//page end


mysql_select_db($database_connect2data, $connect2data);
$query_RecTT = "SELECT *
FROM terms AS T
NATURAL JOIN term_taxonomy AS TT
WHERE TT.taxonomy =  'award'
AND T.term_active =  '1'
ORDER BY term_sort ASC , term_id DESC ";
$RecTT = mysql_query($query_RecTT, $connect2data) or die(mysql_error());
$row_RecTT = mysql_fetch_assoc($RecTT);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>知本設計</title>
  <?php include('meta.php');?>
<!--<link rel="stylesheet" href="css/supersized.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/supersized.shutter.css" type="text/css" media="screen" />-->


  <script src="js/jquery/1.11.1/jquery.min.js"></script>


  <script type="text/javascript" src="js/jquery.easing.1.3.js" ></script>

  <script src="js/CSSPlugin.min.js"></script>
  <script src="js/EasePack.min.js"></script>
  <script src="js/TweenLite.min.js"></script>

  <script src="js/jquery.bxslider/jquery.bxslider.min.js"></script>
  <!-- bxSlider CSS file -->
  <link href="js/jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
<!--<script type="text/javascript" src="js/supersized.3.2.7.js"></script>
  <script type="text/javascript" src="js/supersized.shutter.js"></script>-->

  <link rel="stylesheet/less" type="text/css" href="style_goods.less">
  <script src="js/less-1.3.0.min.js" type="text/javascript"></script>

  <script src="js/masonry.pkgd.min.js"></script>
  <!-- Load the Paper.js library -->
  <!-- <script type="text/javascript" src="js/paper.js"></script> -->
  <style>

    html,body{
    /*margin:0;
    height:100%;
    width:100%;      */
  }
  #in_wrap{
    margin:0 auto;
    text-align:center;
  }
  #pre_loading{width: 100%; height: 100%; position: fixed; z-index: 99999; background-color: #EEECE5}
  .masonry {
    background: #EEE;
    max-width: 640px;
  }
  #left_menu{
    top: 16px;
  }
  #box_area{
    margin-top: 30px;
  }


  /*body { font-family: sans-serif; }*/

  .masonry .item {
    width:  320px;
    height: 320px;
    float: left;
    margin-bottom: 0px;

  }

/*.item.w2 { width:  120px; }
.item.w3 { width:  180px; }
.item.w4 { width:  240px; }

.item.h2 { height: 100px; }
.item.h3 { height: 130px; }
.item.h4 { height: 180px; }
*/

#wrap{
  height: auto;
  min-height: 0;
}
</style>

<script type="text/javascript">

  $(window).load(function() {

  //$('#pre_loading').fadeOut(1500);

});


</script>


</head>

<body>

<!-- <div id="pre_loading">
  <div id="in_wrap" class="greenBorder" style="display: table; width:214px;height: 100%; #position: relative; overflow: hidden;">
   <div style=" #position: absolute; #top: 50%;display: table-cell; vertical-align: middle;">
    <div class="greenBorder" style="#position: relative; #top: -50%; ">
      <img src="images/loading.gif" id="loading_gif" width="214">
    </div>
   </div>
  </div>
</div> --><!-- pre_loading -->

<!-- <div id="logo"><a href="index.php"><img src="images/logo-daebete.png" width="62"></a></div> -->

<div class="bannertitle">
  <div class="ch">獲獎紀錄</div>
  <div class="en">AWARDS</div>
  <div class="arrowdown"><img src="img/arrowdown.png" width="19"></div>
</div>

<?php
$_now='award';
include('top-menu.php');
?>


<div id="outwrap" class="clearboth">
  <div class="topcom">
    <div class="award">
      <div class="adate">Launch</div>
      <div class="apic"></div>
      <div class="aaward">Awards</div>
      <div class="atitle">Project</div>
    </div>
  </div>
  <ul id="award_area">
    <?php do{ ?>
    <li>
      <a href="award_detail.php?d_id=<?php echo $row_RecProjects['d_id']; ?>">
        <div class="award">
          <div class="adate"><?php echo Month2SortEng(substr($row_RecProjects['d_date'],5,2)); ?><?php echo substr($row_RecProjects['d_date'],0,4); ?></div>
          <div class="apic"><img src="<?php echo $row_RecProjects['file_link1']; ?>"></div>


          <div class="aaward">
            <!-- 取得d_tag -->
            <?php
            do {
              $selA = explode(',',$row_RecProjects['d_tag']);

              mysql_select_db($database_connect2data, $connect2data);
              $query_RecIImg = "SELECT *
              FROM file_set AS F WHERE F.file_type='awardTCover'
              AND F.file_d_id= '".$row_RecTT['term_id']."'";
              $RecIImg = mysql_query($query_RecIImg, $connect2data) or die(mysql_error());
              $row_RecIImg = mysql_fetch_assoc($RecIImg);

              if (in_array($row_RecTT['term_id'], $selA)){
               echo '<div class="awardlist" ><img src="'.$row_RecIImg['file_link1'].'"
               class="aawardpic" width="28"> <span class="aawardname">'.$row_RecTT['name'].'</span></div>';
             }

           } while ($row_RecTT = mysql_fetch_assoc($RecTT));
           $rows = mysql_num_rows($RecTT);
           if($rows > 0) {
            mysql_data_seek($RecTT, 0);
            $row_RecTT = mysql_fetch_assoc($RecTT);
          }
          ?>
        </div>

        <div class="atitle"><?php echo $row_RecProjects['d_title']; ?></div>
      </div>
    </a>
  </li>
  <?php }while ($row_RecProjects = mysql_fetch_assoc($RecProjects)) ?>

</ul>
<div id="wrap" class="clearboth clearfix">
  <ul class="page_list clearfix">
    <?php if($page!=1) {?> <a href="news.php?page=<?php echo $page-1 ?>" class="arrow"><img src="img/prev.png" width="9"></a> <?php } ?>
    <?php echo $pages->display_pages(); ?>
    <?php if($page!=$totalpage) {?> <a href="news.php?page=<?php echo $page+1 ?>" class="arrow"><img src="img/next.png" width="9"></a> <?php } ?>
  </ul>
  <?php include('copyright.php');?>
</div><!-- WRAP -->
</div>





</body>
<script src="js/resize.js" type="text/javascript"></script>
<script src="js/grayscale.js"></script>
<script>
  function is_IPhoneOrIPad(){
    return ( (navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPad") != -1) );
  }
  var isiPad=is_IPhoneOrIPad();



  $(window).load(function() {
    var $container = $('#container');
    // initialize
    $container.masonry({
      columnWidth: 320,
      isAnimated: true,
      isFitWidth: true,
      // columnWidth: 400,

      // "isFitWidth": true,
      itemSelector: '.box'
    });

    //執行所有圖片變黑白
  var grayscale_item_string='.new_pic'; //選中的圖片
  grayscale_go(grayscale_item_string);
});



</script>



</html>
