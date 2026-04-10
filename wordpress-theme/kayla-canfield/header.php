<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="scroll-progress"></div>

<!-- Mobile Nav Overlay -->
<nav class="mobile-nav" aria-label="<?php esc_attr_e( 'Mobile navigation', 'kayla-canfield' ); ?>">
  <?php
  wp_nav_menu( [
    'theme_location' => 'primary',
    'container'      => false,
    'items_wrap'     => '%3$s',
    'walker'         => new Walker_Nav_Menu(),
  ] );
  ?>
</nav>

<!-- Site Header -->
<header class="site-header" id="site-header">
  <div class="header-inner">

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="<?php bloginfo( 'name' ); ?> home">
      <span class="site-logo__name"><?php bloginfo( 'name' ); ?></span>
      <span class="site-logo__tagline"><?php echo esc_html( get_theme_mod( 'kc_tagline_display', 'Instructional Designer · Writer · Researcher' ) ); ?></span>
    </a>

    <nav aria-label="<?php esc_attr_e( 'Primary navigation', 'kayla-canfield' ); ?>">
      <?php
      wp_nav_menu( [
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'site-nav',
        'items_wrap'     => '<ul class="site-nav">%3$s</ul>',
      ] );
      ?>
    </nav>

    <div class="header-actions">
      <?php $cv_url = get_theme_mod( 'kc_cv_url', '' ); ?>
      <?php if ( $cv_url ) : ?>
        <a href="<?php echo esc_url( $cv_url ); ?>" class="btn btn-outline" target="_blank" rel="noopener">
          <?php esc_html_e( 'Download CV', 'kayla-canfield' ); ?>
        </a>
      <?php endif; ?>
      <button class="hamburger" aria-label="<?php esc_attr_e( 'Toggle menu', 'kayla-canfield' ); ?>" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
    </div>

  </div>
</header>
