<?php get_header(); ?>

<?php while ( have_posts() ) : the_post();
  $cats   = wp_get_post_terms( get_the_ID(), 'project_category' );
  $skills = wp_get_post_terms( get_the_ID(), 'skill' );
  $cat_name = ! empty( $cats ) ? $cats[0]->name : 'Project';
  $context  = get_post_meta( get_the_ID(), '_kc_context', true );
  $role     = get_post_meta( get_the_ID(), '_kc_role', true );
  $tools    = get_post_meta( get_the_ID(), '_kc_tools', true );
  $outcome  = get_post_meta( get_the_ID(), '_kc_outcome', true );
  $year     = get_post_meta( get_the_ID(), '_kc_year', true ) ?: get_the_date( 'Y' );
?>

<section class="page-hero bg-cream">
  <div class="page-hero__gingham pattern-gingham"></div>
  <div class="container" style="position:relative;z-index:1;">
    <p class="eyebrow reveal"><?php echo esc_html( $cat_name ); ?></p>
    <h1 class="t-display reveal reveal-delay-1"><?php the_title(); ?></h1>
    <p class="page-hero__sub reveal reveal-delay-2"><?php echo wp_trim_words( get_the_excerpt(), 30 ); ?></p>
  </div>
  <div class="page-hero__tape"></div>
</section>

<section class="section">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 300px;gap:4rem;align-items:start;">

      <!-- Main content -->
      <div>
        <?php if ( has_post_thumbnail() ) : ?>
        <div style="border-radius:var(--r-lg);overflow:hidden;margin-bottom:2.5rem;box-shadow:var(--shadow-md);">
          <?php the_post_thumbnail( 'kc-wide', [ 'style' => 'width:100%;height:auto;display:block;' ] ); ?>
        </div>
        <?php endif; ?>
        <div class="entry-content body-text">
          <?php the_content(); ?>
        </div>
      </div>

      <!-- Sidebar details -->
      <aside style="position:sticky;top:90px;">
        <div style="background:var(--c-cream);border:1px solid var(--c-light-gray);border-radius:var(--r-md);padding:1.5rem;border-left:3px solid var(--c-terracotta);">
          <div style="font-family:var(--f-sans);font-size:0.62rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:var(--c-terracotta);margin-bottom:1.25rem;">Project Details</div>
          <?php if ( $context ) : ?>
          <div style="margin-bottom:0.85rem;">
            <div style="font-family:var(--f-sans);font-size:0.6rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--c-mid-gray);margin-bottom:0.2rem;">Context</div>
            <div style="font-family:var(--f-sans);font-size:0.82rem;color:var(--c-ink);"><?php echo esc_html( $context ); ?></div>
          </div>
          <?php endif; ?>
          <?php if ( $role ) : ?>
          <div style="margin-bottom:0.85rem;">
            <div style="font-family:var(--f-sans);font-size:0.6rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--c-mid-gray);margin-bottom:0.2rem;">Role</div>
            <div style="font-family:var(--f-sans);font-size:0.82rem;color:var(--c-ink);"><?php echo esc_html( $role ); ?></div>
          </div>
          <?php endif; ?>
          <?php if ( $tools ) : ?>
          <div style="margin-bottom:0.85rem;">
            <div style="font-family:var(--f-sans);font-size:0.6rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--c-mid-gray);margin-bottom:0.2rem;">Tools</div>
            <div style="font-family:var(--f-sans);font-size:0.82rem;color:var(--c-ink);"><?php echo esc_html( $tools ); ?></div>
          </div>
          <?php endif; ?>
          <?php if ( $outcome ) : ?>
          <div style="margin-bottom:0.85rem;">
            <div style="font-family:var(--f-sans);font-size:0.6rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--c-mid-gray);margin-bottom:0.2rem;">Outcome</div>
            <div style="font-family:var(--f-sans);font-size:0.82rem;color:var(--c-ink);line-height:1.6;"><?php echo esc_html( $outcome ); ?></div>
          </div>
          <?php endif; ?>
          <?php if ( ! empty( $skills ) ) : ?>
          <div style="margin-top:1.25rem;">
            <div style="font-family:var(--f-sans);font-size:0.6rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--c-mid-gray);margin-bottom:0.5rem;">Skills &amp; Tools</div>
            <div class="tag-row">
              <?php foreach ( $skills as $skill ) : ?>
                <span class="tag"><?php echo esc_html( $skill->name ); ?></span>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endif; ?>
        </div>
        <div style="margin-top:1.25rem;display:flex;flex-direction:column;gap:0.75rem;">
          <a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>" class="btn btn-ghost" style="justify-content:center;">&larr; <?php esc_html_e( 'All Projects', 'kayla-canfield' ); ?></a>
          <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'contact' ) ) ); ?>" class="btn btn-primary" style="justify-content:center;"><?php esc_html_e( 'Get in Touch', 'kayla-canfield' ); ?></a>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php endwhile; ?>
<?php get_footer(); ?>
