=== Plugin Name ===
Contributors: alticreation
Donate link: http://www.alticreation.com/en/alti-watermark/
Tags: watermark, medias, photography, picture, copyright, photos, logo, upload, signature, images, uploads, media, marca de agua, filigrane, tatouage numerique
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 0.2.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows to add a watermark on all your images, even the ones already uploaded.

== Description ==

The watermark is placed on your images through a htaccess and php file. This means your images are actually **not modified**. You can still download them from your FTP, and they will not have any watermark.

It applies watermark on **new images as well as images already uploaded**. 
By deactivating the plugin, the watermark will be removed on all images.

You have to know that :

* you need to be able to create a htaccess file in your uploads directory.
* you need the GD library.
* you need the Apache module «mod_rewrite» to be activated.
* works only with JPG files (for now).

Available languages :

* English
* Français
* Español

For support, please visit [alti-Watermark plugin](http://www.alticreation.com/en/alti-watermark/ "watermark plugin for Wordpress by alticreation")

== Installation ==

1. Upload `alti-watermark` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

Note : GD library is needed and be able to create a htaccess file in uploads directory.

== Frequently Asked Questions ==

= Can I remove watermark after it was added ? =
YES, you can ! The watermark is applied in a way that doesn't modify your original picture. By deactivating the plugin, the watermark will be removed everywhere.

= I deactivated the watermark plugin but I still see the watermark on my images, what's wrong ? =
It's due to **cache**. Your browser keeps in cache your images. You should **empty your browser cache** and try again to check, it should solve the issue.

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

= 0.2.6 =
* Add conditional tags for apache module **mod_rewrite** in the htaccess file. So that images don't break anymore
* Minor changes in htaccess.php file. The regular expression has been slightly changed.
* Now accepts images **with parameters**. (ie: picture.jpg?key=value&key2=value2).
* To activate these features, I recommend to click on update in the plugin page.

= 0.2.5 =
* A bug happens while updating from 0.1 to 0.2. The watermark is deleted because of the update. 
This version will fix this **major issue**. 
If you were using version 0.2 or 0.1. Please save your watermark image to be able to re-upload it in the new version. This problem will not happen in the future.
* Added a direct setting button to the plugin which appears in the plugins list.

= 0.2 =
* Do not erase a previous htaccess file in the uploads directory, but merge both content.
* Fix the width setting. e.g : The parameter for 400px width was applyed on 500px width images rather than 400px. 
Now, it is applied correctly.
* New translations in French, Canadian French and Spanish.

= 0.1 =
* Initial release
