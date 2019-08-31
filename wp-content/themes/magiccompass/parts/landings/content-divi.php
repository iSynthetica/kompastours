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
$counter_date = date("Y/m/d H:i:s", strtotime('tomorrow'));
?>
<section id="landing-header__section" class="bg-white-color ptb-10 ptb-md-20">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                <div class="text-center text-md-left">
                    <img class="footer-logo" src="<?php echo SNTH_IMAGES_URL ?>/logo-new-color-hd.png" data-rjs="<?php echo SNTH_IMAGES_URL ?>/logo-new-color-hd.png" alt="" style="max-width: 180px">
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
the_content();
?>