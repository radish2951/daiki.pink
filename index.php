<?php get_header(); ?>

<div class="content">
<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="post-header">
     <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
     <div class="post-meta">
        <div class="post-date"><?php echo get_the_date('Y年m月d日'); ?></div>
        <div class="post-tags"><?php the_tags(''); ?></div>
    </div> 
    </header>
    <?php the_content(); ?>
</div>
<?php
endwhile; endif; ?>

</div>

<?php get_footer(); ?>
