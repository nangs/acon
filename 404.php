<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package AIO_Video_Downloader_Default
 */

get_header();
$themeUrl = get_template_directory_uri();
$siteUrl = esc_url(home_url('/'));
$searchForm = get_search_form(['echo' => false]);
$searchForm = str_replace('search-submit', 'btn btn-primary search-submit', $searchForm);
$searchForm = str_replace('search-field', 'form-control search-field', $searchForm);
//$searchForm = str_replace('search-field', 'form-control search-field', $searchForm);
?>
    <main class="py-0">
        <div class="container">
            <div class="max-w-4xl mx-auto mb-12 text-center">
                <img class="img-fluid w-75 h-75 rounded" style="object-fit: cover;"
                     src="<?php echo $themeUrl; ?>/assets/images/maze.webp" alt="maze">
                <p class="text-muted"><?php pll_e('Photo by'); ?> <a
                            href="https://unsplash.com/@syinq?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                            rel="nofollow">Susan Q Yin</a> on <a
                            href="https://unsplash.com/?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText"
                            rel="nofollow">Unsplash</a>
                </p>
            </div>
            <div class="text-center">
                <span class="small fw-bold text-uppercase text-muted"><?php pll_e('Error 404'); ?></span>
                <h2 class="mt-8 mb-10"><?php pll_e('Page not found'); ?></h2>
                <p class="mb-12 lead text-muted"><?php pll_e('Oops! That page can&rsquo;t be found.'); ?></p>
                <div class="d-flex flex-wrap justify-content-center"><a class="btn btn-primary me-4"
                                                                        href="<?php echo $siteUrl; ?>"><?php pll_e('Go back to the Homepage'); ?></a>
                </div>
            </div>

            <div class="text-center max-w-4xl mx-auto mt-4">
                <?php echo $searchForm; ?>
            </div>
        </div>
    </main>
<?php
get_footer();