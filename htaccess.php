<?php 
	global $width;

	$widthRegex = '';
	if ( isset($width) ) {
		if( $width == 9999 ) {
			$widthRegex = '\-([0-9]{1,5})x([0-9]{1,5})';
		} else {
			$widthRegex = '\-([0-9]{1,5})(';
			for ($i = 1; $i <= $width; $i++) {
				$widthRegex .= 'x'.$i;
				if($i!=$width) $widthRegex .= '|';
			}
			$widthRegex .= ')([0-9]{1,2})';
		}
	} else {
		$widthRegex = '\-([0-9]{1,5})(x1|x2|x3|x4)([0-9]{1,2})';
	}

	$htaccesContent      = '# BEGIN alti-watermark Plugin'."\n\r\n";
  	$htaccesContent     .= 'RewriteEngine on'."\n";
  	$htaccesContent     .= 'RewriteRule ^(?!.*'.$widthRegex.'\.jpg$)(.+)(\.jpg)$ '.$acw_relativePaths['uploadsToPlugins'].'watermark.php?imageRequested=$0&watermarkName='.$acw_watermark['name']."\n\r\n";
  	$htaccesContent     .= '# END alti-watermark Plugin. (generated on '.date('Y-m-d H:i.s').') [width='.$width.']'."\n";

  	if( is_writable($acw_uploads['basedir'].'/') ) {
  		file_put_contents( $acw_uploads['basedir'].'/'.'.htaccess', $htaccesContent ) or die('booh');
  	} else {
  		$successWidth = FALSE;
  	}

  	