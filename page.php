<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AIO_Video_Downloader_Default
 */

get_header();
?>
    <div class="text-center" id="ad-area-2"><?php echo get_option('aiodl_ad_area_2'); ?></div>
    <div class="py-0 overflow-hidden" id="result" style="display: none"></div>
    <main id="primary" class="site-main">

        <?php
        while (have_posts()) :
            the_post();

            get_template_part('template-parts/content', 'page');

            // If comments are open or we have at least one comment, load up the comment template.
            /*
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            */

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->

<?php
$showBlogPosts = get_option('aiodl_show_blog') == 'on';
$showAbout = get_option('aiodl_show_about') == 'on';
$showHowtoDownload = get_option('aiodl_show_howto_download') == 'on';
$showSupported = get_option('aiodl_show_supported') == 'on';
$showFeatures = get_option('aiodl_show_features') == 'on';
$themeUrl = get_template_directory_uri();
$postId = get_the_ID();
$isDownloader = get_post_meta($postId, 'show_download_form', true) == '1';
if ($showHowtoDownload && $isDownloader) {
    include_once __DIR__ . '/template-parts/howto-download.php';
}
if ($showSupported && $isDownloader) {
    include_once __DIR__ . '/template-parts/supported-sources.php';
}
if ($showFeatures && $isDownloader) {
    include_once __DIR__ . '/template-parts/features.php';
}
get_footer();