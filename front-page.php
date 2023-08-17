<?php get_header(); ?>
<div class="hero">
<?php
$query_args = array(
    'orderby' => 'rand',            // Ordonner aléatoirement
    'posts_per_page' => 1,          
    'post_type' => 'photo',          
);

$random_query = new WP_Query($query_args);

if ($random_query->have_posts()) : while ($random_query->have_posts()) : $random_query->the_post();
    $photo_image = get_field('photo'); 

    if (is_array($photo_image) && count($photo_image) > 0) {
        $random_index = array_rand($photo_image);
        $random_image_url = $photo_image[$random_index];
        echo '<img class="img-hero" src="' . esc_url($photo_image['url']) . '" alt="Image aléatoire">';
        echo '<h1>Photographe Event</h1>';
        echo '</div>';
    } else {
        echo 'Aucune image trouvée.';
    }
endwhile;

endif;

// Réinitialiser la requête
wp_reset_postdata();
?>

</div>

<div class=page-principale>
  <div class="filtres">
    <div class="contener-filtre">
      <select id="categorie-filter">
        <option value="categorie">Catégories</option>
        <?php
        $categories = get_categories();
        foreach ($categories as $category) {
          if ($category->parent == 3) {
            echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
          }

        }
        ?>
      </select>

      <select id="format-filter">
        <option value="format">Formats</option>
        <?php
        foreach ($categories as $category) {
          if ($category->parent == 8) {
            echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
          }

        }
        ?>
      </select>
    </div>
    <div class="contener-tri">
      <select id="sort-order">
        <option value="all">Trier par</option>
        <option value="desc">Des plus récentes aux plus anciennes</option>
        <option value="asc">Des plus anciennes aux plus récentes</option>
      </select>
    </div>
  </div>

  <div class="grid-photos">
    <?php
    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 12,
      'order' => 'ASC',
      'orderby' => 'date',
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

        <?php
      }
    }
    ?>
  </div>

  <div class="div-charger-plus">
    <div class="charger-plus">
      <button class="charger-plus-btn" data-page="2" data-max-pages="<?php echo $query->max_num_pages; ?>"
        data-nonce="<?php echo wp_create_nonce('load_more_photos'); ?>">
        Charger plus
      </button>
    </div>
  </div>
</div>


<?php get_footer(); ?>