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