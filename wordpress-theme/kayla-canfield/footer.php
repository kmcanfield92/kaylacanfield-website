<footer class="site-footer" aria-label="<?php esc_attr_e( 'Site footer', 'kayla-canfield' ); ?>">
  <div class="footer-inner">
    <div class="footer-top">

      <div class="footer-brand">
        <div class="footer-brand__name"><?php bloginfo( 'name' ); ?></div>
        <div class="footer-brand__tagline"><?php echo esc_html( get_theme_mod( 'kc_tagline_display', 'Instructional Designer · Writer · Researcher' ) ); ?></div>
        <p class="footer-brand__desc"><?php bloginfo( 'description' ); ?></p>
      </div>

      <div class="footer-col">
        <div class="footer-col__title"><?php esc_html_e( 'Navigate', 'kayla-canfield' ); ?></div>
        <?php
        wp_nav_menu( [
          'theme_location' => 'footer',
          'container'      => false,
          'menu_class'     => 'footer-links',
          'items_wrap'     => '<ul class="footer-links">%3$s</ul>',
          'depth'          => 1,
        ] );
        ?>
      </div>

      <div class="footer-col">
        <div class="footer-col__title"><?php esc_html_e( 'Work Areas', 'kayla-canfield' ); ?></div>
        <ul class="footer-links">
          <li><a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><?php esc_html_e( 'Instructional Design', 'kayla-canfield' ); ?></a></li>
          <li><a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><?php esc_html_e( 'Training &amp; Systems', 'kayla-canfield' ); ?></a></li>
          <li><a href="<?php echo esc_url( get_post_type_archive_link( 'writing' ) ); ?>"><?php esc_html_e( 'Academic Writing', 'kayla-canfield' ); ?></a></li>
          <li><a href="<?php echo esc_url( get_post_type_archive_link( 'writing' ) ); ?>"><?php esc_html_e( 'Research', 'kayla-canfield' ); ?></a></li>
        </ul>
      </div>

      <div class="footer-col">
        <div class="footer-col__title"><?php esc_html_e( 'Connect', 'kayla-canfield' ); ?></div>
        <ul class="footer-links">
          <?php $linkedin = get_theme_mod( 'kc_linkedin', '' ); ?>
          <?php if ( $linkedin ) : ?>
            <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'LinkedIn', 'kayla-canfield' ); ?></a></li>
          <?php endif; ?>
          <?php $email = get_theme_mod( 'kc_email', '' ); ?>
          <?php if ( $email ) : ?>
            <li><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php esc_html_e( 'Email', 'kayla-canfield' ); ?></a></li>
          <?php endif; ?>
          <?php $cv = get_theme_mod( 'kc_cv_url', '' ); ?>
          <?php if ( $cv ) : ?>
            <li><a href="<?php echo esc_url( $cv ); ?>" target="_blank"><?php esc_html_e( 'Download CV', 'kayla-canfield' ); ?></a></li>
          <?php endif; ?>
        </ul>
      </div>

    </div>

    <div class="footer-bottom">
      <p class="footer-copy">
        &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?> &mdash;
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( parse_url( home_url(), PHP_URL_HOST ) ); ?></a>
      </p>
      <ul class="footer-bottom-links">
        <li><a href="#"><?php esc_html_e( 'Accessibility', 'kayla-canfield' ); ?></a></li>
        <li><a href="<?php echo esc_url( get_sitemap_url( 'index' ) ); ?>"><?php esc_html_e( 'Sitemap', 'kayla-canfield' ); ?></a></li>
      </ul>
    </div>
  </div>
</footer>

<button id="back-to-top" aria-label="<?php esc_attr_e( 'Back to top', 'kayla-canfield' ); ?>"
  style="position:fixed;bottom:2rem;right:2rem;width:44px;height:44px;border-radius:50%;background:var(--c-terracotta);color:var(--c-warm-white);border:none;cursor:pointer;font-size:1.1rem;box-shadow:var(--shadow-md);opacity:0;transition:opacity 0.3s;z-index:100;">&#x2191;</button>

<?php wp_footer(); ?>
</body>
</html>
