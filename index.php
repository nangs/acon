<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AIO_Video_Downloader_Default
 */
get_header();
$showBlogPosts = get_option('aiodl_show_blog') == 'on';
$showAbout = get_option('aiodl_show_about') == 'on';
$showHowtoDownload = get_option('aiodl_show_howto_download') == 'on';
$showSupported = get_option('aiodl_show_supported') == 'on';
$showFeatures = get_option('aiodl_show_features') == 'on';
$themeUrl = get_template_directory_uri();
$homepageContent = get_option('aiodl_homepage_content');
$isFrontPage = is_front_page();
$postId = get_the_ID();
$isDownloader = get_post_meta($postId, 'show_download_form', true) == '1';
if (!$isDownloader && $isFrontPage) {
    $isDownloader = true;
}
?>
<?php
if ($showHowtoDownload && $isDownloader) {
    include_once __DIR__ . '/template-parts/howto-download.php';
}
if ($isFrontPage) {
    echo '<div class="container">';
    echo $homepageContent;
    echo '</div>';
}
?>
    <div class="text-center" id="ad-area-2"><?php echo get_option('aiodl_ad_area_2'); ?></div>
    <div class="py-0 overflow-hidden" id="result" style="display: none"></div>
<?php
if ($showSupported && $isFrontPage) {
    include_once __DIR__ . '/template-parts/supported-sources.php';
}
if ($showFeatures && $isFrontPage) {
    include_once __DIR__ . '/template-parts/features.php';
}
if ($showBlogPosts) {
    include_once __DIR__ . '/template-parts/blog-posts.php';
}
get_footer();