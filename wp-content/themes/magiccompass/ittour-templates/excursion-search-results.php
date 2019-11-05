<?php
$template = 'no-sidebar';

$page_title_template = snth_get_template('titles/static-image-bg.php', array(
        'title' => __('Search results', 'snthwp')
    )
);

$ittour_content = '';
$search = ittour_excursion_search(ITTOUR_LANG);

$args = array();

$country_id = !empty($_GET['country']) ? trim($_GET['country']) : false;

if (!$country_id) {
    $ittour_content = 'Not ours';
} else {
    $args['date_from'] = '21.10.19';
    $args['date_till'] = '20.11.19';
    $search_result = $search->get($country_id, $args);

    if (is_wp_error($search_result)) {
        $ittour_content = 'Not ours';
    } else {

        if (!empty($search_result['offers'])) {
            $tours = $search_result['offers'];

            $main_currency = '10';

            if ('10' === $main_currency) {
                $main_currency_label = __('€', 'snthwp');
            } else if ('1' === $main_currency) {
                $main_currency_label = __('$', 'snthwp');
            } else if ('2' === $main_currency) {
                $main_currency_label = __('UAH', 'snthwp');
            }

            $template_args = array(
                'main_currency_label' => $main_currency_label,
                'main_currency' => $main_currency,
                'tours' => $tours
            );

            $ittour_content = ittour_get_template('search/excursion-result.php', $template_args);
        } else {
            $ittour_content = 'Not ours';
        }
    }
}


?>

<!-- start page title section -->
<?php
echo $page_title_template;
?>
<!-- end page title section -->

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
