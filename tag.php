<?php get_header(); ?>

<div class="content">
    <div class="tag">tag: <?php single_tag_title(); ?></div>
<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-title">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    </div>
     <div class="post-meta">
        <div class="post-date"><?php the_date(); ?></div>
        <div class="post-tags"><?php the_tags('tags: ', ','); ?></div>
    </div> 
    <?php the_content(); ?>
</div>
<?php
endwhile;
else : ?>
<div class="post">
<h2>Page Not Found</h2>
<p>ページが見つかりません。</p>
</div>
<?php 
endif; ?>

</div>

<?php get_footer(); ?>
