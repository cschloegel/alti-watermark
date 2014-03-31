<?php 

require_once('paths.php');

// Check if FILES is submited
if(isset( $_FILES['watermarkFile']['name']) && $_FILES['watermarkFile']['name'] != '' && preg_match('/^image/i', $_FILES['watermarkFile']['type']) && $_FILES['watermarkFile']['error'] == 0) {

        if( substr($_FILES['watermarkFile']['name'], -3 ) == 'png') {
            $success = move_uploaded_file( $_FILES['watermarkFile']['tmp_name'], $acw_relativePaths['adminToPlugins'].'/'.$acw_watermark['name'] );
        } else {

            $successImg = imagepng(imagecreatefromstring(
                file_get_contents($_FILES['watermarkFile']['tmp_name'])), 
                $acw_relativePaths['adminToPlugins'].'/'.$acw_watermark['name']
            );
        }

}

// Check if image submited is wrong
if(isset( $_FILES['watermarkFile']['name']) && $_FILES['watermarkFile']['name'] != '' && (!preg_match('/^image/i', $_FILES['watermarkFile']['type']) || $_FILES['watermarkFile']['error'] != 0)) {

        $successImg = FALSE;

}

// Check if settings are submited
if(isset( $_POST['watermarkSize'] )) {
        $width = $_POST['watermarkSize'];
        if(is_numeric($width)) {
            include 'htaccess.php';
        }
        if(isset($successWidth) && $successWidth == FALSE) {
           $successWidth = FALSE; 
        } else {
            $successWidth = TRUE; 
        }
}


// Read width value from htaccess
if( file_exists($acw_uploads['basedir'].'/'.'.htaccess') ) {
    $htaccess = file_get_contents( $acw_uploads['basedir'].'/'.'.htaccess' );
    preg_match('/\[width=([0-9]+)\]/i', $htaccess, $htaccessWidth);
    $htaccessWidth = $htaccessWidth[1];
} else {
    $htaccessWidth = '';
}

?>
<link rel="stylesheet" href="<?php echo $acw_relativePaths['adminToPlugins'].'/'; ?>style.css">
<div id="ac-aw-admin-page-container" class="wrap">
    <h2>alti Watermark</h2>
    <p class="description">Apply a watermark on all your photographies. This action is cancelable just by deactivating the plugin. <br> The watermark will be applied even in your photos already uploaded.</p>
    <?php if( isset($successImg) && $successImg === TRUE ) { ?>
    <div id="setting-error-settings_updated" class="updated settings-error"> 
        <p><strong>The watermark has been updated.</strong></p></div>
    <?php } ?>
    <?php if( isset($successImg) && $successImg === FALSE ) { ?>
    <div id="setting-error-settings_updated" class="error settings-error"> 
        <p><strong>There was an error while processing the image submited. Please try again or with a different image format.</strong></p></div>
    <?php } ?>
    <?php if( isset($successWidth) && $successWidth === TRUE ) { ?>
    <div id="setting-error-settings_updated" class="updated settings-error"> 
        <p><strong>The width setting has been updated.</strong></p></div>
    <?php } ?>
    <?php if( isset($successWidth) && $successWidth === FALSE ) { ?>
    <div id="setting-error-settings_updated" class="error settings-error"> 
        <p><strong>There was an error while updating the width setting. <br> Apparently you don't have rights to modify or create a file on your uploads directory.</strong></p></div>
    <?php } ?>
        <form method="post" enctype="multipart/form-data">
            <table class="form-table">
                <tbody>

                    <tr valign="top">
                        <th scope="row"><label for="watermarkSize">Apply to images</label></th>
                        <td>
                            <select id="watermarkSize" name="watermarkSize">
                                    <option value="9999"<?php if(9999 == $htaccessWidth) { echo ' selected="selected" '; } ?>>only fullsize</option>
                                <?php for($i = 1; $i <= 9; $i++) { ?>
                                    <option value="<?php echo $i; ?>"<?php if($i == $htaccessWidth) { echo ' selected="selected" '; } ?>>height > <?php echo $i; ?>00px</option>
                                <?php } ?>
                    </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="watermarkFile">Choose a watermark</label></th>
                        <td>
                            <input type="file" name="watermarkFile" id="watermarkFile">
                            <p class="description">For better results : upload a small image.</p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="preview">Preview</label></th>
                        <td>
                            <?php if(file_exists( $acw_relativePaths['adminToPlugins'].'/'.$acw_watermark['name'] )) { ?>
                            <img class="preview" src="<?php echo $acw_relativePaths['adminToPlugins'].$acw_watermark['name'].'?'.rand(0,1500); ?>" alt="watermark">
                            <p class="description">Real size is actually <strong><?php $imageSize = getimagesize( $acw_relativePaths['adminToPlugins'].'/'.$acw_watermark['name']); echo $imageSize[0].'x'.$imageSize[1]; ?>px</strong>. The background gradient is for contrast check.</p>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label for="help">Help, Support</label></th>
                        <td>
                            A problem, a question ? Please read and leave a message in the <a href="http://www.alticreation.com/en/alti-watermark/" target="_blank">alti Watermark plugin page</a>. <br>
                            Love this plugin ? <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SZKUQWXUFJHCY" target="_blank">Donate !</a>
                        </td>
                    </tr>

                </tbody>
            </table>

            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Upload watermark"></p>
        </form>
<div class="updated more">
    <a class="logo" href="http://www.alticreation.com?plugin=alti-watermark"><img src="http://alticreation.com/logos/alticreation_color_01.png" alt="alticreation"></a>
    This plugin has been developed by <strong><a href="http://www.alticreation.com/en/profile">Alexis Blondin</a></strong>.
    <div class="share"><a href="http://www.alticreation.com?plugin=alti-watermark" target="_blank">alticreation.com</a> <a href="http://www.linkedin.com/in/alexisblondin/en" target="_blank">linkedin</a> <a href="https://plus.google.com/+AlexisBlondin" target="_blank">google +</a> <a href="https://twitter.com/alticreation" target="_blank">twitter</a></div>
</div>


    </div>