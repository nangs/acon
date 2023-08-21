<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AIO_Video_Downloader_Default
 */
$logoUrl = '';
$logo = get_theme_mod('custom_logo');
if ($logo) {
    $image = wp_get_attachment_image_src($logo, 'full');
    $logoUrl = $image[0];
}
$siteUrl = esc_url(home_url('/'));
$siteName = get_bloginfo('name');
$showButtons = get_option('aiodl_show_social_media') == 'on';
?>
<footer class="py-20">
    <div class="container">
        <div class="pb-6 pb-lg-10 border-bottom">
            <div class="d-flex flex-wrap align-items-start justify-content-between">
                <div class="col-12 col-lg-2 mb-6 mb-lg-0">
                    <a class="d-inline-block mb-5 h4 text-decoration-none text-muted" href="<?php echo $siteUrl; ?>">
                        <?php
                        if (!empty($logoUrl)) {
                            printf('<img src="%s" alt="%s logo" height="28">', $logoUrl, $siteName);
                        } else {
                            echo $siteName;
                        }
                        ?>
                    </a>
                </div>
                <?php
                $walker = new WP_Bootstrap_Navwalker();
                $walker->footerMenu = true;
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'depth' => 1, // 1 = no dropdowns, 2 = with dropdowns.
                    'container' => 'div',
                    'container_class' => 'col-12 col-lg-auto footer-menu',
                    'menu_class' => 'row text-center list-unstyled',
                    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                    'walker' => $walker,
                ));
                ?>
            </div>
        </div>
        <div class="mt-8">
            <div class="row">
                <p class="col text-muted small"><?php pll_e('All rights reserved'); ?> &copy; <?php echo $siteName; ?></p>
                <?php
                if ($showButtons) {
                    echo '<div class="col d-flex justify-content-end">';
                    $facebookUsername = get_option('aiodl_facebook_username');
                    if ($facebookUsername != '') {
                        echo '<a class="d-flex justify-content-center align-items-center me-4 bg-light rounded-circle" href="https://facebook.com/' . $facebookUsername . '" style="width: 40px; height: 40px;"><svg class="text-muted" width="7" height="12" viewbox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M4.0898 11.8182V6.51068H5.90537L6.17776 4.44164H4.0898V3.12086C4.0898 2.52201 4.25864 2.1139 5.13515 2.1139L6.25125 2.11345V0.26283C6.05824 0.238228 5.39569 0.181824 4.62456 0.181824C3.01431 0.181824 1.9119 1.14588 1.9119 2.91594V4.44164H0.0908203V6.51068H1.9119V11.8182H4.0898Z" fill="currentColor"></path></svg></a>';
                    }
                    $twitterUsername = get_option('aiodl_twitter_username');
                    if ($twitterUsername != '') {
                        echo '<a class="d-flex justify-content-center align-items-center me-4 bg-light rounded-circle" href="https://twitter.com/' . $twitterUsername . '" style="width: 40px; height: 40px;"><svg class="text-muted" width="13" height="11" viewbox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.5455 2.09728C12.0904 2.29892 11.6022 2.43566 11.0892 2.49671C11.613 2.18304 12.014 1.6855 12.204 1.09447C11.7127 1.38496 11.1703 1.59589 10.5924 1.71023C10.1296 1.21655 9.47138 0.909058 8.74128 0.909058C7.34059 0.909058 6.20489 2.04475 6.20489 3.44467C6.20489 3.64322 6.2273 3.83714 6.27057 4.02257C4.16298 3.91671 2.29411 2.90696 1.0433 1.37259C0.824652 1.74653 0.700269 2.18225 0.700269 2.64736C0.700269 3.52734 1.14837 4.30379 1.82825 4.75805C1.41259 4.74415 1.02166 4.62981 0.67942 4.43975V4.47142C0.67942 5.69983 1.55399 6.72504 2.71362 6.95837C2.50116 7.01554 2.27712 7.04722 2.04534 7.04722C1.88156 7.04722 1.72318 7.031 1.56788 7.00009C1.89081 8.00831 2.8272 8.74148 3.93663 8.76158C3.06902 9.44146 1.97504 9.84552 0.786814 9.84552C0.582087 9.84552 0.38043 9.83316 0.181885 9.81076C1.30445 10.5316 2.63716 10.9519 4.06952 10.9519C8.73514 10.9519 11.2854 7.0874 11.2854 3.73595L11.2769 3.4076C11.7752 3.05219 12.2063 2.60564 12.5455 2.09728Z" fill="currentColor"></path></svg></a>';
                    }
                    $instagramUsername = get_option('aiodl_instagram_username');
                    if ($instagramUsername != '') {
                        echo ' <a class="d-flex justify-content-center align-items-center me-4 bg-light rounded-circle" href="https://instagram.com/' . $instagramUsername . '" style="width: 40px; height: 40px;"><svg class="text-muted" width="14" height="14" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M4.06713 0.454529H9.9328C11.9249 0.454529 13.5456 2.07519 13.5455 4.06715V9.93282C13.5455 11.9248 11.9249 13.5454 9.9328 13.5454H4.06713C2.07518 13.5454 0.45459 11.9249 0.45459 9.93282V4.06715C0.45459 2.07519 2.07518 0.454529 4.06713 0.454529ZM9.9329 12.3839C11.2845 12.3839 12.3841 11.2844 12.3841 9.93282H12.384V4.06714C12.384 2.71563 11.2844 1.61601 9.93282 1.61601H4.06715C2.71564 1.61601 1.61609 2.71563 1.61609 4.06714V9.93282C1.61609 11.2844 2.71564 12.384 4.06715 12.3839H9.9329ZM3.57148 7.00005C3.57148 5.10947 5.10951 3.5714 7.00005 3.5714C8.8906 3.5714 10.4286 5.10947 10.4286 7.00005C10.4286 8.89056 8.8906 10.4285 7.00005 10.4285C5.10951 10.4285 3.57148 8.89056 3.57148 7.00005ZM4.75203 6.99998C4.75203 8.23951 5.76054 9.24788 7.00004 9.24788C8.23955 9.24788 9.24806 8.23951 9.24806 6.99998C9.24806 5.76036 8.23963 4.75191 7.00004 4.75191C5.76046 4.75191 4.75203 5.76036 4.75203 6.99998Z" fill="currentColor"></path></svg></a>';
                    }
                    $youtubeUsername = get_option('aiodl_youtube_username');
                    if ($youtubeUsername != '') {
                        echo '<a class="d-flex justify-content-center align-items-center me-4 bg-light rounded-circle" href="https://youtube.com/' . $youtubeUsername . '" style="width: 40px; height: 40px;"> <svg class="text-muted" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 12 12"> <path fill-rule="evenodd" clip-rule="evenodd" d="M11.754 3.121a1.501 1.501 0 00-1.059-1.058C9.758 1.804 6 1.804 6 1.804s-3.758 0-4.695.246C.8 2.19.387 2.605.246 3.12 0 4.06 0 6.004 0 6.004S0 7.96.246 8.89c.14.515.543.921 1.059 1.058.949.258 4.695.258 4.695.258s3.758 0 4.695-.246c.516-.14.918-.547 1.059-1.059C12 7.961 12 6.016 12 6.016s.012-1.957-.246-2.895zm0 0" fill="currentColor"/> <path d="M4.805 7.805l3.12-1.801-3.12-1.797zm0 0" fill="#fff"/> </svg> </a>';
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</footer>
<?php
wp_footer();
if (get_option('aiodl_recaptcha') == 'on') {
    $recaptchaPublicKey = get_option('aiodl_recaptcha_public_api_key');
    printf('<script src="https://www.google.com/recaptcha/api.js?render=%s"></script>', $recaptchaPublicKey);
    printf("<script>%s</script>", str_replace('%s', $recaptchaPublicKey, file_get_contents(__DIR__ . '/js/captcha.js')));
}
echo get_option('aiodl_tracking_code');
?>
</body>
</html>