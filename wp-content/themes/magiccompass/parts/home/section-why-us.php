<?php
/**
 * Why us sections for Home page
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Home
 * @version 0.0.11
 * @since 0.0.11
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$preferences = array(
    array(
        'icon' => 'fas fa-medal',
        'count' => '11',
        'title' => __('Years in tourist business', 'snthwp'),
        'text'  => ''
    ),

    array(
        'icon' => 'fas fa-map-marked-alt',
        'count' => '71',
        'title' => __('Interesting destinations', 'snthwp'),
        'text'  => ''
    ),

    array(
        'icon' => 'far fa-grin-hearts',
        'count' => '2489',
        'title' => __('Happy clients', 'snthwp'),
        'text'  => ''
    ),

    array(
        'icon' => 'far fa-handshake',
        'count' => '40',
        'title' => __('Raliable partners', 'snthwp'),
        'text'  => ''
    ),
);

if (!empty($preferences)) {
    ?>
    <section id="why_us" class="ptb-20 ptb-md-40 ptb-lg-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mt-0 mb-20 mb-md-40 font-weight-600">Why us</h2>
                </div>
            </div>

            <div class="row">
                <?php
                foreach ($preferences as $preference) {
                    ?>
                    <div class="col-12 col-lg-3 col-md-6 text-center sm-margin-30px-bottom wow fadeInUp" data-wow-delay="0.4s">
                        <div class="counter-feature-box-1 w-100 border-all p-5">
                            <div class="counter-box bg-white d-flex justify-content-center flex-column h-100">
                                <i class="<?php echo $preference['icon']; ?> icon-extra-medium txt-gray-40-color mb-20"></i>

                                <h6 class="d-block font-weight-600 txt-theme-color alt-font mb-0 timer" data-speed="2000" data-to="<?php echo $preference['count']; ?>">
                                    <?php echo $preference['count']; ?>
                                </h6>

                                <span><?php echo $preference['title']; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}
?>


