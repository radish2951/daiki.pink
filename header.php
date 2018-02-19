<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="keywords" content="<?php echo get_option('keywords'); ?>">
    <meta name="description" content="<?php bloginfo('description') ?>">
    <title><?php wp_title(false); ?></title>

    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php wp_title(''); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:url" content="<?php if (!is_page() && !is_single()) : bloginfo('url'); else : echo get_permalink(); endif; ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="fb:app_id" content="<?php echo get_option('fb_app_id'); ?>">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@<?php echo get_option('twitter_username'); ?>">
    <meta name="twitter:title" content="<?php wp_title(''); ?>">
<!--
<?php
/*
 * if this is single page, set random image in this article to og:image
 */
?>
<?php if (is_single()) : ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php
$content = strip_tags(get_the_content());
$content = str_replace('&nbsp;', '', $content);
$content = str_replace(array('\r\n', '\r', '\n'), '', $content);

if ($content == '') :
    $content = wp_title(false);
endif;

$subject = get_the_content();
$pattern = '/<img .+?>/';
$has_img = preg_match_all($pattern, $subject, $matches);
$img = '';

$default_img = get_template_directory_uri() . '/img/og_image.jpg';

if ($has_img) :
    preg_match('/http.+?\.jpg/', $matches[0][rand(0, count($matches[0])-1)], $match);
    $img = $match[0];
endif;
?>
    <meta property="og:description" content="<?php echo $content; ?>">
    <meta property="og:image" content="<?php echo $img == '' ? $default_img : $img; ?>">
    <meta name="twitter:description" content="<?php echo $content; ?>">
    <meta name="twitter:image" content="<?php echo $img == '' ? $default_img : $img; ?>">
<?php endwhile; endif; ?>
<?php else : ?>
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:image" content="<?php echo $default_img; ?>">
    <meta name="twitter:description" content="<?php bloginfo('description'); ?>">
    <meta name="twitter:image" content="<?php echo $default_img; ?>">
<?php endif; ?>

-->
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/style.css?ver=<?php echo rand() % 10000000000 ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
<?php if (has_tag('math') || is_tag() || is_category('article')) : ?>
    <script type="text/x-mathjax-config">
    MathJax.Hub.Config({
        CommonHTML: { matchFontHeight: false }
    });
    </script>
    <script async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_CHTML"></script>
<?php endif; ?>

    <?php wp_head(); ?>
</head>
<body>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/loading.js"></script>
    <header id="header">
        <div id="sitename"><?php bloginfo('title'); ?></div>
<?php wp_nav_menu(); ?>
    </header>
