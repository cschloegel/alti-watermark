=== Plugin Name ===
Contributors: alticreation
Donate link: http://www.alticreation.com/en/alti-watermark/
Tags: watermark, medias, photography, picture, copyright, photos, logo, upload, signature, images, uploads, media, photo copyright
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows to add a watermark on your images uploaded.

== Description ==

This plugin allows to add a watermark on the images uploaded. 

It applies watermark on **new images as well as images already uploaded**. 
By deactivating the plugin, the watermark will be removed on all images.

What makes this plugin a really powerful one, is that the watermark is placed on your images through a htaccess and php file. This means your images are actually **not modified**. You can still download them from your FTP, and they will not have any watermark.

The watermark is only visible if you try to download the images from a web browser.

You have to know that :

*	you need to be able to create a htaccess file in your uploads directory.

*	you need the GD library.

*	works only with JPG files (for now).

For support, please visit http://www.alticreation.com/en/alti-watermark/

== Installation ==

1. Upload `alti-watermark` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

Note : GD library is needed and be able to create a htaccess file in uploads directory.

== Frequently Asked Questions ==

= Can I remove watermark after it was added ? =
YES, you can ! The watermark is applied in a way that doesn't modify your original picture. By deactivating the plugin, the watermark will be removed everywhere.

= How can I add watermark to pictures that were uploaded before the plugin was installed? =
Once the plugin is activated, the watermark will be applied in all your pictures following the settings you chose previously.

= Support =
You can ask question and read documentation at [alti-Watermark plugin](http://www.alticreation.com/en/alti-watermark/ "watermark plugin for Wordpress by alticreation")

== Screenshots ==

1. Administration Page for the plugin.
2. Watermark rendered on an image.

== Upgrade Notice ==
* No upgrade for now.

== Changelog ==

= 0.1 =
* Initial release
