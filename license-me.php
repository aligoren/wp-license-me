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
}

$licenses = new WPLicenseMe();
