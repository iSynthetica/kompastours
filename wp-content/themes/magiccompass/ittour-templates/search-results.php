<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts
 * @version 0.0.8
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if (empty($template)) {
    $template = 'left-sidebar';
}

$ittour_content = '';

if (empty($_GET['country'])) {
    $template = 'no-sidebar';
    $ittour_content = ittour_get_template('search/no-parameters.php');
} else {
    $country_id = $_GET['country'];

    unset($_GET['country']);

    $args = $_GET;

    if (!empty($_GET['child_amount'])) {
        $args['child_amount'] = count($_GET['child_amount']);
        $args['child_age'] = implode(':', $_GET['child_amount']);
    }

    if (!empty($_GET['date'])) {
        $dates = explode('-', $_GET['date']);

        $args['date_from'] = trim($dates[0]);
        $args['date_till'] = trim($dates[1]);
    }

    $search = ittour_search('ru');
    $search_result = $search->get($country_id, $args);

    if (is_wp_error($search_result)) {
        snth_show_template('content/hero-section-parallax.php', array(
            'title' => __('Search Error', 'snthwp'),
        ));

        $ittour_content = ittour_get_template('search/result-error.php', array('error' => $search_result->errors['ittour_error'][0]));
    }

    if ( !is_array( $search_result ) ) {
        return;
    }

    $ittour_content = ittour_get_template('search/result.php', array('result' => $search_result));
}
?>
<section class="parallax-window" data-parallax="scroll" data-image-src="img/header_bg.jpg" data-natural-width="1400"
         data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>Search</h1>
            <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
        </div>
    </div>
</section>
<!-- End Section -->

<?php ittour_show_template('form/section-search.php'); ?>

<div class="wrap">
    <div class="container margin_60">
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