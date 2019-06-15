<?php
/**
 * Statit image background page title template
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Titles
 * @version 0.0.10
 * @since 0.0.10
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$title = !empty($title) ? $title : '';
$subtitle = !empty($subtitle) ? $subtitle : '';
$thumbnail_url = !empty($thumbnail_url) ? $thumbnail_url : get_the_post_thumbnail_url(null, 'full');
?>

<section class="cover-background pt-80 ptb-60 ptb-md-80 ptb-lg-140 bg-overlay-holder" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $thumbnail_url ?>');">
    <div class="bg-overlay bg-black-color bg-opacity-1"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 extra-small-screen text-center page-title-extra-small d-flex flex-column justify-content-center">
                <h1 class="txt-white-color mt-10 entry-title title-style1"><?php echo $title; ?></h1>

                <?php
                if (!empty($subtitle)) {
                    ?><h2 class="txt-white-color"><?php echo $subtitle; ?></h2><?php
                }
                ?>

            </div>
        </div>
    </div>
</section>
