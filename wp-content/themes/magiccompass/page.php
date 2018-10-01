<?php
/**
 * Single page template file
 *
 * @package WordPress
 * @subpackage Magiccompass
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php get_header(); ?>

    <section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo SNTH_IMAGES_URL ?>/samples/header_bg.jpg" data-natural-width="1400" data-natural-height="470">
        <div class="parallax-content-1">
            <div class="animated fadeInDown">
                <h1>About us</h1>
                <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
            </div>
        </div>
    </section>

<?php get_footer(); ?>