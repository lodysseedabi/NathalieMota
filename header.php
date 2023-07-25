<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <?php wp_head(); ?>
</head>

<header>
  <nav>
    <div class="header">
      <img class='logo' src="<?php echo get_template_directory_uri() . '/assets/images/Logo.png'; ?>"
        alt="Logo de Nathalie Mota">
      <?php wp_nav_menu('Menu Principal') ?>
      <div class="mobile-menu">
        <?php wp_nav_menu('Menu Principal') ?>
      </div>
        <div class="hamburger-icon">
          <img src="<?php echo get_template_directory_uri() . '/assets/images/burger.png'; ?> " alt="icon hamburger">
        </div>
        <div class="cross-icon">
          <img src="<?php echo get_template_directory_uri() . '/assets/images/cross.png'; ?> " alt="icon cross">
        </div>
      
    </div>
  </nav>
</header>

<body <?php body_class(); ?>>

  <?php wp_body_open(); ?>