<?php get_header(); ?>
<div class="content">

<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (in_category('photo')) : the_content(); ?>
    <div class="post-title post-title-photo">
        <h1><?php the_title(); ?></h1>
    </div>
    <?php else : ?>
    <div class="post-title">
        <h1><?php the_title(); ?></h1>
    </div>
    <?php if (in_category('article')) : ?>
    <div class="post-meta">
        <div class="post-date"><?php the_date(); ?></div>
        <div class="post-tags"><?php the_tags('tags: ', ','); ?></div>
    </div>
    <?php endif; ?>
    <?php the_content(); endif; ?>
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
