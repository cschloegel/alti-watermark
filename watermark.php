<?php 

// Add watermark to image
if ( $_GET['imageRequested'] && substr( $_GET['imageRequested'], -3) == 'jpg' && $_GET['watermarkName'] ) 
{

  require_once 'functions.php';

// Get File and Path info
  $watermarkName    = $_GET['watermarkName'];
  $imageRequested   = $_GET['imageRequested'];
  $pluginData       = pathinfo(__FILE__);
  $pluginsToUploads = pathinfo(getRelativePath($_SERVER['SCRIPT_NAME'], $_SERVER['REQUEST_URI']) );
  // overwrite next two values when there are arguments after the extension
  $pluginsToUploads['basename'] = basename($_GET['imageRequested']);
  $pluginsToUploads['extension'] = substr( $_GET['imageRequested'], -3);




// Works only with JPG Files
  $formats = 'jpg|jpeg|jpe';

  if ( 
    ( is_file( $pluginsToUploads['dirname'].'/'.basename($_GET['imageRequested']) ) 
    // depending of server configs
||
is_file( utf8_decode($pluginsToUploads['dirname'].'/'.basename($_GET['imageRequested']) )) 
// depending of server configs
)
    && preg_match('/('.$formats.')$/i', $pluginsToUploads['extension']) )
  {

    if(is_file( $pluginsToUploads['dirname'].'/'.$_GET['imageRequested'] )) {
      $imagePathName = $pluginsToUploads['dirname'].'/'.$_GET['imageRequested'];
    } else {
      $imagePathName = utf8_decode($pluginsToUploads['dirname'].'/'.basename($_GET['imageRequested']) );
    }

    $watermark      = imagecreatefrompng($watermarkName);
    $image          = imagecreatefromjpeg( $imagePathName );

    imagefilledrectangle(
      $image, 
      0 , 
      (imagesy($image))-(imagesy($watermark)) , 
      imagesx($image) , 
      imagesy($image) , 
      imagecolorallocatealpha($image, 0, 0, 0, 127) 
      );
    imagecopy(
      $image, 
      $watermark, 
      (imagesx($image)-(imagesx($watermark))), 
      (imagesy($image))-(imagesy($watermark)), 
      0, 
      0, 
      imagesx($watermark), 
      imagesy($watermark)
      );

    header('Last-Modified: '.gmdate('D, d M Y H:i:s T', filemtime ( $imagePathName )));
    header('Content-Type: image/jpeg');
    // for local debuging
    /*
    header("Cache-Control: no-store, no-cache, must-revalidate"); 
    header("Cache-Control: post-check=0, pre-check=0", false); 
    header("Pragma: no-cache"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    */
    //
    imagejpeg($image, NULL, 85);
    imagedestroy($watermark);
    imagedestroy($image);

  } 
  else {
    header('HTTP/1.1 404 Not Found', true, 404);
    echo utf8_decode($pluginsToUploads['dirname'].'/'.basename($_GET['imageRequested'] ));

  }

} else {
  header('HTTP/1.1 404 Not Found', true, 404);
  print_r($_GET);
}