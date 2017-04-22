<?php

class LicenseMeAdmin {

    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_admin_page') );
        add_action( 'add_meta_boxes', array( $this, 'register_meta_box' ) );
        add_action( 'save_post', array( $this, 'license_meta_save') );
        add_action( 'admin_init', array( $this, 'license_register_settings' ) );
    }

    public function license_register_settings()
    {
        register_setting('license_me_settings', 'bg_color');
        register_setting('license_me_settings', 'a_color');
        register_setting('license_me_settings', 'text_color');
    }

    public function add_admin_page()
    {
        add_menu_page (
            __( 'Wordpress License Post', 'license-me' ),
            __( 'License Posts', 'license-me' ),
            'manage_options',
            'license-me',
            array( $this, 'render_admin_page' ),
            'dashicons-universal-access',
            50
        );
    }

    public function render_admin_page()
    {
        require plugin_dir_path( __FILE__ ) . '/partials/index.php';
    }

    public function register_meta_box()
    {
        add_meta_box(
           'license_meta',
            __( 'Set License Type', 'license-me' ),
            array( $this, 'render_meta_box' ),
            'post',
            'side'
        );
    }

    public function license_meta_save( $post_id )
    {
        if ( isset( $_POST['post-license'] ) )
        {
            update_post_meta(
                $post_id,
                'post-license',
                $_POST[ 'post-license' ]
            );
        }
    }

    public function render_meta_box( $post )
    {
        $license = new License();
        $all_licenses = $license->get_licenses();

        $post_license = get_post_meta( $post->ID, 'post-license' );

        require plugin_dir_path( __FILE__ ) . '/partials/meta_box.php';
    }
}
