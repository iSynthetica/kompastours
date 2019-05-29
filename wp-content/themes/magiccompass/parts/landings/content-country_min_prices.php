<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts
 * @version 0.1.2
 * @since 0.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$country_id = $settings['country'];
$country = get_field('ittour_id', $country_id);
$thumbnail_url = get_the_post_thumbnail_url(null, 'full');

if (empty($thumbnail_url)) {
    $thumbnail_url = snth_default_image();
}

$video = false;
$counter_date = date("Y/m/d H:i:s", strtotime('tomorrow'))
?>



<section id="landing-header__section" class="bg-white-color ptb-10 ptb-md-20">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                <div class="text-center text-md-left">
                    <img class="footer-logo" src="<?php echo SNTH_IMAGES_URL ?>/newlogo.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/logo-cloud.png" alt="" style="max-width: 180px">
                </div>
            </div>
            <div class="col-12 col-sm-4 col-md-6 col-lg-6 col-xl-8">

            </div>
            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2 d-flex flex-column justify-content-center">
                <div class="">
                    <div data-enddate="<?php echo $counter_date ?>" class="countdown text-center text-md-right text-white-2 counter-box-5"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
if (!empty($settings["youtube_video_id"])) {
    $video = $settings["youtube_video_id"];
}

if ($video) {
    ?>
    <section id="video-banner__section" class="bg-red-color loading p-5 p-md-20">
        <div class="container-fluid prl-0">
            <div class="row no-gutters">
                <div class="col-12 col-md-6 show-for-desktop" style="display:none">
                    <div class="video-background__holder">
                        <div class="video-background">
                            <div class="video-foreground" id="YouTubeBackgroundVideoPlayer" data-video-id="<?php echo $video; ?>">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 show-for-mobile" style="display:none">
                    <div class="cover-background pt-80 ptb-60 ptb-md-80 ptb-lg-140 bg-overlay-holder" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $thumbnail_url ?>');">
                        <div class="bg-overlay bg-black-color bg-opacity-10"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 extra-small-screen text-center page-title-extra-small d-flex flex-column justify-content-center"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
                    <div class="banner-title__holder p-10 p-md-20 w-100">
                        <h1 class="txt-white-color text-center font-weight-900 mt-10 mb-30 text-uppercase">
                            <?php the_title(); ?>
                        </h1>

                        <div class="sale-holder txt-white-color text-center font-alt font-weight-900 mtb-10 text-uppercase">
                            <?php echo __('Sale', 'snthwp') ?> -30%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>var ytVideoId = '<?php echo $video; ?>';</script>
    <script async src="https://www.youtube.com/iframe_api"></script>
    <script async src="<?php echo SNTH_SCRIPTS_URL ?>/video.js"></script>

    <?php
} else {
    ?>
    <section id="banner__section">
        <div class="container-fluid prl-0">
            <div class="row no-gutters">
                <div class="col-12 col-md-6">
                    <div class="cover-background pt-80 ptb-60 ptb-md-80 ptb-lg-140 bg-overlay-holder" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $thumbnail_url ?>');">
                        <div class="bg-overlay bg-black-color bg-opacity-10"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 extra-small-screen text-center page-title-extra-small d-flex flex-column justify-content-center"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 bg-red-color align-items-center d-flex">
                    <div class="banner-title__holder p-20 w-100">
                        <h1 class="txt-white-color text-center font-weight-900 text-uppercase">
                            <?php the_title(); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>

<?php
if (!empty($settings["prices"])) {
    $count = count($settings["prices"]);
    $i = 1;
    ?>
    <section id="min-prices__section" class="ptb-20 ptb-md-40 ptb-lg-60">
        <div class="container">
        <?php
        foreach ($settings["prices"] as $price_settings) {
            $settings_key = '';
            $settings_key .= 'country_min_prices';
            $settings_key .= $country;

            $type = true === $price_settings['type'] ? 1 : 2;

            $settings_key .= $type;

            $template_args = array(
                'type' => $type,
                'country' => $country,
                'items_per_page' => 1,
            );

            if (1 === $type && !empty($price_settings["kind"])) {
                $template_args['kind'] = $price_settings["kind"];
                $settings_key .= $price_settings["kind"];
            }

            if (!empty($price_settings["night_from"])) {
                $template_args['night_from'] = $price_settings["night_from"];
                $settings_key .= $price_settings["night_from"];
            } else {
                $template_args['night_from'] = '7';
                $settings_key .= '7';
            }

            if (!empty($price_settings["night_till"])) {
                $template_args['night_till'] = $price_settings["night_till"];
                $settings_key .= $price_settings["night_till"];
            } else {
                $template_args['night_till'] = '7';
                $settings_key .= '7';
            }

            if (!empty($price_settings["adult_amount"])) {
                $template_args['adult_amount'] = $price_settings["adult_amount"];
                $settings_key .= $price_settings["adult_amount"];
            } else {
                $template_args['adult_amount'] = '2';
                $settings_key .= '2';
            }

            if (!empty($price_settings["child_amount"])) {
                $template_args['child_amount'] = $price_settings["child_amount"];
                $settings_key .= $price_settings["child_amount"];

                if (!empty($price_settings['child_age'])) {
                    $child_age = $price_settings["child_age"];
                } else {
                    $child_amount = (int) $price_settings["child_amount"];

                    if (1 === $child_amount) {
                        $child_age = '5';
                    } else if (2 === $child_amount) {
                        $child_age = '5:8';
                    } else if (3 === $child_amount) {
                        $child_age = '5:8:12';
                    } else {
                        $child_age = '5';
                    }
                }

                $template_args['child_age'] = $child_age;
                $settings_key .= $child_age;
            } else {
                $settings_key .= '0';
            }

            $settings_key_hash = md5($settings_key);

            $saved_prices = get_transient('lp_' . $settings_key_hash);

            if (!empty($price_settings["section_title"])) {
                $template_args['title'] = $price_settings["section_title"];
            }

            if (!empty($price_settings["section_subtitle"])) {
                $template_args['subtitle'] = $price_settings["section_subtitle"];
            }

            if (!empty($saved_prices)) {
                $need_update = false;

                foreach ($saved_prices as $saved_price) {
                    $results = $saved_price["results"];

                    foreach ($results as $result) {
                        if (empty($result)) {
                            $need_update = true;
                        }
                    }
                }


                if (!$need_update) {
                    $template_args = array(
                        'country' => $country,
                        'result' => $saved_prices
                    );
                }
            }

            if (!empty($price_settings["section_title"])) {
                $template_args['title'] = $price_settings["section_title"];
            }

            if (!empty($price_settings["section_subtitle"])) {
                $template_args['subtitle'] = $price_settings["section_subtitle"];
            }

            snth_show_template('landings/section-min-prices-by-month.php', $template_args);

            if ($i < $count) {
                ?>
                <hr class="mtb-20 mtb-md-40">
                <?php
            }

            $i++;
        }
        ?>
        </div>
    </section>
    <?php
}

snth_show_template('landings/section-order-form.php', array(
    'country' => $country,
    'title' => get_the_title()
));
?>