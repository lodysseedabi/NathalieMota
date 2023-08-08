<?php get_header(); ?>
<div class="grid-photos">
  <?php
  $args = array(
    'post_type' => 'photo',
    'posts_per_page' => 12,
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
    <button class="charger-plus-btn">Charger plus</button>
  </div>
</div>

<script>
  // Envoyer le nombre actuel de posts_per_page à JavaScript
  var postsPerPage = <?php echo json_encode($query->query_vars['posts_per_page']); ?>;
</script>

<?php get_footer(); ?>