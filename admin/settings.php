<?php

defined( 'WPINC' ) or die;


if ( ! class_exists( 'AdminPageFramework' ) )
    include_once dirname( __FILE__ ) . '/admin-page-framework.min.php'; // https://github.com/michaeluno/admin-page-framework/

class WP_Live_Preview_Links_Settings extends AdminPageFramework {


    public function start_WP_Live_Preview_Links_Settings() {  // start_{extended class name} - this method gets automatically triggered at the end of the class constructor.

      if (! class_exists('RevealerCustomFieldType'))
           include_once(dirname( __FILE__ ) . '/RevealerCustomFieldType.php');
      $sClassName = get_class( $this );

      new RevealerCustomFieldType( $sClassName );
    }

    public function content_top_WP_Live_Preview_Links_Settings( $sContent )         {
        return  "<div class='plugin_icon' style='height:64px;width:64px;float:left;'>"
                  .  "<div class='dashicons dashicons-welcome-view-site' style='font-size:64px;'></div>"
              . "</div>"
              . "<div class='page_title'>"
                  . "<h1>Live Preview Links</h1>"
              . "</div>"
              . $sContent;
    }


    public function setUp() {
        $this->setRootMenuPage(
            __('Live Preview Links','wp-live-preview-links' ),
            version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ? 'dashicons-welcome-view-site' : null
        );

        $this->setPageTitleVisibility( false );
        $this->setCapability( 'manage_options' );
        //$this->setPageHeadingTabTag( 'h1' );
        $this->addSubMenuPage(
            array (
                'title'         =>  __('Live Preview Links','wp-live-preview-links' ),
                'page_slug'     =>  'wp_live_preview_links_options',
                'screen_icon'   =>  'options-general',
            )
        );

        $this->addSettingSections(
            array(
                'section_id'    => 'options',
                'page_slug'     => 'wp_live_preview_links_options'
            )
        );

        $this->addSettingFields(
            array(
                'field_id'      => 'link',
                'section_id'    => 'options',
                'title'         => __( 'Live Preview Links','wp-live-preview-links' ),
                'description'   => __( "Which links will trigger the live preview. Certain external sites may have set their X-FRAME-OPTIONS header policy to SAMEORGIN or DENY. This is specifically to prevent other sites from iframing their site for obvious reasons. If that is the case, this plugin will not work, and it's best to respect the site owner's wishes.", 'wp-live-preview-links' ),
                'type'          => 'revealer',
                'label'         => array(
                    'class'                           => __( 'class="wp-live-preview"', 'wp-live-preview-links' ),
                    'site'                            => __( 'Internal links only', 'wp-live-preview-links' ),
                    'external'                        => __( 'External links only', 'wp-live-preview-links' ),
                    'all'                             => __( 'All links', 'wp-live-preview-links' ),
                    '#fieldrow-options_custom'        => __( 'jQuery Selector (added below)', 'wp-live-preview-links' )
                ),
                'default'       => 'class'
            ),
            array( 
                'field_id'      => 'custom',
                'section_id'    => 'options',
                'title'         => 'jQuery Selector',
                'description'   => __( 'The <a href="http://www.w3schools.com/jquery/jquery_ref_selectors.asp">jQuery selector</a> must point to an anchor (link)', 'wp-live-preview-links' ),
                'type'          => 'text',
                'default'       => '',
                'hidden'        => true,
            ),
            array(
                'field_id'      => 'dialog',
                'section_id'    => 'options',
                'title'         => __( 'Live Preview Dialog', 'wp-live-preview-links' ),
                'description'   => __( 'The preview dialog size.', 'wp-live-preview-links' ),
                'type'          => 'size',
                // first label
                'label'         => __('Width', 'wp-live-preview-links'),
                'units'         => array( 'px' => 'px' /*, '%' => '%', 'em' => 'em'*/ ),
                'default'       => array( 'size' => 300, 'unit' => 'px' ),
                // second label
                array(
                    'label'     =>  __( 'Height', 'wp-live-preview-links' ),
                    'units'     =>  array( 'px' => 'px'/*, '%' => '%', 'em' => 'em'*/ ),
                    'default'   => array( 'size' => 200, 'unit' => 'px' ),
                ),
                'attributes'    => array(
                                         'size'       =>    array(
                                                                  'min' => 0
                                                            )
                ),
                'delimiter'     => '<br />',
            ),
            array(
                'field_id'      => 'target',
                'section_id'    => 'options',
                'title'         => __( 'Site Viewport', 'wp-live-preview-links' ),
                'description'   => __( 'The viewport size of the site you are previewing', 'wp-live-preview-links' ),
                'type'          => 'size',
                // first label
                'label'         => __('Width', 'wp-live-preview-links'),
                'units'         => array( 'px' => 'px' /*, '%' => '%', 'em' => 'em'*/ ),
                'default'       => array( 'size' => 1000, 'unit' => 'px' ),
                // second label
                array(
                    'label'     =>  __( 'Height', 'wp-live-preview-links' ),
                    'units'     =>  array( 'px' => 'px'/*, '%' => '%', 'em' => 'em'*/ ),
                    'default'   =>  array( 'size' => 800, 'unit' => 'px' ),
                ),
                'attributes'    => array(
                                         'size'        =>    array(
                                                                  'min' => 0
                                                            )
                ),
                'delimiter'     => '<br />',
            ),
            array(
                'field_id'      => 'scale',
                'section_id'    => 'options',
                'title'         => __( 'Scale', 'wp-live-preview-links' ),
                'type'          => 'number',
                'attributes'    => array(
                                        'max'          => 1.0,
                                        'min'          => 0,
                                        'step'         => 0.1,
                                        'style'           => 'text-align:right;'
                ),
                'default'       => 0,
                'description'   => __( 'The scaling of the viewport size of the site you are previewing (this is the CSS transform scale property), default = calculated automatically. Notes: If no scaling is specified (scale = 0), then the scaling is automatically calculated to provide the best fit to the preview dialog window size.', 'wp-live-preview-links' ),

            ),
            array(
                'field_id'      => 'offset',
                'section_id'    => 'options',
                'title'         => __( 'Offset', 'wp-live-preview-links' ),
                'description'   => __( 'The offset from the target in pixels', 'wp-live-preview-links' ),
                'type'          => 'size',
                'units'         => array( 'px' => 'px'/*, '%' => '%', 'em' => 'em'*/ ),
                'attributes'    => array(
                                         'size'         =>    array(
                                                                'max'               => 500,
                                                                'min'               => 0,
                                                                'step'              => 1,
                                                            )
                ),
                'default'        =>    array(
                    'size'       =>    50,
                    'unit'       =>    'px'
                ),
            ),
            array(
                'field_id'      => 'position',
                'section_id'    => 'options',
                'title'         => __( 'Postition', 'wp-live-preview-links' ),
                'description'   => __( 'Side to which the preview will open.', 'wp-live-preview-links' ),
                'type'          => 'radio',
                'label'         => array(
                                        'auto'  => __('Auto', 'wp-live-preview-links' ),
                                        'left'  => __('Left', 'wp-live-preview-links' ),
                                        'right' => __('Right', 'wp-live-preview-links' ),
                ),
                'default'       => 'auto'
            )
        );

    }

    public function do_WP_Live_Preview_Links_Settings() {
        submit_button();
        //update_option( 'WP_Live_Preview_Links_Settings', '' );
        //echo $this->oDebug->getArray( get_option( 'WP_Live_Preview_Links_Settings' ) );
    }

}
