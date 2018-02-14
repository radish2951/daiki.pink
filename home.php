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
        <div class="img-grid-title"><?php the_title(); ?></div>
<!--
        <div class="img-grid-text">
            <div class="img-grid-title"><?php the_title(); ?></div>
            <div class="img-grid-description"><?php the_excerpt(); ?></div>
        </div>
-->
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

const workGrid = () => {
    const imgGrids = document.getElementsByClassName('img-grid');
    const margin = 1.5; // px
    const gridNum = 2;
    const contentWidth = document.getElementById('content-movie').clientWidth;
    const gridSize = (contentWidth - margin * 2) / gridNum;
    for (let imgGrid of imgGrids) {
        const w = imgGrid.firstElementChild.firstElementChild.clientWidth;
        const h = imgGrid.firstElementChild.firstElementChild.clientHeight;
        if (w <= h) {
            imgGrid.style.width = gridSize + 'px';
            imgGrid.style.height = gridSize + 'px';
        } else {
            imgGrid.style.height = contentWidth / gridNum + 'px';
            const img = imgGrid.firstElementChild.firstElementChild;
            img.style.position = 'relative';
            img.style.top = (imgGrid.clientHeight - img.clientHeight) / 2 + 'px';
        }
        imgGrid.style.padding = margin + 'px';
        imgGrid.style.boxSizing = 'border-box';
    }
    
    const contentWork = document.getElementById('content-movie');
    contentWork.style.padding = margin == 0 ? margin : margin + 'px';
    contentWork.style.boxSizing = 'border-box';
    
};

window.addEventListener('load', workGrid);
window.addEventListener('resize', workGrid);

const imgGrids = document.getElementsByClassName('img-grid');
for (let imgGrid of imgGrids) {
    imgGrid.addEventListener('mouseenter', () => {
        const img = imgGrid.firstElementChild.firstElementChild;
        img.classList.add('transparent');
        img.nextElementSibling.classList.add('show');
    });
    imgGrid.addEventListener('mouseleave', () => {
        const img = imgGrid.firstElementChild.firstElementChild;
        img.classList.remove('transparent');
        img.nextElementSibling.classList.remove('show');
    });
}

</script>

</div>

<script src="<?php echo get_template_directory_uri(); ?>/js/loading.js"></script>

<?php get_footer(); ?>
