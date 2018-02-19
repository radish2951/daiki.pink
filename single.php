<?php get_header(); ?>
<div class="content">

<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (in_category('photo')) : the_content(); ?>
    <h1><?php the_title(); ?></h1>
    <?php else : ?>
    <header class="post-header">
    <h1><?php the_title(); ?></h1>
    <div class="post-meta">
        <div class="post-date"><?php the_date('Y年m月d日'); ?></div>
        <div class="post-tags"><?php the_tags(''); ?></div>
    </div>
    </header>
    <?php the_content(); endif; ?>
</article>
<?php
endwhile; endif; ?>

</div>

<?php get_footer(); ?>
