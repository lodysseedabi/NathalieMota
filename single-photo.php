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
          echo '<p>Référence : ' . esc_html($reference) . '</p>';

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

      <div class="demande-contact">
        <div class="contact-photo">
          <p> Cette photo vous intéresse ? </p>
          <button class="bouton-single-photo">Contact</button>
        </div>
        <div class="photo-suiv-prec">
          <div class="contener-miniature-arrow">
            <div class="miniature">
              <?php if ($photo_image) {
                echo '<img class="photo-publication" src="' . esc_url($photo_image['url']) . '" alt="' . esc_attr($photo_image['alt']) . '">';
              } ?>
            </div>
            <div class="arrow-prec-suiv">
              <img src="<?php echo get_template_directory_uri() . '/assets/images/left arrow.png'; ?> "
                alt="arrow left">
              <img src="<?php echo get_template_directory_uri() . '/assets/images/right arrow.png'; ?> "
                alt="arrow right">
            </div>
          </div>
        </div>
      </div>

      <div class="suggestion">
        <div class="titre-suggestion">
          <h3> Vous aimerez aussi </h3>
        </div>
        <div class="photo-suggestion">
          affichage photo suggéré
        </div>
        <div class="bouton-suggestion">
          <button class="bouton-single-photo">Toutes les photos</button>
        </div>

      </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>