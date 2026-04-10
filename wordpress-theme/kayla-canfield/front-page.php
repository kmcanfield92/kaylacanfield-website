<?php get_header(); ?>

<!-- ── HERO ─────────────────────────────────────────────────── -->
<section class="hero" aria-label="Introduction">
  <div class="hero__bg-pattern pattern-gingham"></div>
  <div class="hero__tape-top"></div>
  <div class="hero__inner container">
    <div class="hero__content">
      <p class="eyebrow reveal">Instructional Designer &middot; Writer &middot; Researcher</p>
      <h1 class="hero__headline reveal reveal-delay-1">
        I design learning<br>
        <em>materials, systems,</em><br>
        and writing projects.
      </h1>
      <p class="hero__sub reveal reveal-delay-2">
        My work sits at the intersection of instructional design, research, and writing. I build clear materials people can use and I write about culture, history, and education.
      </p>
      <div class="hero__actions reveal reveal-delay-3">
        <a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'View My Work', 'kayla-canfield' ); ?></a>
        <a href="<?php echo esc_url( get_post_type_archive_link( 'writing' ) ); ?>" class="btn btn-outline"><?php esc_html_e( 'Read Writing', 'kayla-canfield' ); ?></a>
      </div>
    </div>
    <div class="hero__visual reveal reveal-delay-2">
      <?php
      // Pull the most recent featured project
      $featured = new WP_Query( [ 'post_type' => 'project', 'posts_per_page' => 1, 'meta_key' => '_kc_featured', 'meta_value' => '1' ] );
      if ( ! $featured->have_posts() ) {
        $featured = new WP_Query( [ 'post_type' => 'project', 'posts_per_page' => 1 ] );
      }
      if ( $featured->have_posts() ) : while ( $featured->have_posts() ) : $featured->the_post();
        $category = wp_get_post_terms( get_the_ID(), 'project_category' );
        $cat_name = ! empty( $category ) ? $category[0]->name : 'Portfolio';
      ?>
      <div class="hero__card">
        <div class="hero__card-tape"></div>
        <span class="hero__card-cat"><?php echo esc_html( $cat_name ); ?></span>
        <h2 class="hero__card-title"><?php the_title(); ?></h2>
        <p class="hero__card-meta"><?php echo esc_html( get_the_date( 'Y' ) ); ?></p>
        <p class="hero__card-body"><?php echo wp_trim_words( get_the_excerpt(), 28 ); ?></p>
        <a href="<?php the_permalink(); ?>" class="link-arrow"><?php esc_html_e( 'View Case Study', 'kayla-canfield' ); ?></a>
        <div class="hero__card-stamp"><span>Portfolio</span><span style="font-size:0.8rem;font-weight:700;"><?php echo esc_html( get_the_date( 'Y' ) ); ?></span></div>
      </div>
      <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>
  </div>
</section>

<!-- ── FEATURED WORK ─────────────────────────────────────────── -->
<section class="featured-work section" aria-label="Featured work">
  <div class="container">
    <div class="section-header flex-between" style="margin-bottom:var(--space-md);">
      <div>
        <p class="eyebrow reveal"><?php esc_html_e( 'Portfolio', 'kayla-canfield' ); ?></p>
        <h2 class="t-h1 reveal reveal-delay-1"><?php esc_html_e( 'Selected', 'kayla-canfield' ); ?> <em style="color:var(--c-terracotta);"><?php esc_html_e( 'Work', 'kayla-canfield' ); ?></em></h2>
      </div>
      <a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="link-arrow reveal"><?php esc_html_e( 'View All Projects', 'kayla-canfield' ); ?></a>
    </div>

    <div class="work-grid">
      <?php
      $projects = new WP_Query( [ 'post_type' => 'project', 'posts_per_page' => 4 ] );
      $i = 0;
      if ( $projects->have_posts() ) : while ( $projects->have_posts() ) : $projects->the_post();
        $cats = wp_get_post_terms( get_the_ID(), 'project_category' );
        $cat_name = ! empty( $cats ) ? $cats[0]->name : '';
        $cat_slug = ! empty( $cats ) ? $cats[0]->slug : '';
        $delay_class = $i > 0 ? ' reveal-delay-' . min( $i, 4 ) : '';
        $featured_class = $i === 0 ? ' card--featured' : ' card--paper';
      ?>
      <article class="card<?php echo esc_attr( $featured_class ); ?> reveal<?php echo esc_attr( $delay_class ); ?>" data-category="<?php echo esc_attr( $cat_slug ); ?>">
        <div class="card__img">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'kc-card' ); ?>
          <?php else : ?>
            <div class="work-card-pattern work-card-pattern--lines"></div>
            <div class="work-card-icon">&#x1F4CB;</div>
          <?php endif; ?>
        </div>
        <div class="card__body">
          <p class="card__cat"><?php echo esc_html( $cat_name ); ?></p>
          <h3 class="card__title"><?php the_title(); ?></h3>
          <p class="card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 22 ); ?></p>
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
      <?php $i++; endwhile; wp_reset_postdata(); endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
