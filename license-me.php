<?php
/**
* Plugin Name: License Me
* Plugin URI: http://aligoren.com/license-me
* Description: License Your Posts
* Version: 1.0
* Author: Adil ÖZTAŞER, Ali GOREN
* Author URI: http://aligoren.com, http://oztaser.com/
* License: Unlicensed
 */

class WPLicenseMe {

    const JSON_FILE_NAME = 'licenses.json';

    public function __construct()
    {
        register_activation_hook( __FILE__, array( $this, 'install' )) ;

        $this->load_dependecies();
    }

    static function install()
    {
        // Load json file content
        $json_content = file_get_contents( plugin_dir_url( __FILE__ )  . self::JSON_FILE_NAME );

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
        require_once( $this->get_dir_url() . 'admin/license-me-admin.php' );
    }

    private function get_dir_url()
    {
        return plugin_dir_path( __FILE__ );
    }
}

$licenses = new WPLicenseMe();
