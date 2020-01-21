<?php
global $ittour_global_tour_result;
global $ittour_global_form_args;
global $ittour_global_template_args;

$template = 'no-sidebar';

$page_title_template = snth_get_template('titles/static-image-bg.php', array (
        'title' => __('Search results', 'snthwp')
    )
);

if (!empty($ittour_global_tour_result['error'])) {
    $ittour_content = $ittour_global_tour_result['error'];
} elseif (!empty($ittour_global_tour_result['result'])) {
    $search_result = $ittour_global_tour_result['result'];

    if (is_wp_error($search_result)) {
        $ittour_content = 'Not ours';
    } else {
        if (!empty($search_result['offers'])) {
            $tours = $search_result['offers'];

            $template_args = array('tours' => $tours);

            $ittour_content = ittour_get_template('search/excursion-result.php', array_merge($template_args, $ittour_global_template_args));
        } else {
            $ittour_content = 'No tours';
        }
    }
} else {
    $ittour_content = 'No tours';
}
?>

<!-- start page title section -->
<?php echo $page_title_template; ?>
<!-- end page title section -->

<section id="search-section">
    <div class="container">
        <?php ittour_show_template('form/section-search.php', $ittour_global_form_args);?>
    </div>
</section>

<div class="wrap">
    <div class="container mt-0 mb-20 mt-md-20 mb-md-40 mt-lg-40 mb-lg-60 ">
        <div class="row">
            <?php
            if ( 'right-sidebar' === $template ) {
                ?>
                <div id="primary" class="content-area col-lg-9">
                    <main id="main" class="site-main" role="main">
                        <?php echo $ittour_content; ?>
                    </main>
                </div>

                <aside class="col-lg-3">
                    <?php get_sidebar(); ?>
                </aside>
                <?php
            } elseif ( 'left-sidebar' === $template ) {
                ?>
                <aside class="col-lg-3">
                    <?php get_sidebar(); ?>
                </aside>

                <div id="primary" class="content-area col-lg-9">
                    <main id="main" class="site-main" role="main">
                        <?php echo $ittour_content; ?>
                    </main>
                </div>
                <?php
            } else {
                ?>
                <div id="primary" class="content-area col-12">
                    <main id="main" class="site-main" role="main">
                        <?php echo $ittour_content; ?>
                    </main>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
