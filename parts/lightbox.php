<div id="container-lightbox-modal" class="container-lightboxmodal">
    <div id="lightboxModal" class="modal">
        <div class="carrousel-img-lightbox">
            <?php
            $reference = get_field('reference');
            $terms = get_the_terms($post->ID, 'category');
            $photo_image = get_field('photo');
            ?>
            <div class="cross-icon-lightbox">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/cross.png'; ?> " alt="icon cross">
            </div>
            <div class="contener-arrow-left">
                <img class="arrow-left"
                    src="' . esc_url(get_template_directory_uri() . '/assets/images/left arrow.png') . '"
                    alt="flèche gauche">
                <p>Précédente</p>
            </div>
            <div class="contener-photo-lightbox">
                <?php
                if ($photo_image) {
                    ?>
                    <img class="vignettes" src="<?php echo esc_url($photo_image['url']); ?>"
                        alt="<?php echo esc_attr($photo_image['alt']); ?>">
                    <?php
                }
                ?>
            </div>
            <div class="contener-arrow-right">
                <p>Suivante</p>
                <img class="arrow-right"
                    src="' . esc_url(get_template_directory_uri() . '/assets/images/right arrow.png') . '"
                    alt="flèche droite">
            </div>
        </div>

        <div class="contener-infos-lightbox">
            <?php
            // Afficher la référence
            echo '<p><span id="reference-photo">' . esc_html($reference) . '</span></p>';

            // Afficher la catégorie
            if (!empty($terms)) {
                echo '<p>';
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