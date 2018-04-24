https://doc.querylist.cc/site/index/doc/14

<?php
	require 'vendor/autoload.php';

	use QL\QueryList;

	$ql = QueryList::get('https://www.twreporter.org/');

	$repoter = [
	    'pic' => ['.img-wrapper__ImgObjectFit-clvi31-0', 'html'],
	    'cat' => ['.s1y4lqpj-0-category-name__CategoryName-jqILKP', 'html'],
	    'title' => ['.latest-topic__RelatedTitle-s1wuyrwn-7', 'html'],
	    'content' => ['.latest-topic__RelatedDescription-s1wuyrwn-8', 'html']
	];

	$posts = $ql->rules($repoter)->range('#latestTopic .latest-topic__FlexBox-s1wuyrwn-4 .latest-topic__FlexItem-s1wuyrwn-5')->query()->getData();
	echo '<pre>'; print_r($posts->all()); echo '</pre>';
?>