<?php
/* remove p tag on img */
function remove_p_on_img($content) {
    return preg_replace('/<p>(.*)(<img .* \/>)(.*)<\/p>/iU', '<div class="wp-caption">\1\2\3</div>', $content);
}

function youtube($youtube_id) {
    echo '<div class="youtube"><iframe src="https://www.youtube.com/embed' . $youtube_id . '?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>';
}

add_filter('the_content', 'remove_p_on_img');

add_theme_support('post-thumbnails');



/*
 * Add some optional settings to general settings menu.
 */
add_action('admin_init', 'add_general_custom_sections');

function add_general_custom_sections() {
    add_settings_field('keywords', 'キーワード', 'keywords', 'general');
    add_settings_field('fb_app_id', 'Facebook App ID', 'fb_app_id', 'general');
    add_settings_field('twitter_username', 'Twitter ID', 'twitter_username', 'general');
    register_setting('general', 'keywords');
    register_setting('general', 'fb_app_id');
    register_setting('general', 'twitter_username');
}

function keywords($args) {
    $keywords = get_option('keywords');
    echo '<input type="text" name="keywords" id="keywords" size="150" value="' . esc_attr($keywords) . '">';
    echo '<p>metaタグのkeywords属性に指定される値です。</p>';
}

function fb_app_id($args) {
    $fb_app_id = get_option('fb_app_id');
    echo '<input type="text" name="fb_app_id" id="fb_app_id" value="' . esc_attr($fb_app_id) . '">';
    echo '<p>OGP用Facebook App ID。</p>';
}

function twitter_username($args) {
    $twitter_username = get_option('twitter_username');
    echo '<input type="text" name="twitter_username" id="twitter_username" value="' . esc_attr($twitter_username) . '">';
    echo '<p>Twitterの@以降のユーザーネーム。OGPに使用されます。</p>';
}

add_filter('wp_title', 'wp_title_for_home');
function wp_title_for_home($title) {
    if (empty($title)) {
        $title = get_bloginfo('name');
    }
    return $title;
}
?>
