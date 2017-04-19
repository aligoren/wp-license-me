<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#bg_color').wpColorPicker();
        $('#a_color').wpColorPicker();
        $('#text_color').wpColorPicker();
    });
    </script>

  <form method="post" action="options.php">
 	  <?php settings_fields( 'license_me_settings' ); ?>
		<?php do_settings_sections( 'license_me_settings' ); ?>
       <h4>Arkaplan Rengi:</h4> <input name="bg_color" type="text" id="bg_color" value="<?php echo get_option("bg_color"); ?>" data-default-color="<?php echo get_option("bg_color"); ?>">
       <h4>Link Rengi:</h4> <input name="a_color" type="text" id="a_color" value="<?php echo get_option("a_color"); ?>" data-default-color="<?php echo get_option("a_color"); ?>">
       <h4>Yazı Rengi:</h4> <input name="text_color" type="text" id="text_color" value="<?php echo get_option("text_color"); ?>" data-default-color="<?php echo get_option("text_color"); ?>">

		<?php submit_button(); ?>
	</form>
