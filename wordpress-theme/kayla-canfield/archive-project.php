<?php get_header(); ?>

<section class="page-hero bg-cream">
  <div class="page-hero__gingham pattern-gingham"></div>
  <div class="container" style="position:relative;z-index:1;">
    <p class="eyebrow reveal"><?php esc_html_e( 'Portfolio', 'kayla-canfield' ); ?></p>
    <h1 class="t-display reveal reveal-delay-1"><?php esc_html_e( 'Selected', 'kayla-canfield' ); ?> <em style="color:var(--c-terracotta);"><?php esc_html_e( 'Work', 'kayla-canfield' ); ?></em></h1>
  </div>
  <div class="page-hero__tape"></div>
</section>

<section class="section">
  <div class="container">
    <div class="projects-grid">
      <?php
      $i = 0;
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        $cats = wp_get_post_terms( get_the_ID(), 'project_category' );
        $cat_name = ! empty( $cats ) ? $cats[0]->name : '';
        $cat_slug = ! empty( $cats ) ? $cats[0]->slug : '';
        $delay_class = $i > 0 ? ' reveal-delay-' . min( $i % 3 + 1, 4 ) : '';
      ?>
      <article class="project-card reveal<?php echo esc_attr( $delay_class ); ?>" data-category="<?php echo esc_attr( $cat_slug ); ?>">
        <div class="project-card__img">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'kc-card' ); ?>
          <?php else : ?>
            <div class="work-card-pattern work-card-pattern--lines"></div>
            <div class="work-card-icon">&#x1F4CB;</div>
          <?php endif; ?>
        </div>
        <div class="project-card__body">
          <div class="project-card__header">
            <p class="card__cat"><?php echo esc_html( $cat_name ); ?></p>
            <span class="project-card__year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></span>
          </div>
          <h2 class="card__title"><?php the_title(); ?></h2>
          <p class="card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 30 ); ?></p>
          <?php
          $skills = wp_get_post_terms( get_the_ID(), 'skill' );
          if ( ! empty( $skills ) ) :
          ?>
          <div class="tag-row" style="margin-bottom:1rem;">
            <?php foreach ( array_slice( $skills, 0, 4 ) as $skill ) : ?>
              <span class="tag"><?php echo esc_html( $skill->name ); ?></span>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
          <a href="<?php the_permalink(); ?>" class="link-arrow"><?php esc_html_e( 'View Case Study', 'kayla-canfield' ); ?></a>
        </div>
      </article>
      <?php $i++; endwhile; endif; ?>
    </div>
    <?php the_posts_pagination( [ 'prev_text' => '&larr; Previous', 'next_text' => 'Next &rarr;' ] ); ?>
  </div>
</section>

<?php get_footer(); ?>
