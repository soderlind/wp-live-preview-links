<?php

defined( 'WPINC' ) or die;

if ( ! class_exists( 'AdminPageFramework' ) )
	include_once dirname( __FILE__ ) . '/admin-page-framework.php';

class WP_Live_Preview_Links_Settings extends AdminPageFramework {

	public function setUp() {
		$this->setRootMenuPage(
			__('Live Preview Links','wp-live-preview-links' ),
			version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ? 'dashicons-welcome-view-site' : null
		);

		$this->showPageHeadingTabs( false );

		$this->addSubMenuPage(
			__('Live Preview Links','wp-live-preview-links' ),
			'wp_live_preview_links_options',
			'options-general'
		);

		$this->addHelpTab(
			array(
				'strPageSlug'         => 'wp_live_preview_links_options',
				'strHelpTabTitle'     => __('Live Preview Post','wp-live-preview-links' ),
				'strHelpTabID'        => 'general_options_help_introduction',
				'strHelpTabContent'   => __( 'This contextual help text can be set with the addHelpTab() method.', 'wp-live-preview-links' ),
			)
		);

		$this->addSettingSections(
			array(
				'strSectionID'       => 'options',
				'strPageSlug'        => 'wp_live_preview_links_options'
			)
		);

		$this->addSettingFields(
			array(
				'strFieldID'		=> 'link',
				'strSectionID'       => 'options',
				'strTitle'			=> __( 'Live Preview Links','wp-live-preview-links' ),
				'strDescription'	=> __( "Which links will trigger the live preview. Certain external sites may have set their X-FRAME-OPTIONS header policy to SAMEORGIN or DENY. This is specifically to prevent other sites from iframing their site for obvious reasons. If that is the case, this plugin will not work, and it's best to respect the site owner's wishes.", 'wp-live-preview-links' ),
				'strType'			=> 'select',
				'vLabel'            => array( 
					'class'       => __( 'class="wp-live-preview"', 'wp-live-preview-links' ),
					'site'        => __( 'Internal links only', 'wp-live-preview-links' ),
					'external'    => __( 'External links only', 'wp-live-preview-links' ),
					'all'         => __( 'All links', 'wp-live-preview-links' )
				),
				'vDefault' 			=> 'class'
			),
			array(
				'strFieldID'         => 'dialog',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Live Preview Dialog', 'wp-live-preview-links' ),
				'strDescription'     => __( 'The preview dialog size.', 'wp-live-preview-links' ),
				'strType'            => 'size',
				'vLabel'             => array(
					'width'    => __( 'Width', 'wp-live-preview-links' ),
					'height'   => __( 'Height', 'wp-live-preview-links' ),
				),
				'vSizeUnits'         => array(
					'width'    => array( 'px' => 'px' /*, '%' => '%', 'em' => 'em'*/ ),
					'height'   => array( 'px' => 'px'/*, '%' => '%', 'em' => 'em'*/ ),
				),
				'vDefault'           => array(
					'width'    => array( 'size' => 300, 'unit' => 'px' ),
					'height'   => array( 'size' => 200, 'unit' => 'px' ),
				),
				'vMin'               => array(
					'width'    => 0,
					'height'   => 0
				),
				'vDelimiter'       => '<br />',
			),
			array(
				'strFieldID'         => 'target',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Site Viewport', 'wp-live-preview-links' ),
				'strDescription'     => __( 'The viewport size of the site you are previewing', 'wp-live-preview-links' ),
				'strType'            => 'size',
				'vLabel'             => array(
					'width'  => __( 'Width', 'wp-live-preview-links' ),
					'height' => __( 'Height', 'wp-live-preview-links' ),
				),
				'vSizeUnits'         => array(
					'width'  => array( 'px' => 'px'/*, '%' => '%', 'em' => 'em'*/ ),
					'height' => array( 'px' => 'px'/*, '%' => '%', 'em' => 'em'*/ ),
				),
				'vDefault'           => array(
					'width'  => array( 'size' => 1000, 'unit' => 'px' ),
					'height' => array( 'size' => 800, 'unit' => 'px' ),
				),
				'vMin'               => array(
					'width'  => 0,
					'height' => 0
				),
				'vDelimiter'         => '<br />',
			),
			array(
				'strFieldID'         => 'scale',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Scale', 'wp-live-preview-links' ),
				'strType'            => 'number',
				'vMax'               => '1.0',
				'vMin'               => '0.0',
				'vStep'              => '0.1',
				'strDescription'     => __( 'The scaling of the viewport size of the site you are previewing (this is the CSS transform scale property), default = calculated automatically. Notes: If no scaling is specified (scale = 0), then the scaling is automatically calculated to provide the best fit to the preview dialog window size.', 'wp-live-preview-links' ),
				'vDefault'           =>  0,
			),
			array(
				'strFieldID'         => 'offset',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Offset', 'wp-live-preview-links' ),
				'strDescription'     => __( 'The offset from the target in pixels', 'wp-live-preview-links' ),
				'strType'            => 'size',
				'vSizeUnits'         => array( 'px' => 'px'/*, '%' => '%', 'em' => 'em'*/ ),
				'vMax'               => '500',
				'vMin'               => '0',
				'vStep'              => '1',
				'vDefault'           =>  50,
			),
			array(
				'strFieldID'         => 'position',
				'strSectionID'       => 'options',
				'strTitle'           => __( 'Postition', 'wp-live-preview-links' ),
				'strDescription'     => __( 'Side to which the preview will open.', 'wp-live-preview-links' ),
				'strType'            => 'radio',
				'vLabel'             => array( 
						'auto'  => __('Auto', 'wp-live-preview-links' ), 
						'left'  => __('Left', 'wp-live-preview-links' ),
						'right' => __('Right', 'wp-live-preview-links' ),
				),
				'vDefault'           => 'auto'
			)
		);

	}

	public function do_WP_Live_Preview_Links_Settings() {
        submit_button();
        //update_option( 'WP_Live_Preview_Links_Settings', '' );
        //echo $this->oDebug->getArray( get_option( 'WP_Live_Preview_Links_Settings' ) );       
    }

}
