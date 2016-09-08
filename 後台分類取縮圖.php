<?php
require_once('Connections/connect2data.php');

mysql_select_db($database_connect2data, $connect2data);
$query_RecProjects = "SELECT *
FROM data_set AS D, file_set AS F, terms AS T, term_relationships AS TR
WHERE D.d_class1 =  'award'
AND D.d_active =  '1'
AND TR.object_id = D.d_id
AND T.term_id = D.d_tag
AND F.file_d_id = D.d_id
AND F.file_type =  'Mobile' GROUP BY d_id ORDER BY d_date DESC";
$RecProjects = mysql_query($query_RecProjects, $connect2data) or die(mysql_error());
// $row_RecProjects = mysql_fetch_assoc($RecProjects);
$totalRows_RecProjects = mysql_num_rows($RecProjects);

mysql_select_db($database_connect2data, $connect2data);
$query_RecTT = "SELECT *
FROM terms AS T
NATURAL JOIN term_taxonomy AS TT
WHERE TT.taxonomy =  'award'
AND T.term_active =  '1'
ORDER BY term_sort ASC , term_id DESC";
$RecTT = mysql_query($query_RecTT, $connect2data) or die(mysql_error());
$row_RecTT = mysql_fetch_assoc($RecTT);

?>


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