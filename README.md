WP Live Preview Links
=====================


WP Live Preview Links allows you to see a live scaled preview of the site you are linking to in a pop-up dialog style window prior to clicking on it.

WP Live Preview Links does not use an external service to create these "thumbnails".

In the admin panel you can select which links that will trigger the preview (`class="wp-live-preview"`, internal, external or all links). You can also adjust the preview window size and position.


Installation 
-------------

You can download and install WP Live Preview Links using the built in WordPress plugin installer. If you download WP Live Preview Links manually, make sure it is uploaded to "/wp-content/plugins/wp-live-preview-links/".

Activate WP Live Preview Links in the "Plugins" admin panel using the "Activate" link.

Frequently Asked Questions 
--------------------------

###It doesn't work ?!###

1. WP Live Preview Links needs a modern browsers that support CSS3 3D Transform properties (Chrome, Firefox, Safari, IE10+)
1. Certain sites may have set their X-FRAME-OPTIONS header policy to SAMEORGIN or DENY. This is specifically to prevent other sites from iframing their site. If that is the case, this plugin will not work.



Changelog
---------
###1.0###
* Initial release


Credits
-------
* WP Live Preview Links uses the [Jquery Live Link Preview Plugin](https://github.com/alanphoon/jquery-live-preview)  by [Alan Phoon](http://www.ampedupdesigns.com/about)
* The admin panel is done using the excellent [Admin Page Framework](http://wordpress.org/plugins/admin-page-framework/) by [Michael Uno](http://michaeluno.jp/)