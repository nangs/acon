<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AIO_Video_Downloader_Default
 */
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = generateToken();
}
$logoUrl = '';
$headerImage = '';
$logo = get_theme_mod('custom_logo');
if ($logo) {
    $image = wp_get_attachment_image_src($logo, 'full');
    $logoUrl = $image[0];
}
$postType = get_post_type();
$postId = get_the_ID();
$isDownloader = get_post_meta($postId, 'show_download_form', true) == '1';
$siteName = get_bloginfo('name');
if ($isDownloader) {
    $pageTitle = get_the_title();
    $headerImage = get_the_post_thumbnail_url();
    $siteDescription = get_the_excerpt();
} else {
    $pageTitle = $siteName;
    $siteDescription = get_bloginfo('description', 'display');
}
$themeUrl = get_template_directory_uri();
$siteUrl = esc_url(home_url('/'));
$showFeaturedImage = get_option('aiodl_show_header_image') == 'on';
$captchaEnabled = get_option('aiodl_recaptcha') == 'on';
$onclick = $captchaEnabled ? 'onclick="recaptcha_execute()"' : '';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="pb-8 pb-lg-20">
    <nav class="navbar navbar-light navbar-expand-lg" id="header">
        <div class="container-fluid">
            <a class="navbar-brand h4 text-decoration-none" href="<?php echo $siteUrl; ?>">
                <?php
                if (!empty($logoUrl)) {
                    printf('<img src="%s" alt="%s logo" height="%s">', $logoUrl, $siteName, get_option('aiodl_logo_height'));
                } else {
                    echo $siteName;
                }
                ?>
            </a>
            <div class="d-lg-none">
                <button class="btn btn-sm navbar-burger">
                    <svg class="d-block" width="16" height="16" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title><?php pll_e('Mobile Menu'); ?></title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg>
                </button>
            </div>
            <?php
            $nav = wp_nav_menu(array(
                'theme_location' => 'primary',
                'depth' => 1, // 1 = no dropdowns, 2 = with dropdowns.
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse',
                'menu_class' => 'navbar-nav ms-auto me-4',
                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                'walker' => new WP_Bootstrap_Navwalker(),
                'echo' => 0
            ));
            $nav = str_replace('</ul>', languageDropdown() . '</ul>', $nav);
            if (!empty($nav)) {
                echo $nav;
            } else {
                echo languageDropdown();
            }
            ?>
        </div>
    </nav>
    <?php
    if ((is_front_page() && is_home()) || $isDownloader) {
        ?>
        <div class="container mt-8">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 mb-5 mb-lg-0">
                    <h1 class="mt-8 mb-8 mb-lg-12">
                        <?php
                        if ($isDownloader) {
                            echo $pageTitle;
                        } else {
                            pll_e('Free Video Downloader');
                        }
                        ?>
                    </h1>
                    <h2 class="lead mb-8 mb-lg-12">
                        <?php
                        if ($isDownloader && has_excerpt()) {
                            echo get_the_excerpt();
                        } else {
                            pll_e('Fast and free all in one video downloader');
                        }
                        ?>
                    </h2>
                    <div class="alert alert-warning" role="alert" id="alert" style="display: none"></div>
                    <div class="d-flex flex-wrap" id="download-form">
                        <input id="url" type="url" name="url" class="form-control w-100"
                               placeholder="<?php pll_e('Paste a video URL'); ?>"
                               aria-label="<?php pll_e('Paste a video URL'); ?>">
                        <input id="token" type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                        <button class="mt-4 btn btn-primary btn-block me-4" <?php echo $onclick; ?> id="downloadBtn">
                            <?php pll_e('Download'); ?>
                        </button>
                        <button class="mt-4 btn btn-secondary btn-block me-4"
                                id="pasteBtn"><?php pll_e('Paste from clipboard'); ?>
                        </button>
                    </div>
                    <div class="mt-1"><?php echo get_option('aiodl_ad_area_1'); ?></div>
                </div>
                <div class="col-12 col-lg-6 position-relative d-none d-lg-flex">
                    <?php
                    if ($showFeaturedImage && $headerImage == '') {
                        ?>
                        <img class="d-none d-lg-block position-absolute top-0 end-0 mt-5"
                             src="<?php echo $themeUrl; ?>/assets/icons/dots/yellow-dot-right-shield.svg" alt="">
                        <img class="position-relative img-fluid"
                             src="<?php echo $themeUrl; ?>/assets/images/header.webp"
                             alt="">
                        <img class="d-none d-lg-block position-absolute bottom-0 start-0 mb-5"
                             src="<?php echo $themeUrl; ?>/assets/icons/dots/blue-dot-left-bars-2.svg" alt="">
                    <?php } else if ($showFeaturedImage) { ?>
                        <img class="position-relative img-fluid" src="<?php echo $headerImage; ?>"
                             alt="<?php echo $pageTitle; ?>">
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="d-none navbar-menu position-relative">
        <div class="navbar-backdrop position-fixed top-0 start-0 end-0 bottom-0 bg-dark" style="opacity: 75%;"></div>
        <nav class="position-fixed top-0 start-0 bottom-0 d-flex flex-column w-75 max-w-sm py-6 px-6 bg-white overflow-auto">
            <div class="d-flex align-items-center mb-10">
                <a class="me-auto h4 mb-0 text-decoration-none" href="<?php echo $siteUrl; ?>">
                    <?php
                    if (!empty($logoUrl)) {
                        printf('<img src="%s" alt="%s logo" height="28">', $logoUrl, $siteName);
                    } else {
                        echo $siteName;
                    }
                    ?>
                </a>
                <button class="navbar-close btn-close" type="button" aria-label="Close"></button>
            </div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'mobile',
                'depth' => 2, // 1 = no dropdowns, 2 = with dropdowns.
                'container' => 'div',
                'container_class' => '',
                'menu_class' => 'nav flex-column',
                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                'walker' => new WP_Bootstrap_Navwalker(),
            ));
            echo $nav;
            echo languageDropdownMobile();
            ?>
        </nav>
    </div>
</header>