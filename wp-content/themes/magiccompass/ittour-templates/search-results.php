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
$country_id = !empty($_GET['country']) ? trim($_GET['country']) : false;
$from_city = !empty($_GET['from_city']) ? trim($_GET['from_city']) : false;
$adult_amount = !empty($_GET['adult_amount']) ? trim($_GET['adult_amount']) : false;
$night_from = !empty($_GET['night_from']) ? trim($_GET['night_from']) : false;
$night_till = !empty($_GET['night_till']) ? trim($_GET['night_till']) : false;
$region = false;
$hotel = false;
$date_from = false;
$date_till = false;
$child_amount = false;
$child_age = false;

$ittour_content = '';

if (!$country_id) {
    $template = 'no-sidebar';
    $ittour_content = ittour_get_template('search/no-parameters.php');
} else {


    $args = array();

    $args['from_city'] = $from_city ? $from_city : '2014';
    $args['adult_amount'] = $adult_amount ? $adult_amount : '2';
    $args['night_from'] = $night_from ? $night_from : '7';
    $args['night_till'] = $night_till ? $night_till : '9';

    if (!empty($_GET['region'])) {
        $region = trim($_GET['region']);
        $args['region'] = trim($_GET['region']);
    }

    if (!empty($_GET['hotel'])) {
        $hotel = trim($_GET['hotel']);
        $args['hotel'] = trim($_GET['hotel']);
    }

    if (!empty($_GET['date'])) {
        $dates = explode('-', $_GET['date']);

        $args['date_from'] = trim($dates[0]);
        $args['date_till'] = trim($dates[1]);

        $date_from = trim($dates[0]);
        $date_till = trim($dates[1]);
    }

    if (!empty($_GET['child_amount'])) {
        $args['child_amount'] = count($_GET['child_amount']);
        $args['child_age'] = implode(':', $_GET['child_amount']);

        $child_amount = count($_GET['child_amount']);
        $child_age = implode(':', $_GET['child_amount']);
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

<?php
ittour_show_template('form/section-search.php', array(
    'country'       => $country_id,
    'region'        => $region,
    'hotel'         => $hotel,
    'from_city'     => $from_city,
    'date_from'     => $date_from,
    'date_till'     => $date_till,
    'night_from'    => $night_from,
    'night_till'    => $night_till,
    'adult_amount'  => $adult_amount,
    'child_amount'  => $child_amount,
    'child_age'     => $child_age,
));
?>

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