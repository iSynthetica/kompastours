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
$hotel_rating = false;
$date_from = false;
$date_till = false;
$child_amount = false;
$child_age = false;
$price_limit = false;
$price_from = false;
$price_till = false;
$tour_type = false;
$tour_kind = false;

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
        $hotel = implode(':', $_GET['hotel']);
        $args['hotel'] = implode(':', $_GET['hotel']);
    }

    if (!empty($_GET['hotel_rating'])) {
        $hotel_rating = implode(':', $_GET['hotel_rating']);
        $args['hotel_rating'] = implode(':', $_GET['hotel_rating']);
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

    if (!empty($_GET['price_limit'])) {
        if ('custom' === $_GET['price_limit']) {
            $price_from = !empty($_GET["price_limit_from"]) ? $_GET["price_limit_from"] : false;
            $price_till = !empty($_GET["price_limit_till"]) ? $_GET["price_limit_till"] : false;

            if ($price_from || $price_till) {
                $price_limit = 'custom';

                if ($price_from) $price_limit .= ':f-' . $price_from;
                if ($price_till) $price_limit .= ':t-' . $price_till;
            }

        } else {
            $price_limit_array = explode(':', $_GET['price_limit']);

            $price_from = !empty($price_limit_array[0]) ? $price_limit_array[0] : false;
            $price_till = !empty($price_limit_array[1]) ? $price_limit_array[1] : false;

            $price_limit = $_GET['price_limit'];
        }
    }

    if ($price_from) {
        $args['price_from'] = $price_from;
    }

    if ($price_till) {
        $args['price_till'] = $price_till;
    }

    if (!empty($_GET['search_page'])) {
        $page = $_GET['search_page'];
        $args['page'] = $_GET['search_page'];
        unset($_GET['search_page']);
    }

    if (!empty($_GET['tour_type'])) {
        $tour_type = $_GET['tour_type'];
        $args['type'] = $tour_type;

        if (!empty($_GET['tour_kind'])) {
            $tour_kind = $_GET['tour_kind'];
            $args['kind'] = $tour_kind;
        }
    }

    $url = http_build_query($_GET);

    $search = ittour_search('uk');
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

    $ittour_content = ittour_get_template('search/result.php', array('result' => $search_result, 'url' => $url));
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
    'hotel_rating'  => $hotel_rating,
    'from_city'     => $from_city,
    'date_from'     => $date_from,
    'date_till'     => $date_till,
    'night_from'    => $night_from,
    'night_till'    => $night_till,
    'adult_amount'  => $adult_amount,
    'child_amount'  => $child_amount,
    'child_age'     => $child_age,
    'price_limit'   => $price_limit,
    'tour_type'     => $tour_type,
    'tour_kind'     => $tour_kind,
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