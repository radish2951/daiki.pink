<?php get_header(); ?>


<div id="content-movie" class="content">

<?php

$custom_query_args = array('category_name' => 'movie');

//$custom_query_args['paged'] = get_query_var('paged') ? get_query_var('paged') : 1;

$custom_query = new WP_Query($custom_query_args);

$tmp_query = $wp_query;
$wp_query = NULL;
$wp_query = $custom_query;

if ($wp_query->have_posts()) :
    while ($wp_query->have_posts()) :
        $wp_query->the_post();
?>

<article class="img-grid">
    <a href="<?php echo get_permalink(); ?>">
        <?php the_post_thumbnail(); ?>
        <div class="img-grid-text">
            <div class="img-grid-title"><?php the_title(); ?></div>
            <div class="img-grid-meta">
                <div class="img-grid-date"><?php echo get_the_date(); ?></div>
                <div class="img-grid-genre"><?php $tags = get_the_tags(); if ($tags[0]) { echo $tags[0]->name; } ?></div>
            </div>
        </div>
    </a>
</article>

<?php
endwhile;
wp_reset_postdata();
/*the_posts_pagination(array(
    'prev_text' => 'prev',
    'next_text' => 'next',
    'screen_reader_text' => ' '
));*/
$wp_query = NULL;
$wp_query = $tmp_query;
else : ?>
<div class="post">
<h2>Page Not Found</h2>
<p>ページが見つかりません。</p>
</div>
<?php 
endif; ?>

<script>
const imgGrids = document.getElementsByClassName('img-grid');
for (let imgGrid of imgGrids) {
    imgGrid.addEventListener('mouseenter', () => {
        const img = imgGrid.getElementsByTagName('img')[0];
        img.classList.add('transparent');
    });
    imgGrid.addEventListener('mouseleave', () => {
        const img = imgGrid.getElementsByTagName('img')[0];
        img.classList.remove('transparent');
    });
}
</script>

</div>

<!--<script src="<?php echo get_template_directory_uri(); ?>/js/loading.js"></script>-->

<?php get_footer(); ?>
