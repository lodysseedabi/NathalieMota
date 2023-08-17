<?php
$reference = get_field('reference');
$terms = get_the_terms($post->ID, 'category');
$photo_image = get_field('photo');
$post_permalink = get_permalink();
?>

<div class="photo-item">
    <div class="photo-container">
        <div class="ligne-photos">
            <?php
            if ($photo_image) {
                ?>
                <img class="vignettes" src="<?php echo esc_url($photo_image['url']); ?>"
                    alt="<?php echo esc_attr($photo_image['alt']); ?>">
                <?php
            }
            ?>
        </div>
    </div>

    <div class="calque-photo">
        <div class="contener-fullscreen">
            <a href="#lightbox">
                <img class="icon-fullscreen"
                    src="<?php echo get_template_directory_uri() . './assets/images/Icon_fullscreen.png'; ?>"
                    alt="Icône Fullscreen">
            </a>
        </div>
        <div class="contener-eye">
            <a href="<?php echo esc_url($post_permalink); ?>">
                <img src="<?php echo get_template_directory_uri() . './assets/images/Icon_eye.png'; ?>"
                    alt="Icône oeil">
            </a>
        </div>
        <div class="contener-infos">
            <?php
            // Afficher la référence
            echo '<p><span class="ref-photo">' . esc_html($reference) . '</span></p>';

            // Afficher la catégorie
            if (!empty($terms)) {
                echo '<p><span class="legend">';
                foreach ($terms as $term) {
                    if ($term->parent == 3) {
                        echo $term->name;
                    }
                }
                echo '</p>';
            }
            ?>
        </div>
    </div>
</div>