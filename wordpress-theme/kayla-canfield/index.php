<?php get_header(); ?>
<section class="section">
  <div class="container container--narrow">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article class="blog-card" style="margin-bottom:2rem;">
      <div class="blog-card__body">
        <div class="blog-card__meta">
          <span class="blog-card__cat"><?php the_category( ', ' ); ?></span>
          <span class="blog-card__date"><?php echo esc_html( get_the_date( 'F Y' ) ); ?></span>
        </div>
        <h2 class="blog-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="blog-card__excerpt"><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="link-arrow"><?php esc_html_e( 'Read Post', 'kayla-canfield' ); ?></a>
      </div>
    </article>
    <?php endwhile; endif; ?>
    <?php the_posts_pagination(); ?>
  </div>
</section>
<?php get_footer(); ?>
