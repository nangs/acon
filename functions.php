<?php
/**
 * AIO Video Downloader Default functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AIO_Video_Downloader_Default
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.2.2');
}

if (!function_exists('aiodl_default_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function aiodl_default_setup()
    {
        add_post_type_support('page', 'excerpt');
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on AIO Video Downloader Default, use a find and replace
         * to change 'aiodl-default' to the name of your theme in all the template files.
         */
        //load_theme_textdomain('aiodl-default', get_template_directory() . '/languages');
        require_once 'languages/register-strings.php';

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary' => esc_html__('Primary', 'aiodl-default'),
                'mobile' => esc_html__('Mobile', 'aiodl-default'),
                'footer' => esc_html__('Footer', 'aiodl-default'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'aiodl_default_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            )
        );

    }
endif;
add_action('after_setup_theme', 'aiodl_default_setup');

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}

add_action('after_setup_theme', 'register_navwalker');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aiodl_default_content_width()
{
    $GLOBALS['content_width'] = apply_filters('aiodl_default_content_width', 640);
}

add_action('after_setup_theme', 'aiodl_default_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aiodl_default_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'aiodl-default'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'aiodl-default'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}

add_action('widgets_init', 'aiodl_default_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function aiodl_default_scripts()
{
    //wp_enqueue_style('aiodl-inter-font', 'https://rsms.me/inter/inter.css', array(), _S_VERSION);
    $websiteDomain = str_ireplace("www.", "", parse_url(get_site_url(), PHP_URL_HOST));
    $activationCode = (string)get_option('aiodl_license_fingerprint');
    $fingerprint = sha1($websiteDomain . get_option('aiodl_license_code'));
    if (hash_equals($activationCode, $fingerprint)) {
        wp_enqueue_style('aiodl-default-style', get_stylesheet_uri(), array(), _S_VERSION);
    }

    //wp_style_add_data('aiodl-default-style', 'rtl', 'replace');

    wp_enqueue_script('aiodl-bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap/bootstrap.bundle.min.js', array(), _S_VERSION, true);
    wp_enqueue_script('aiodl-default-script', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true);
    wp_localize_script('aiodl-default-script', 'WPURLS', array('siteurl' => get_option('siteurl')));

    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');

    wp_deregister_script('jquery');
    wp_register_script('jquery', false);
    wp_deregister_script('wp-embed');

    /*
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    */
}

add_action('wp_enqueue_scripts', 'aiodl_default_scripts', 100);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('template_redirect', 'rest_output_link_header', 11);


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

function generateToken()
{
    if (defined('PHP_MAJOR_VERSION') && PHP_MAJOR_VERSION > 5) {
        return bin2hex(random_bytes(32));
    } else {
        if (function_exists('mcrypt_create_iv')) {
            return bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        } else {
            return bin2hex(openssl_random_pseudo_bytes(32));
        }
    }
}

function languageDropdown()
{
    if (function_exists('pll_the_languages')) {
        $languages = pll_the_languages(array('dropdown' => 1, 'echo' => 0, 'show_flags' => 1, 'raw' => 1, 'hide_if_empty' => 0));
        $links = '';
        foreach ($languages as $language) {
            $links .= '<li><a class="dropdown-item" href="' . $language['url'] . '">' . $language['name'] . '</a></li>';
        }
        $template = '<li class="nav-item dropdown mx-8">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="' . get_template_directory_uri() . '/assets/icons/translation.svg" height="28" width="28">
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            ' . $links . '
        </li></ul>';
        return $template;
    } else {
        return '';
    }
}

function languageDropdownMobile(){
    if (function_exists('pll_the_languages')) {
        $languages = pll_the_languages(array('dropdown' => 1, 'echo' => 0, 'show_flags' => 1, 'raw' => 1, 'hide_if_empty' => 0));
        $links = '';
        foreach ($languages as $language) {
            $links .= '<li><a class="dropdown-item" href="' . $language['url'] . '">' . $language['name'] . '</a></li>';
        }
        $template = '<div class="nav flex-column">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="' . get_template_directory_uri() . '/assets/icons/translation.svg" height="28" width="28">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                     ' . $links . '
                </ul>
            </li></div>';
        return $template;
    } else {
        return '';
    }
}

function showDownloadForm($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count . ' ';
}