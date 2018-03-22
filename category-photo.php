<?php get_header(); ?>


<div id="content-photo" class="content">

<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
<?php 
$content = get_the_content();
preg_match_all('/<img.*?>/', $content, $matches);
?>
<article class="photo-grid hover-grid">
<a href="<?php echo get_permalink(); ?>">
<?php 
$l = count($matches[0]);
if ($l > 0) :
    echo $matches[0][rand(0, $l-1)];
endif;
?>
<h1><?php the_title(); ?></h1>
</a>
</article>
<?php
endwhile; endif; ?>

</div>

<script>
/* Resize photo size so that all photos have the same squares */
const regularizePhotoSize = () => {
    const photos = document.getElementsByClassName('photo-grid');
    const imgs = document.getElementsByTagName('img');

    let maxWidth = 0;
    const sizes = Array.prototype.map.call(imgs, img => {
        const w = parseInt(img.getAttribute('width'));
        const h = parseInt(img.getAttribute('height'));
        if (w > maxWidth) maxWidth = w;
        return { width: w, height: h };
    });
    for (const size of sizes) {
        const ratio = maxWidth / size.width;
        size.width *= ratio;
        size.height *= ratio;
    }

    const squares = sizes.map(size => {
        return size.width * size.height;
    });
    const minSquare = Math.min(...squares);
    for (let i = 0; i < imgs.length; i++) {
        const squareRatio = minSquare / squares[i];
        const ratio = Math.sqrt(squareRatio);
        photos[i].style.width = 100 * ratio + '%';
        photos[i].style.flexBasis = 50 * ratio + '%';
    }
};

regularizePhotoSize();
</script>

<?php get_footer(); ?>
