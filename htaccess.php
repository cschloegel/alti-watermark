<?php 
global $width;

$widthRegex = '';
if ( isset($width) ) {
	if( $width == 9999 ) {
		$widthRegex = '\-([0-9]{1,5})x([0-9]{1,5})';
	} else {
		$widthRegex = '\-([0-9]{1,5})(';
			for ($i = 1; $i < $width; $i++) {
				$widthRegex .= 'x'.$i;
				if ( $i+1 < $width ) $widthRegex .= '|';
			}
			$widthRegex .= ')([0-9]{1,2})';
}
} else {
	$widthRegex = '\-([0-9]{1,5})(x1|x2|x3|x4)([0-9]{1,2})';
}

// check if htaccess already exists
if ( file_exists($acw_uploads['basedir'].'/'.'.htaccess') && !preg_match('/alti\-watermark/i', file_get_contents( $acw_uploads['basedir'].'/'.'.htaccess' )) ) {
	$htaccessContent = file_get_contents( $acw_uploads['basedir'].'/'.'.htaccess' );
	$htaccessContent .= "\n\r\n";
} 
else {
	if ( file_exists($acw_uploads['basedir'].'/'.'.htaccess') && preg_match('/^(.+)\# BEGIN alti\-watermark/s', file_get_contents( $acw_uploads['basedir'].'/'.'.htaccess' ), $htaccessContentPreviousContent) )  {
		$htaccessContent = $htaccessContentPreviousContent[1];
	} else {
		$htaccessContent = "";
	}
}

$htaccessContent     .= '# BEGIN alti-watermark Plugin'."\n\r\n";
$htaccessContent     .= 'RewriteEngine on'."\n";
$htaccessContent     .= 'RewriteRule ^(?!.*'.$widthRegex.'\.jpg$)(.+)(\.jpg)$ '.$acw_relativePaths['uploadsToPlugins'].'watermark.php?imageRequested=$0&watermarkName='.$acw_plugins['baseurl'].$acw_plugins['subdir'].'-data/'.$acw_watermark['name']."\n\r\n";
$htaccessContent     .= '# END alti-watermark Plugin. (generated on '.date('Y-m-d H:i.s').') [width='.$width.']'."\n";

if( is_writable($acw_uploads['basedir'].'/') ) {
	file_put_contents( $acw_uploads['basedir'].'/'.'.htaccess', $htaccessContent );
} else {
	$successWidth = FALSE;
}

