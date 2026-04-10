<?php get_header(); ?>
<section class="section">
  <div class="container container--narrow">
    <?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header class="page-hero bg-cream" style="padding:3rem 0 2.5rem;margin-bottom:3rem;">
        <div class="page-hero__gingham pattern-gingham"></div>
        <div class="container" style="position:relative;z-index:1;">
          <h1 class="t-display reveal"><?php the_title(); ?></h1>
        </div>
      </header>
      <div class="entry-content body-text">
        <?php the_content(); ?>
      </div>
    </article>
    <?php endwhile; ?>
  </div>
</section>
<?php get_footer(); ?>
