<?php echo $content; ?>

<div class="license_box" style="background-color:<?php echo get_option("bg_color"); ?> !important">
    <a class="img_deco" rel="license" href="<?php echo $license['link']; ?>" target="_blank">
        <img class="img_license" src="<?php echo $license['image']; ?>" />
    </a>
    <span style="color:<?php echo get_option("text_color"); ?> !important">
        <?php _e('This post is licensed under a', 'license-me'); ?>
        <a rel="license_deco" style="color: <?php echo get_option("a_color"); ?> !important"  href="<?php echo $license['link']; ?>" target="_blank">
            <?php echo $license['title']; ?>
        </a>
    </span>
</div>
