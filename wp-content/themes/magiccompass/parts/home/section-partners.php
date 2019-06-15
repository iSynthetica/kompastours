<?php
/**
 * Popular destinations for Home page
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Home
 * @version 0.0.11
 * @since 0.0.11
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$partners = get_field('partners_section');

if (empty($partners) || empty($partners['section_content']['partners'])) {
    return;
}
?>

<section id="popular_destinations" class="ptb-20 ptb-md-40 ptb-lg-40">
    <div class="container">
        <?php
        if (!empty($partners['section_title'])) {
            ?>
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mt-0 mb-20 mb-md-40 font-weight-600"><?php echo $partners['section_title']; ?></h2>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="row">
            <?php
            foreach ($partners['section_content']['partners'] as $partner) {
                ?>
                <div class="col-6 col-lg-3">
                    <div class="text-center mb-10 mb-md-20 mb-lg-40">
                        <?php echo get_the_post_thumbnail( $partner->ID, 'logo_thumb', array(
                            'style' => 'max-width:100%;width:220px;'
                        ) ); ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <?php
        if (!empty($partners["primary_button"]["link"]) || $partners["secondary_button"]["link"]) {
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="text-center mt-0 mt-lg-20">
                        <?php
                        if (!empty($partners["primary_button"]["link"])) {
                            ?>
                            <a class="btn size-lg shape-rnd hvr-invert prl-40 mrl-10 mb-0 text-uppercase font-alt font-weight-900" href="<?php echo $partners["primary_button"]["link"]['url'] ?>"><?php echo $partners['primary_button']['label'] ?></a>
                            <?php
                        }

                        if (!empty($partners["secondary_button"]["link"])) {
                            ?>
                            <a class="btn size-lg type-hollow shape-rnd hvr-invert prl-40 mrl-10 mb-0 text-uppercase font-alt font-weight-900" href="<?php echo $partners["secondary_button"]["link"]['url'] ?>"><?php echo $partners['secondary_button']['label'] ?></a>
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

