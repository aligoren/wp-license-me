<select name="post-license" id="post-license">
    <?php foreach ( $all_licenses as $license => $info ): ?>
        <option value="<?php echo $license; ?>"
            <?php
                if ( isset ( $post_license ) )
                    selected( $post_license[0], $license ); ?>
         >
            <?php echo $info['title'] ?>
        </option>
    <?php endforeach; ?>
</select>
