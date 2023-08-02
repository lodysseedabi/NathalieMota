<?php get_header(); ?>

<div class="container-photos" id="photo-container">
  <div class="ligne-photos">
    <?php
    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 8,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
      $count = 0;
      while ($query->have_posts()) {
        $query->the_post();
        $count++;
        ?>
        <div class="col-2 photo-item">
          <!-- Affiche les photos dynamiquement -->
          <?php
          $photo_image = get_field('photo'); //Champ ACF 'photo'
          if ($photo_image) {
            ?>
            <img class="vignette" src="<?php echo esc_url($photo_image['url']); ?>" alt="<?php echo esc_attr($photo_image['alt']); ?>">
            <?php
          }
          ?>
        </div>
        <?php
        if ($count % 2 === 0) {
          echo '</div><div class="ligne-photos">'; // Nouvelle ligne toutes les 2 publications (2 colonnes x 1 ligne = 2)
        }
      }
    }
    ?>
  </div>
</div>


<div class="div-charger-plus">
    <div class="charger-plus">
      <button class="charger-plus-btn">Charger plus</button>
    </div>
  </div>
</div>

<script>
  // Envoyer le nombre actuel de posts_per_page à JavaScript
  var postsPerPage = <?php echo json_encode($query->query_vars['posts_per_page']); ?>;
</script>

<?php get_footer(); ?>
