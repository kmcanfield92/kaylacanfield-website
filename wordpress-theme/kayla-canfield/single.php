<?php get_header(); ?>
<section class="section">
  <div class="container container--narrow">
    <?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header style="margin-bottom:2.5rem;">
        <p class="eyebrow"><?php the_category( ' &middot; ' ); ?></p>
        <h1 class="t-h1" style="margin-bottom:0.5rem;"><?php the_title(); ?></h1>
        <p class="t-caption"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?> &nbsp;&middot;&nbsp; <?php echo esc_html( get_the_author() ); ?></p>
        <hr class="rule-gold" />
      </header>
      <div class="entry-content body-text">
        <?php the_content(); ?>
      </div>
      <footer style="margin-top:3rem;">
        <?php the_tags( '<div class="tag-row">', '', '</div>' ); ?>
      </footer>
    </article>
    <?php endwhile; ?>
  </div>
</section>
<?php get_footer(); ?>
