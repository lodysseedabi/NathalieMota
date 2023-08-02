<?php get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">

    <div class="publication">
      <div class="info-publication">
        <?php
        the_post();

        // Récupérer les champs ACF spécifiés
        $reference = get_field('reference');
        $type = get_field('type');
        $year = get_field('annee');
        $photo_image = get_field('photo');

        // Récupérer les catégories
        $terms = get_the_terms($post->ID, 'category');

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
      <div class="bloc-photo-publication">
        <?php
        // Afficher la photo
        if ($photo_image) {
          echo '<img class="photo-publication" src="' . esc_url($photo_image['url']) . '" alt="' . esc_attr($photo_image['alt']) . '">';
        }

        ?>
      </div>
    </div>

    <div class="demande-contact">
      <p> Cette photo vous intéresse ? </p>
      <button></button>
      photo suivante
    </div>

    <div class="suggestion">
      <p> Vous aimerez aussi </p>
      affichage photo suggéré
      <button>Toutes les photos</button>


  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>