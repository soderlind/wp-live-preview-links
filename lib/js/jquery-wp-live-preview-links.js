/**
 * jquery-wp-live-preview-links.js
 *
 * (c) Per Soderlind: http://soderlind.no;
 *
 */

//html prefetching from: http://gavinmorrice.com/blog/posts/1-link-prefetching-with-html-5-and-jquery
var app_live_preview_helper = {
    // returns an array of each url to prefetch
    prefetchLinks: function(){
        // returns an array of each a.prefetch link's href
        var hrefs = jQuery("a.wp-live-preview").map(function(index, domElement){
            return jQuery(this).attr("href");
        });
        // returns the array of hrefs without duplicates
        return jQuery.unique(hrefs);
    },

    // adds a link tag to the document head for each of prefetchLinks()
    addPrefetchTags: function(){
        // for each prefetchLinks() ...
        this.prefetchLinks().each(function(index,Element){
            // create a link element...
            jQuery("<link />", {
                // with rel=prefetch and href=Element...
                rel: "prefetch", href: Element
                // and append it to the end of the document head
            }).appendTo("head");
        });
    },
};

(function($) {

	var resizeTimer;

	var wp_live_preview_links_defaults = {
		link: 'class',
		targetWidth : 1000,
		targetHeight: 800,
		viewWidth: 300,
		viewHeight: 200,
		position: 'auto',
		positionOffset: 50,
    }
    var wp_live_preview_links_options = {};
    if ( ('object' == typeof wp_live_preview_links_vars)  && (null  !== wp_live_preview_links_vars) ) {
   		//wp_localize_script passes all varables as strings, convert integers back to integers
    	$.each(wp_live_preview_links_vars, function( key, value ){
	    	if (! isNaN(parseInt(value, 10))) {
	    		value = parseInt(value, 10);
	    	}
	    	wp_live_preview_links_options[key] = value;
    	});
    } else {
    	wp_live_preview_links_options = wp_live_preview_links_defaults;
    }

	//if scale is 0, remove it and let livepreview determine the scale
    if (0 == wp_live_preview_links_options.scale ) {
   		delete wp_live_preview_links_options['scale'];
    }

    if ('class' !== "" +wp_live_preview_links_options.link) {
    	$('a').removeClass('wp-live-preview');
    }

    switch (wp_live_preview_links_options.link) {
    	case 'site':
			$('a').each(function () {
			    if (this.host == location.host) {
			        $(this).addClass('wp-live-preview');
			    }
			});
    		break;
    	case 'external':
			$('a').each(function () {
			    if (this.host !== location.host) {
			        $(this).addClass('wp-live-preview');
			    }
			});
    		break;
    	case 'all':
    		$('a').addClass('wp-live-preview');
    		break;
    }

    var isAuto = ('auto' == wp_live_preview_links_options.position);

	function addLivePreview() {
	    if (true == isAuto) {
	    	$('.wp-live-preview').off('hover');
	    	var window_width = $(window).width();
		    $('.wp-live-preview').each(function(){
		    	var options = wp_live_preview_links_options;
			    var offset = $(this).offset();
			    var view_left = parseInt(offset.left,10) + parseInt(options.viewWidth,10) + parseInt(options.positionOffset,10) + 60;
			    if( view_left > window_width) {
			    	options['position'] = 'left';
			    } else {
			    	options['position'] = 'right';
			    }
			    $(this).livePreview(options);
		    });
	    } else {
			$(".wp-live-preview").livePreview(wp_live_preview_links_options);
		}
		app_live_preview_helper.addPrefetchTags();
	} // function addLivePreview

	// from http://gomakethings.com/javascript-resize-performance/
	$(window).resize(function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function(){
        	addLivePreview();
        }, 250);
    });

    addLivePreview();

})(jQuery);

