<?php get_header(); ?>

<div id="content-movie" class="content">

<?php

$custom_query_args = array('category_name' => 'movie');

$custom_query = new WP_Query($custom_query_args);

$tmp_query = $wp_query;
$wp_query = NULL;
$wp_query = $custom_query;

if ($wp_query->have_posts()) :
    while ($wp_query->have_posts()) :
        $wp_query->the_post();

$tags = get_the_tags();
?>

<article class="img-grid">
    <a href="<?php echo get_permalink(); ?>">
        <?php the_post_thumbnail(); ?>
        <div class="img-grid-text">
            <h1 class="img-grid-title"><?php the_title(); ?></h1>
            <div class="img-grid-meta">
                <p class="img-grid-genre"><?php if ($tags[0]) { echo $tags[0]->name . ' / ' . $tags[0]->description; } ?></p>
                <p class="img-grid-date"><?php echo get_the_date(); ?></p>
            </div>
        </div>
    </a>
</article>

<?php
endwhile;
wp_reset_postdata();
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

<script>
/* Add select box by genre
const allGenres = Array.prototype.map.call(imgGrids, imgGrid => {
    const genre = imgGrid.getElementsByClassName('img-grid-genre')[0].innerText;
    return genre;
});
const genres = Array.from(new Set(allGenres));

const select = document.createElement('select');
for (let genre of genres) {
    const option = document.createElement('option');
    option.setAttribute('value', genre);
    option.textContent = genre;
    select.appendChild(option);
}
const contentMovie = document.getElementById('content-movie');
document.body.insertBefore(select, contentMovie);

select.addEventListener('change', () => {
    const i = select.selectedIndex;
    const genre = genres[i];
    for (const imgGrid of imgGrids) {
        const thisGenre = imgGrid.getElementsByClassName('img-grid-genre')[0].innerText;
        if (genre == thisGenre) {
            imgGrid.style.display = 'initial';
        } else {
            imgGrid.style.display = 'none';
        }
    }
});
 */

</script>

</div>

<?php get_footer(); ?>
