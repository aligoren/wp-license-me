<?php
/**
 * Plugin Name: License Me
 * Plugin URI: https://github.com/aligoren/wp-license-me
 * Description: License Your Posts
 * Version: 1.0
 * Author: Adil ÖZTAŞER, Ali GOREN
 * License: Unlicensed
 */

class WPLicenseMe {

    public function __construct()
    {
        $this->load_dependecies();

        register_activation_hook( __FILE__, array( $this, 'install' ) );

        add_action( 'the_content', array( $this, 'render_content_box') );

        add_action( 'wp_enqueue_scripts', array( $this, 'load_style' ) );
    }

    public function load_style()
    {
        wp_register_style( 'license-style', plugins_url( '/assets/css/license-style.css', __FILE__ ) );
        wp_enqueue_style( 'license-style' );
    }

    static function install()
    {
        $license = new License( false );
        $json_content = $license->get_licenses();

        // Add an option for all licenses
        add_option( 'wp_license_me', $json_content, '', 'yes');

        // Add an option for each license
        $licenses = json_decode( $json_content, true );
        foreach ( $licenses as $license => $license_info ) {
            add_option ( $license, json_encode( $license_info ), '', 'yes');
        }
    }

    /*
     * Load the required dependecies for the plugin
     */
    private function load_dependecies()
    {
        require_once( plugin_dir_path( __FILE__ ) . 'lib/license.php' );

        require_once( plugin_dir_path( __FILE__ ) . 'admin/license-me-admin.php' );
        $admin = new LicenseMeAdmin();
    }

    public function render_content_box( $content )
    {
        if ( is_single() )
        {
            $post_license_meta = get_post_meta( get_the_ID(), 'post-license' );
            $post_license_meta = $post_license_meta[0];
            if ( isset( $post_license_meta ) )
            {
                $post_license = new License();
                $license = $post_license->get_license( $post_license_meta );
                $license['image'] = plugin_dir_url( __FILE__  ) . '/assets/img/' . $license['image'];

                require plugin_dir_path( __FILE__ ) . 'template/license-box.php';
            }
        }
        else
        {
            return $content;
        }
    }
}

$licenses = new WPLicenseMe();
