<!-- 取圖 -->
<?php
preg_match_all('#<img[^>]*>#i', $row_RecWorks['d_content'], $match);

$i=1;

foreach ($match[0] as $value) {
	echo '<div class="smallPic">';
	echo $value;
	echo '</div>';
    if ($i++ == 3) break;
}
?>

<!-- 取字 -->
<?php
preg_match_all('/.+/u', $row_RecMenuFancy['d_content'], $ch);
preg_match_all('/.+/u', $row_RecMenuFancy['d_class6'], $en);
foreach ($ch[0] as $key=>$value) {
	echo '<li>';
	echo '<div class="ch dot">';
	echo $value;
	echo '</div>';
	echo '<div class="en">';
	echo $en[0][$key];
	echo '</div>';
	echo '</li>';
}
?>