<?php
/**
 * Template part for displaying Search steps
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts
 * @version 0.0.8
 * @since 0.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$search_steps = get_field('timeline_items');
?>

<div id="search-result" class="search-result container">
    <div class="main_title">
        <h2><?php echo __('How to', 'snthwp'); ?></h2>
        <p>
            Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.
        </p>
    </div>

    <hr>

    <?php
    if (!empty($search_steps)) {
        ?>
        <ul class="cbp_tmtimeline">
            <?php
            foreach ($search_steps as $step) {
                ?>
                <li>
                    <?php
                    if (!empty($step['steps']['subtitle']) || !empty($step['steps']['title'])) {
                        ?>
                        <div class="cbp_tmsteps">
                            <?php
                            if (!empty($step['steps']['subtitle'])) {
                                ?><span class="cbp_tmsteps_subtitle"><?php echo $step['steps']['subtitle'] ?></span><?php
                            }

                            if (!empty($step['steps']['title'])) {
                                ?><span class="cbp_tmsteps_title"><?php echo $step['steps']['title'] ?></span><?php
                            }
                            ?>
                        </div>
                        <?php
                        if (!empty($step['steps']['icon'])) {
                            ?><i class="cbp_tmicon <?php echo $step['steps']['icon'] ?>"></i><?php
                        }
                        ?>


                        <div class="cbp_tmlabel">
                            <h2>
                                <?php
                                if (!empty($step['content']['subtitle'])) {
                                    ?><span><?php echo $step['content']['subtitle'] ?></span><?php
                                }
                                ?>
                                <?php echo $step['content']['title'] ?>
                            </h2>
                            <?php echo wpautop($step['content']['content']) ?>
                        </div>
                        <?php
                    }
                    ?>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
    ?>
</div>
