<?php get_header(); ?>

<main style="padding: 6rem 5% 4rem; max-width: 1100px; margin: 0 auto;">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
