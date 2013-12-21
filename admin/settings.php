<?php


// Include the library
if ( ! class_exists( 'AdminPageFramework' ) )
	include_once dirname( __FILE__ ) . '/wp-live-preview-post.php';

// extend the class
class WP_Live_Preview_Post_Settings extends AdminPageFramework {


	/*
    viewWidth: 300,
    viewHeight: 200,
    targetWidth: 1000,
    targetHeight: 800,
    scale: '0.5',
    offset: 50,
    position: 'left'
 */

	// Define the setup method to set how many pages, page titles and icons etc.
	public function setUp() {
		// Root menu
		$this->setRootMenuPage(
			'Live Preview Post',   // specify the name of the page group
			//plugins_url( 'img/keyhole.png', __FILE__ )
			"\f115"
		);

		// General Options
		$this->addSubMenuPage(
			'General Options',        // page title
			'wp_live_preview_post_options',   // page slug
			'options-general'
		);

		$this->addHelpTab(
			array(
				'strPageSlug'         => 'wp_live_preview_post_options',    // ( mandatory )
				// 'strPageTabSlug'   => null,    // ( optional )
				'strHelpTabTitle'     => 'Introduction',
				'strHelpTabID'        => 'general_options_help_introduction',  // ( mandatory )
				'strHelpTabContent'   => __( 'This contextual help text can be set with the addHelpTab() method.', 'wp-live-preview-post' ),
				//'strHelpTabSidebarContent'  => __( 'This is placed in the sidebar of the help pane.', 'wp-live-preview-post' ),

			)
		);
		// what

		$this->addSettingSections(
			array(
				'strSectionID'       => 'options',    // the section ID
				'strPageSlug'        => 'wp_live_preview_post_options'    // the page slug that the section belongs to
				//'strTitle'           => __('','wp-live-preview-post')    // the section title
			)
		);

		$this->addHelpTab(
			array(
				'strPageSlug'        => 'wp_live_preview_post_options',    // ( mandatory )
				// 'strPageTabSlug'  => null,    // ( optional )
				'strHelpTabTitle'    => 'What',
				'strHelpTabID'       => 'general_options_help_what',  // ( mandatory )
				'strHelpTabContent'  => __( 'what what what', 'wp-live-preview-post' ),
				//'strHelpTabSidebarContent'  => __( 'This is placed in the sidebar of the help pane.', 'wp-live-preview-post' ),
			)
		);

		$this->addSettingFields(
			array(
				'strFieldID'		=> 'link',
				'strTitle'			=> 'Live Preview Links',
				'strDescription'	=> 'Which links will trigger the live preview.',
				'strType'			=> 'select',
				'vLabel'            => array( 
					'site'        => __( 'Site links only', 'wp-live-preview-post' ),
					'all'         => __( 'All links', 'wp-live-preview-post' ),
					'class'       => __( 'class="livepreview"', 'wp-live-preview-post' ),
					'shortcode'   => __( '[livepreview] shortcode', 'wp-live-preview-post' )
				),
				'vDefault' 			=> 'site',	// 0 means the first item
			),
			array( // Multiple Sizes
				'strFieldID'         => 'dialog',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Live Preview Dialog', 'wp-live-preview-post-demo' ),
				'strDescription'     => __( 'The preview dialog size.', 'wp-live-preview-post' ),
				'strType'            => 'size',
				'vLabel'             => array(
					'viewwidth'    => __( 'View Width', 'wp-live-preview-post-demo' ),
					'viewheight'   => __( 'View Height', 'wp-live-preview-post-demo' ),
				),
				'vSizeUnits'         => array(  // notice that the array key structure corresponds to the vLabel array's.
					'viewwidth'    => array( 'px' => 'px', '%' => '%', 'em' => 'em' ),
					'viewheight'   => array( 'px' => 'px', '%' => '%', 'em' => 'em' ),
				),
				'vDefault'           => array(
					'viewwidth'    => array( 'size' => 300, 'unit' => 'px' ),
					'viewheight'   => array( 'size' => 200, 'unit' => 'px' ),
				),
				'vDelimiter'       => '<br />',
			),
			array( // Multiple Sizes
				'strFieldID'         => 'target',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Site Viewport', 'wp-live-preview-post-demo' ),
				'strDescription'     => __( 'The viewport size of the site you are previewing', 'wp-live-preview-post' ),
				'strType'            => 'size',
				'vLabel'             => array(
					'targetwidth'  => __( 'Target Width', 'wp-live-preview-post-demo' ),
					'targetheight' => __( 'Target Height', 'wp-live-preview-post-demo' ),
				),
				'vSizeUnits'         => array(  // notice that the array key structure corresponds to the vLabel array's.
					'targetwidth'  => array( 'px' => 'px', '%' => '%', 'em' => 'em' ),
					'targetheight' => array( 'px' => 'px', '%' => '%', 'em' => 'em' ),
				),
				'vDefault'           => array(
					'targetwidth'  => array( 'size' => 1000, 'unit' => 'px' ),
					'targetheight' => array( 'size' => 800, 'unit' => 'px' ),
				),
				'vDelimiter'         => '<br />',
			),
			array(
				'strFieldID'         => 'scale',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Scale', 'wp-live-preview-post' ),
				'strType'            => 'number',
				'vMax'               => '1.0',
				'vMin'               => '0.0',
				'vStep'              => '0.1',
				'strDescription'     => __( 'The scaling of the viewport size of the site you are previewing (this is the CSS transform scale property), default = calculated automatically. Notes: If no scaling is specified (0), then the scaling is automatically calculated to provide the best fit to the preview dialog window size.', 'wp-live-preview-post-demo' ),
				'vDefault'           =>  0,
				'vSize'              => 40
			),
			array(
				'strFieldID'         => 'offset',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Offset', 'wp-live-preview-post' ),
				'strDescription'     => __( 'The offset from the target in pixels', 'wp-live-preview-post' ),
				'strType'            => 'size',
				'vSizeUnits'         => array( 'px' => 'px', '%' => '%', 'em' => 'em' ),
				'vSize'              => 40
			),
			array(  // Single set of radio buttons
				'strFieldID'         => 'postition',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Postition', 'wp-live-preview-post' ),
				'strDescription'     => __( 'Side to which the preview will open', 'wp-live-preview-post' ),
				'strType'            => 'radio',
				'vLabel'             => array( 'left' => 'Left', 'right' => 'Right'  ),
				'vDefault'           => 'right'  // banana
			)
		);

	}

}
