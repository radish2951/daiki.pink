<?php get_header(); ?>


<div id="content-photo" class="content">

<?php 
if (have_posts()) :
while (have_posts()) : the_post(); ?>
<?php 
$content = get_the_content();
preg_match_all('/<img.*?>/', $content, $matches);
?>
<div class="photo-grid">
<a href="<?php echo get_permalink(); ?>">
<?php 
$l = count($matches[0]);
echo $matches[0][rand(0, $l-1)]; ?>
</a>
</div>
<?php
endwhile; ?>
<?php else : ?>
<div class="post">
<h2>Page Not Found</h2>
<p>ページが見つかりません。</p>
</div>
<?php 
endif; ?>

</div>

<script src="<?php echo get_template_directory_uri(); ?>/js/loading.js"></script>

<script>
const photoGrid = () => {

    const w = document.getElementById('content-photo').clientWidth;

    const numPhotoRow = 2;                                            
    const photoMargin = 3;
    const photoWidth = (w - photoMargin * (numPhotoRow + 1)) / numPhotoRow;

    const heights = [];
    const rowHeights = [];
    const diffs = [];

    const photos = document.getElementsByClassName('photo-grid');
    const numPhoto = photos.length;

    for (let i = 0; i < numPhoto; i++) {
        photos[i].style.width = photoWidth + 'px';    
        photos[i].style.margin = 0;
        photos[i].style.marginLeft = photoMargin + 'px';
        photos[i].style.marginBottom = photoMargin + 'px';
        heights[i] = parseInt(photos[i].clientHeight);
    }

    for (let i = 0; i < numPhotoRow; i++) {
        rowHeights[i] = 0;
        diffs[i] = 0;
    }
    
    for (let i = 0; i < parseInt(numPhoto/numPhotoRow); i++) {
        const maxHeight = Math.max(...heights.slice(i*numPhotoRow, (i+1)*numPhotoRow));
        for (let j = 0; j < numPhotoRow; j++) {
            const diff = maxHeight - heights[i * numPhotoRow + j];
            diffs[j] += diff;
            photos[i * numPhotoRow + j].style.top = (-diffs[j]) + 'px';
            rowHeights[j] += heights[i * numPhotoRow + j] + photoMargin;
        }
    }

    const r = numPhoto % numPhotoRow

    if (r > 0) {
        const maxHeight = Math.max(...heights.slice(numPhoto-r, numPhoto));
        for (let j = 0; j < r; j++) {
            const index = numPhoto - r + j;
            const diff = maxHeight - heights[index];
            diffs[j] += diff;
            photos[index].style.top = (-diffs[j]) + 'px';
            rowHeights[j] += heights[index] + photoMargin;
        }        
    }
 
    const contentPhoto = document.getElementById('content-photo');

    contentPhoto.style.overflow = 'hidden';
    contentPhoto.style.height = (Math.max(...rowHeights)) + 'px';

};

if (!navigator.userAgent.match(/(iPhone|iPod|Android)/)) {
    window.addEventListener('load', photoGrid);
    window.addEventListener('resize', photoGrid);
} 
</script>

<!--<script src="<?php echo get_template_directory_uri(); ?>/js/loading.js"></script>-->

<?php get_footer(); ?>