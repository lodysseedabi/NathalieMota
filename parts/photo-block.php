<div class="ligne-photos">
    <?php
    $photo_image = get_field('photo'); //Champ ACF 'photo'
    if ($photo_image) {
        ?>
        <img class="vignettes" src="<?php echo esc_url($photo_image['url']); ?>"
            alt="<?php echo esc_attr($photo_image['alt']); ?>">
        <?php
    }
    ?>
</div>