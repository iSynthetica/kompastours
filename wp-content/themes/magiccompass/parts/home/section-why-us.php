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

$why_us = get_field('why_us');

if (!empty($why_us["items"])) {
    ?>
    <section id="why_us" class="ptb-20 ptb-md-40 ptb-lg-60">
        <div class="container">
            <?php
            if (!empty($why_us["section_title"])) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center mt-0 mb-20 mb-md-40 font-weight-600"><?php echo $why_us["section_title"]; ?></h2>
                    </div>
                </div>
                <?php
            }
            ?>

            <div class="row">
                <?php
                foreach ($why_us["items"] as $item) {
                    ?>
                    <div class="col-12 col-lg-3 col-md-6 text-center">
                        <div class="counter-feature-box-1 w-100 p-5">
                            <div class="counter-box bg-white d-flex justify-content-center flex-column h-100">
                                <i class="<?php echo $item['icon']; ?> icon-extra-medium txt-gray-40-color mb-20"></i>

                                <h6 class="d-block font-weight-600 txt-theme-color alt-font mb-0 timer" data-speed="2000" data-to="<?php echo $item['counter']; ?>">
                                    <?php echo $item['counter']; ?>
                                </h6>

                                <span class="d-block prl-20"><?php echo $item['title']; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <?php
            if (!empty($why_us["primary_button"]["link"]) || $why_us["secondary_button"]["link"]) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="text-center mt-10 mt-md-20 mt-lg-40">
                            <?php
                            if (!empty($why_us["primary_button"]["link"])) {
                                ?>
                                <a class="btn size-xl shape-rnd hvr-invert prl-40 mrl-10 mb-0 text-uppercase font-alt font-weight-900" href="<?php echo $why_us["primary_button"]["link"]['url'] ?>"><?php echo $why_us['primary_button']['label'] ?></a>
                                <?php
                            }

                            if (!empty($why_us["secondary_button"]["link"])) {
                                ?>
                                <a class="btn size-xl type-hollow shape-rnd hvr-invert prl-40 mrl-10 mb-0 text-uppercase font-alt font-weight-900" href="<?php echo $why_us["secondary_button"]["link"]['url'] ?>"><?php echo $why_us['secondary_button']['label'] ?></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
    <?php
}
?>


