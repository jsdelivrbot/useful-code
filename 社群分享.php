
<?php
$URL='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>

<meta property="og:title" content="<?php echo $row_Recwork['d_title']; ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?= $URL ?>" />
<meta property="og:image" content="http://hancure.goods-design.com.tw/images/toplogo-index.png" />
<meta property="og:description" content="<?php echo $row_Recwork['content']; ?>" />

<!-- fb -->
<a target="blank" href="http://www.facebook.com/sharer/sharer.php?u=<?= $URL ?>"><img src="images/detaionicon-04.png" width="26"></a>

<!-- twitter -->
<a target="blank" href="http://twitter.com/share?url=<?= $URL ?>"><img src="images/detaionicon-03.png" width="26"></a>

<!-- pin it -->
<a target="blank" href="https://www.pinterest.com/pin/create/button/?url=<?= $URL ?>"><img src="images/detaionicon-05.png" width="26"></a>

<!-- line (手機按才有用)-->
<a target="blank" href="http://line.naver.jp/R/msg/text/?<?= $URL ?>"><img src="images/detaionicon-02.png" width="26"></a>