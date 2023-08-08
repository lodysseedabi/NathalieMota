<?php get_header(); ?>
<div class="hero">
  <h1>Photographe Event</h1>
</div>

<div class=page-principale>
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