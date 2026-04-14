<?php get_header(); ?>

<main style="padding: 8rem 5% 5rem; max-width: 800px; margin: 0 auto;">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <h1 style="font-size: clamp(1.8rem,3vw,2.5rem); font-weight:800; color:var(--navy); margin-bottom:2rem;">
      <?php the_title(); ?>
    </h1>
    <div style="color:var(--gray500); line-height:1.8; font-size:1rem;">
      <?php the_content(); ?>
    </div>
  <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
