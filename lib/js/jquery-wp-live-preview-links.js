/*

 */

jQuery(document).ready(function($) { 

	var defaults = {
		link: 'class',
		targetWidth : 1000,
		targetHeight: 800,
		viewWidth: 300,
		viewHeight: 200,
		position: 'right',
		positionOffset: 50,
    };

    var options = $.extend(defaults, wp_live_preview_links_vars);

    //wp_localize_script passes all varables as strings, convert integers back to integers.
	$.each(options, function( key, value ){
    	if (! isNaN(parseInt(value, 10))) {
    		value = parseInt(value, 10); 
    	}
    	options[key] = value;
    });

	//if scale is 0, remove it and let livepreview determine the scale
    if (wp_live_preview_links_vars && 0 == wp_live_preview_links_vars.scale ) {
   		delete options['scale'];
    }
    

    if ('class' != options.link) {
    	$('a').removeClass('wp-live-preview');
    }

    switch (options.link) {
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


	$(".wp-live-preview").livePreview(
		options
	);
});

