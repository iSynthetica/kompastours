<?php
/**
 * Header topline
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Header
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div id="top_line">
    <div class="container">
        <div class="row">
            <div class="col-6"><i class="icon-phone"></i><strong>0045 043204434</strong></div>
            <div class="col-6">
                <ul id="top_links">
                    <li><a href="#sign-in-dialog" id="access_link"><i class="far fa-user"></i> <?php echo __('Sign in', 'snthwp'); ?></a></li>
                    <li><a href="wishlist.html" id="wishlist_link"><i class="far fa-heart"></i> <?php echo __('Wishlist', 'snthwp'); ?></a></li>
                </ul>
            </div>
        </div><!-- End row -->
    </div><!-- End container-->
</div><!-- End top line-->
