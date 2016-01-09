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

require dirname( __FILE__ ) . '/license-type-functions.php';

function style_for_front_end()
{
    // Register the style like this for a plugin:
    wp_register_style( 'license-style', plugins_url( '/css/license-style.css', __FILE__ ), array(), '20160103', 'all' );
    wp_enqueue_style( 'license-style' );
}
add_action( 'wp_enqueue_scripts', 'style_for_front_end' );

add_action( 'admin_menu', 'license_me_menu' );

if( !function_exists("license_me_menu") ) {
function license_me_menu(){

	$page_title = 'WordPress License Post';
	$menu_title = 'License Posts';
	$capability = 'manage_options';
	$menu_slug  = 'license_me';
  $function   = 'license_admin_page';
	$icon_url   = 'dashicons-universal-access';
	$position   = 50;

	add_menu_page( $page_title,
					$menu_title,
					$capability,
					$menu_slug,
					$function,
					$icon_url,
					$position );
	}
}

function license_admin_page(){
  ?>
  <h1>Planlanıyor..</h1>
  <?php
}

function prfx_license_meta() {
    add_meta_box( 'license_meta', __( 'Set License Type', 'prfx-license' ), 'license_me_page', 'post', 'side' );
}
add_action( 'add_meta_boxes', 'prfx_license_meta' );

function prfx_license_save( $post_id ) {
  if( isset( $_POST[ 'post-license' ] ) ) {
    update_post_meta( $post_id, 'post-license', $_POST[ 'post-license' ] );
  }
}
add_action( 'save_post', 'prfx_license_save' );

function license_me_page($post){
    $prfx_stored_meta = get_post_meta( $post->ID );
	?>
  <select name="post-license" id="post-license">
       <option value="Creative Commons License" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'ccl' ); ?>><?php _e( 'Creative Commons License', 'prfx-license' )?></option>

       <option value="Apache License, Version 2.0" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'Apache License, Version 2.0' ); ?>><?php _e( 'Apache License, Version 2.0', 'prfx-license' )?></option>

       <option value="BSD 3-Clause License" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'BSD 3-Clause License' ); ?>><?php _e( 'BSD 3-Clause License', 'prfx-license' )?></option>

       <option value="BSD 2-Clause License" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'BSD 2-Clause License' ); ?>><?php _e( 'BSD 2-Clause License', 'prfx-license' )?></option>

       <option value="GNU General Public License, version 3" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'GNU General Public License, version 3' ); ?>><?php _e( 'GNU General Public License, version 3', 'prfx-license' )?></option>

       <option value="GNU General Public License, version 2" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'GNU General Public License, version 2' ); ?>><?php _e( 'GNU General Public License, version 2' )?></option>

       <option value="The GNU Lesser General Public License, version 3.0" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'The GNU Lesser General Public License, version 3.0' ); ?>><?php _e( 'The GNU Lesser General Public License, version 3.0', 'prfx-license' )?></option>

       <option value="The GNU Lesser General Public License, version 2.1" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'The GNU Lesser General Public License, version 2.1' ); ?>><?php _e( 'The GNU Lesser General Public License, version 2.1', 'prfx-license' )?></option>

       <option value="The MIT License" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'The MIT License' ); ?>><?php _e( 'The MIT License', 'prfx-license' )?></option>

       <option value="Mozilla Public License 2.0" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'Mozilla Public License 2.0' ); ?>><?php _e( 'Mozilla Public License 2.0', 'prfx-license' )?></option>

       <option value="Common Development and Distribution License" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'Common Development and Distribution License' ); ?>><?php _e( 'Common Development and Distribution License' )?></option>

       <option value="Eclipse Public License 1.0" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'Eclipse Public License 1.0' ); ?>><?php _e( 'Eclipse Public License 1.0', 'prfx-license' )?></option>

       <option value="Public Domain License" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'Public Domain License' ); ?>><?php _e( 'Public Domain License', 'prfx-license' )?></option>

       <option value="Unlicensed" <?php if ( isset ( $prfx_stored_meta['post-license'] ) ) selected( $prfx_stored_meta['post-license'][0], 'Unlicensed' ); ?>><?php _e( 'Unlicensed', 'prfx-license' )?></option>
   </select>
	<?php
}

if(!function_exists("license_me"))
{
  function license_me($content)
  {
    if (is_single()) {
    $post_meta    = get_post_meta( get_the_ID() );
    $license_type =  $post_meta['post-license'][0];
		switch($license_type){
			case 'Creative Commons License':
				return $content.'<div id="license_box">'.creative_commons().'</div>';
				break;
			case 'Apache License, Version 2.0':
				return $content.'<div id="license_box">'.apache_v2().'</div>';
				break;
			case 'BSD 3-Clause License':
				return $content.'<div id="license_box">'.bsd3_clause().'</div>';
				break;
			case 'BSD 2-Clause License':
				return $content.'<div id="license_box">'.bsd2_clause().'</div>';
				break;
			case 'GNU General Public License, version 3':
				return $content.'<div id="license_box">'.gpl_v3().'</div>';
				break;
			case 'GNU General Public License, version 2':
				return $content.'<div id="license_box">'.gpl_v2().'</div>';
				break;
			case 'The GNU Lesser General Public License, version 3.0':
				return $content.'<div id="license_box">'.lgpl_v3().'</div>';
				break;
			case 'The GNU Lesser General Public License, version 2.1':
				return $content.'<div id="license_box">'.lgpl_v21().'</div>';
				break;
			case 'The MIT License':
				return $content.'<div id="license_box">'.mit().'</div>';
				break;
			case 'Mozilla Public License 2.0':
				return $content.'<div id="license_box">'.mpl().'</div>';
				break;
			case 'Common Development and Distribution License':
				return $content.'<div id="license_box">'.cddl().'</div>';
				break;
			case 'Eclipse Public License 1.0':
				return $content.'<div id="license_box">'.epl().'</div>';
				break;
			case 'Public Domain License':
				return $content.'<div id="license_box">'.pdl().'</div>';
				break;
			case 'Unlicensed':
				return $content.'<div id="license_box">'.ul().'</div>';
				break;
			default:
				return $content;
				break;
	    }
    }
	return $content;
  }
}

add_filter('the_content', 'license_me');

?>
