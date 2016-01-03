<?php
/**
* Plugin Name: License Me
* Plugin URI: http://aligoren.com/license-me
* Description: License Your Posts
* Version: 1.0
* Author: Ali GOREN
* Author URI: http://aligoren.com
* License: Public Domain
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
	$function   = 'license_me_page';
	$icon_url   = 'dashicons-universal-access';
	$position   = 50;

	add_menu_page( $page_title,
					$menu_title,
					$capability,
					$menu_slug,
					$function,
					$icon_url,
					$position );

	add_action( 'admin_init', 'update_license_me' );

	}
}


if( !function_exists("update_license_me") ) {
	function update_license_me() {
		register_setting( 'license_me_settings', 'license_me' );
	}
}


if( !function_exists("license_me_page") ) {
	function license_me_page(){
	?>
	<h1>WordPress License Posts</h1>
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Selected License:</th>
			<td>
				<?php $type_license = get_option('license_me'); ?>
				<input type="text" value="<?php echo $type_license ? get_option('license_me') : 'Select License';  ?>" readonly disabled size="44"
				style="color:red; -moz-user-select: none; -webkit-user-select: none;
				-ms-user-select:none; user-select:none;-o-user-select:none;">
			</td>
		</tr>
	</table>
	<form method="post" action="options.php">
		<?php settings_fields( 'license_me_settings' ); ?>
		<?php do_settings_sections( 'license_me_settings' ); ?>
		<table class="form-table">
			<tr valign="top">
			<th scope="row">Set License Type:</th>
				<td>
					<select name="license_me">
						<option value="Creative Commons License">Creative Commons License</option>
						<option value="Apache License, Version 2.0">Apache License, Version 2.0</option>
						<option value="BSD 3-Clause License">BSD 3-Clause License</option>
						<option value="BSD 2-Clause License">BSD 2-Clause License</option>
						<option value="GNU General Public License, version 3">GNU General Public License, version 3</option>
						<option value="GNU General Public License, version 2">GNU General Public License, version 2</option>
						<option value="The GNU Lesser General Public License, version 3.0">The GNU Lesser General Public License, version 3.0</option>
						<option value="The GNU Lesser General Public License, version 2.1">The GNU Lesser General Public License, version 2.1</option>
						<option value="The MIT License">The MIT License</option>
						<option value="Mozilla Public License 2.0">Mozilla Public License 2.0</option>
						<option value="Common Development and Distribution License">Common Development and Distribution License</option>
						<option value="Eclipse Public License 1.0">Eclipse Public License 1.0</option>
						<option value="Public Domain License">Public Domain License</option>
						<option value="Unlicensed">Unlicensed</option>
					</select>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
	<?php
	}
}

if(!function_exists("license_me"))
{
  function license_me($content)
  {
    $license_type = get_option('license_me');
    if (is_single()) {
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
