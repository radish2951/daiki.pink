<?php get_header(); ?>

<div class="content">
<?php while(have_posts()) : the_post(); ?>
<div <?php post_class(); ?>>
<?php the_content(); ?>
</div>
<?php endwhile; ?>
</div>

<?php get_footer(); ?>
