<?php get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <div class="single-page-body">
      <div class="publication">
        <?php // Récupérer les champs ACF spécifiés
        $reference = get_field('reference');
        $type = get_field('type');
        $year = get_field('annee');
        $photo_image = get_field('photo');

        // Récupérer les catégories
        $terms = get_the_terms($post->ID, 'category'); ?>

        <div class="bloc-photo-publication-mobile">
          <?php
          // Afficher la photo
          if ($photo_image) {
            echo '<img class="photo-publication" src="' . esc_url($photo_image['url']) . '" alt="' . esc_attr($photo_image['alt']) . '">';
          }

          ?>
        </div>

        <div class="info-publication">
          <?php
          the_post();



          //Afficher le titre
          the_title('<h2>', '</h2>');

          // Afficher la référence
          echo '<p>Référence : <span id="reference-photo">' . esc_html($reference) . '</span></p>';

          // Afficher la catégorie
          if (!empty($terms)) {
            echo '<p>Catégorie : ';
            foreach ($terms as $term) {
              if ($term->parent == 3) {
                echo $term->name;
              }
            }
            echo '</p>';

            // Afficher le format
            echo '<p>Format : ';
            foreach ($terms as $term) {
              if ($term->parent == 8) {
                echo $term->name;
              }
            }
            echo '</p>';
          }
          // Afficher le type
          echo '<p>Type : ' . esc_html($type) . '</p>';

          // Afficher l'année
          echo '<p>Année : ' . esc_html($year) . '</p>';

          ?>
        </div>
        <div class="bloc-photo-publication-desktop">
          <?php
          // Afficher la photo
          if ($photo_image) {
            echo '<img class="photo-publication" src="' . esc_url($photo_image['url']) . '" alt="' . esc_attr($photo_image['alt']) . '">';
          }

          ?>
        </div>
      </div>

      <!-- Miniature pour faire défilier les photos -->
      <?php
      $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1,
        //Pour récupérer tous les posts
        'order' => 'ASC',
        'orderby' => 'date',
        'post__not_in' => array($post->ID), // Exclure la publication actuelle
      );

      ?>

      <div class="demande-contact">
        <div class="contact-photo">
          <p> Cette photo vous intéresse ? </p>
          <a class="bouton-contact-single-photo" href="#contactphoto">Contact</a>
        </div>
        <div class="photo-suiv-prec">
          <div class="contener-miniature-arrow">
            <div class="miniature">
            <img id="current-photo" class="photo-publication" src="<?php echo esc_url($photo_image['url']); ?>"
                alt="Photo actuelle">
            </div>
            <div class="arrow-prec-suiv">
              <?php
              $post_precedent = get_previous_post();
              if (!empty($post_precedent)) {
                $photo_post_precedent = get_field('photo', $post_precedent->ID);
                if ($photo_post_precedent) {
                  echo '<a href="' . get_permalink($post_precedent) . '" class="prev-photo">';
                  echo '<img class="arrow-left" src="' . esc_url(get_template_directory_uri() . '/assets/images/left arrow.png') . '" alt="flèche gauche">';
                  echo '<span class="thumbnail-prev" style="background-image: url(' . esc_url($photo_post_precedent['url']) . ');"></span>';
                  echo '</a>';
                }
              }

              $post_suivant = get_next_post();
              if (!empty($post_suivant)) {
                $photo_post_suivant = get_field('photo', $post_suivant->ID);
                if ($photo_post_suivant) {
                  echo '<a href="' . get_permalink($post_suivant) . '" class="next-photo">';
                  echo '<img class="arrow-right" src="' . esc_url(get_template_directory_uri() . '/assets/images/right arrow.png') . '" alt="flèche droite">';
                  echo '<span class="thumbnail-next" style="background-image: url(' . esc_url($photo_post_suivant['url']) . ');"></span>';
                  echo '</a>';
                }
              }
              ?>
            </div>

          </div>
        </div>
      </div>


      <div class="suggestion">
        <div class="titre-suggestion">
          <h3> Vous aimerez aussi </h3>
        </div>

        <!-- Grille de photos -->
        <div class="grid-photos">

          <?php
          // Récupérer les catégories de la publication actuelle
          $current_post_categories = get_the_terms($post->ID, 'category');
          $current_category_ids = array();

          if (!empty($current_post_categories)) {
            foreach ($current_post_categories as $current_category) {
              if ($current_category->parent == 3) {
                // On ajoute seulement les ID des catégories enfant de la catégorie parent (id = 3)
                $current_category_ids[] = $current_category->term_id;
              }
            }
          }

          $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 2,
            'tax_query' => array(
              array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $current_category_ids,
              ),
            ),
            'post__not_in' => array($post->ID), // Exclure la publication actuelle
          );


          $query = new WP_Query($args);

          if ($query->have_posts()) {
            $count = 0;
            while ($query->have_posts()) {
              $query->the_post();
              $count++;
              ?>

              <!-- Affiche les photos dynamiquement -->
              <?php get_template_part('parts/photo-block'); ?>
            <?php }
          } ?>
        </div>

        <div class="bouton-suggestion">
          <a class="bouton-single-photo" href="<?php echo esc_url(home_url('/')); ?>">Toutes les photos</a>
        </div>

      </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>