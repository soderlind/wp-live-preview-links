<?php


if ( ! class_exists( 'AdminPageFramework' ) )
	include_once dirname( __FILE__ ) . '/admin-page-framework.php';

class WP_Live_Preview_Post_Settings extends AdminPageFramework {

	public function setUp() {
		$this->setRootMenuPage(
			__('Live Preview Post','wp-live-preview-post' ),
			//plugins_url( 'img/keyhole.png', __FILE__ )
			"\f115"
		);

		$this->showPageHeadingTabs( false );

		$this->addSubMenuPage(
			__('Live Preview Post','wp-live-preview-post' ),
			'wp_live_preview_post_options',
			'options-general'
		);

		$this->addHelpTab(
			array(
				'strPageSlug'         => 'wp_live_preview_post_options',
				'strHelpTabTitle'     => __('Live Preview Post','wp-live-preview-post' ),
				'strHelpTabID'        => 'general_options_help_introduction',
				'strHelpTabContent'   => __( 'This contextual help text can be set with the addHelpTab() method.', 'wp-live-preview-post' ),
			)
		);

		$this->addSettingSections(
			array(
				'strSectionID'       => 'options',
				'strPageSlug'        => 'wp_live_preview_post_options'
			)
		);

		$this->addSettingFields(
			array(
				'strFieldID'		=> 'link',
				'strSectionID'       => 'options',
				'strTitle'			=> __('Live Preview Links','wp-live-preview-post' ),
				'strDescription'	=> 'Which links will trigger the live preview.',
				'strType'			=> 'select',
				'vLabel'            => array( 
					'site'        => __( 'Site internal links only', 'wp-live-preview-post' ),
					'all'         => __( 'All links', 'wp-live-preview-post' ),
					'class'       => __( 'class="livepreview"', 'wp-live-preview-post' ),
					'shortcode'   => __( '[livepreview] shortcode', 'wp-live-preview-post' )
				),
				'vDefault' 			=> 'site'
			),
			array(
				'strFieldID'         => 'dialog',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Live Preview Dialog', 'wp-live-preview-post' ),
				'strDescription'     => __( 'The preview dialog size.', 'wp-live-preview-post' ),
				'strType'            => 'size',
				'vLabel'             => array(
					'viewwidth'    => __( 'View Width', 'wp-live-preview-post' ),
					'viewheight'   => __( 'View Height', 'wp-live-preview-post' ),
				),
				'vSizeUnits'         => array(
					'viewwidth'    => array( 'px' => 'px', '%' => '%', 'em' => 'em' ),
					'viewheight'   => array( 'px' => 'px', '%' => '%', 'em' => 'em' ),
				),
				'vDefault'           => array(
					'viewwidth'    => array( 'size' => 300, 'unit' => 'px' ),
					'viewheight'   => array( 'size' => 200, 'unit' => 'px' ),
				),
				'vDelimiter'       => '<br />',
			),
			array(
				'strFieldID'         => 'target',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Site Viewport', 'wp-live-preview-post' ),
				'strDescription'     => __( 'The viewport size of the site you are previewing', 'wp-live-preview-post' ),
				'strType'            => 'size',
				'vLabel'             => array(
					'targetwidth'  => __( 'Target Width', 'wp-live-preview-post' ),
					'targetheight' => __( 'Target Height', 'wp-live-preview-post' ),
				),
				'vSizeUnits'         => array(
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
				'strDescription'     => __( 'The scaling of the viewport size of the site you are previewing (this is the CSS transform scale property), default = calculated automatically. Notes: If no scaling is specified (0), then the scaling is automatically calculated to provide the best fit to the preview dialog window size.', 'wp-live-preview-post' ),
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
			array(
				'strFieldID'         => 'postition',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Postition', 'wp-live-preview-post' ),
				'strDescription'     => __( 'Side to which the preview will open', 'wp-live-preview-post' ),
				'strType'            => 'radio',
				'vLabel'             => array( 'left' => 'Left', 'right' => 'Right'  ),
				'vDefault'           => 'right'
			)
		);

	}

}
