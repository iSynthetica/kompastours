<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Titles
 * @version 0.0.10
 * @since 0.0.10
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$title = !empty($title) ? $title : get_the_title();
$subtitle = !empty($subtitle) ? $subtitle : '';
?>

<section class="bg-gray-20-color ptb-lg-40 ptb-20 top-space">
    <div class="container">
        <div class="row">
            <div class="col-12 page-title-medium text-center d-flex flex-column justify-content-center">
                <h1 class="txt-black-color"><?php echo $title; ?></h1>
                <?php
                if (!empty($subtitle)) {
                    ?><span class="txt-black-color"><?php echo $subtitle; ?></span><?php
                }
                ?>
            </div>
        </div>
    </div>
</section>
