<?php

// Helper function for this sample file.
function printNotFound( $ver )
{
	static $warned;

	if (!empty($warned))
		return;

	echo '<p><br><strong><span class="error">Error</span>: '.$ver.' not found</strong>. ' .
		'This sample assumes that '.$ver.' (not included with CKFinder) is installed in ' .
		'the "ckeditor" sibling folder of the CKFinder installation folder. If you have it installed in ' .
		'a different place, just edit this file, changing the wrong paths in the include ' .
		'(line 57) and the "basePath" values (line 70).</p>' ;
	$warned = true;
}

// This is a check for the CKEditor PHP integration file. If not found, the paths must be checked.
// Usually you'll not include it in your site and use correct path in line 57 and basePath in line 70 instead.
// Remove this code after correcting the include_once statement.
if ( !@file_exists( 'ckeditor/ckeditor.php' ) )
{
	if ( @file_exists('ckeditor/ckeditor.js') || @file_exists('ckeditor/ckeditor_source.js') )
		printNotFound('CKEditor 3.1+');
	else
		printNotFound('CKEditor');
}

include_once 'ckeditor/ckeditor.php' ;
require_once 'ckfinder/ckfinder.php' ;

// This is a check for the CKEditor class. If not defined, the paths in lines 57 and 70 must be checked.
if (!class_exists('CKEditor'))
{
	printNotFound('CKEditor');
}
else
{
	//$initialValue = '<p>Just click the <b>Image</b> or <b>Link</b> button, and then <b>&quot;Browse Server&quot;</b>.</p>' ;
	
	$initialValue = (isset($row_RecEpaper['e_content'])) ? $row_RecEpaper['e_content'] : '';

	$ckeditor = new CKEditor( ) ;
	$ckeditor->basePath	= 'ckeditor/' ;

	// Just call CKFinder::SetupCKEditor before calling editor(), replace() or replaceAll()
	// in CKEditor. The second parameter (optional), is the path for the
	// CKFinder installation (default = "/ckfinder/").
	//CKFinder::SetupCKEditor( $ckeditor, 'ckfinder/' ) ;

	/*$ckeditor->config['filebrowserBrowseUrl'] = '/dols/cms/ckfinder/ckfinder.html';
	$ckeditor->config['filebrowserImageBrowseUrl'] = '/dols/cms/ckfinder/ckfinder.html?type=Images';
	$ckeditor->config['filebrowserFlashBrowseUrl'] = '/dols/cms/ckfinder/ckfinder.html?type=Flash';
	$ckeditor->config['filebrowserUploadUrl'] = '/dols/cms/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	$ckeditor->config['filebrowserImageUploadUrl'] = '/dols/cms/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	$ckeditor->config['filebrowserFlashUploadUrl'] = '/dols/cms/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';*/
	//$ckeditor->config['filebrowserWindowWidth'] = '1024';
	//$ckeditor->config['filebrowserWindowHeight'] = '600';
	
	$ckeditor->editor('e_content', $initialValue);
}

?> 