<?php
/**
 * Display Single Tour content
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if (empty($template)) {
    $template = 'no-sidebar';
}

$is_ajax = false;

if (empty($_GET['key'])) {
    $ittour_content = ittour_get_template('single-tour-content.php', array('tour_info' => $tour_info));
} else {
    global $ittour_global_tour_result;

    if (!empty($ittour_global_tour_result["result"])) {
        $tour_info = $ittour_global_tour_result["result"];
    } else {
        $tour_key = $_GET['key'];
        $tour = ittour_tour($tour_key, ITTOUR_LANG);
        $tour_info = $tour->info();
    }

    if (empty($tour_info["from_city_id"]) && !empty($_GET["from_city"])) {
        $tour_info["from_city_id"] = (int) $_GET["from_city"];
    }

    if (empty($tour_info["child_age"]) && !empty($_GET["child_age"])) {
        $tour_info["child_age"] = $_GET["child_age"];
    }

    $country = ittour_get_destination_by_ittour_id($tour_info['country_id']);
    $country_info = ittour_destination_by_ittour_id($tour_info['country_id']);

    $main_currency = $country_info["main_currency"];

    if ('10' === $main_currency) {
        $main_currency_label = __('€', 'snthwp');
    } else if ('1' === $main_currency) {
        $main_currency_label = __('$', 'snthwp');
    } else if ('2' === $main_currency) {
        $main_currency_label = __('UAH', 'snthwp');
    }

    if (!empty($country)) {
        $country_url = get_permalink($country_info['ID']);
        $country_title = '<a href="'.$country_url.'">'.$tour_info['country'].'</a>';
    } else {
        $country_title = $tour_info['country'];
    }

    $region = ittour_get_destination_by_ittour_id($tour_info['region_id']);

    if (!empty($region)) {
        $region_url = get_permalink($region[0]->ID);
        $region_title = '<a href="'.$region_url.'">'.$tour_info['region'].'</a>';
    } else {
        $region_title = $tour_info['region'];
    }

    $hotel_site_info = ittour_destination_by_ittour_id($tour_info['hotel_id']);

    if (!empty($hotel_site_info)) {
        $hotel_site_ID = $hotel_site_info['ID'];
    } elseif (!empty($region)) {
        $ittour_hotel_name = $tour_info["hotel"] . ' ' . ittour_get_hotel_number_rating_by_id($tour_info["hotel_rating"]);
        $ittour_hotel_slug = snth_get_slug_lat($ittour_hotel_name);
        $ittour_hotel_info = !empty($tour_info["hotel_info"]) ? $tour_info["hotel_info"] : '';
        $hotel_site_ID = ittour_create_hotel($ittour_hotel_name, $ittour_hotel_slug, $tour_info['hotel_id'], $tour_info["hotel_rating"], '', $tour_info['country_id'], $tour_info['region_id'], $region[0]->ID, $ittour_hotel_info);
    }

    $ittour_content = ittour_get_template('single-tour-content.php', array(
            'tour_info' => $tour_info,
            'main_currency_label' => $main_currency_label,
            'main_currency' => $main_currency,
        )
    );
    ?>
    <section id="single_tour__heading" class="bg-gray-5-color ptb-lg-40 ptb-20 top-space">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <h1 class="hotel_title mt-0"><?php echo $tour_info['hotel']; ?> <?php echo ittour_get_hotel_number_rating_by_id($tour_info['hotel_rating']); ?></h1>
                    <div class="hotel_location"><i class="fas fa-map-marker-alt"></i> <?php echo $country_title . ', ' .$region_title; ?></div>
                </div>

                <div class="col-md-4 col-lg-3">

                </div>
            </div>
        </div>
    </section>
    <?php
}
?>

<div class="wrap">
    <?php
    if ( 'full-width' === $template ) {
        ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php echo $ittour_content; ?>
            </main>
        </div>
        <?php
    } else {
        ?>
        <div class="container ptb-15 ptb-md-40">
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
        <?php
    }
    ?>
</div>
