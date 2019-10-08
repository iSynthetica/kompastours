<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Titles
 * @version 0.1.0
 * @since 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$subscribe = get_field('subscribe', 'options');

if (!empty($subscribe)) {
    ?>
    <section id="subscribe" class="ptb-20 bg-orange-color">
        <div class="container">
            <?php
            if (!empty($subscribe['title'] || !empty($subscribe['text']))) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <?php
                        if (!empty($subscribe['title'])) {
                            ?>
                            <h2 class="text-center mt-0 mb-10 font-weight-600 txt-white-color"><?php echo $subscribe['title'] ?></h2>
                            <?php
                        }

                        if (!empty($subscribe['text'])) {
                            ?>
                            <p class="text-center mt-0 mb-20 txt-white-color"><?php echo $subscribe['text'] ?></p>
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <?php
            }

            if (!empty($subscribe["viber"]) || !empty($subscribe["telegram"])) {
                ?>
                <div class="row">
                    <?php
                    if (!empty(!empty($subscribe["viber"]) && !empty($subscribe["telegram"]))) {
                        ?>
                        <div class="col-md-6 text-center">
                            <a
                                href="<?php echo $subscribe["viber"]["link"]["url"] ?>"
                                target="_blank"
                                class="btn shape-rnd hvr-invert size-xl bg-viber-color" style="width: 100%; max-width: 250px"
                            >
                                <i class="fab fa-viber"></i> Viber
                            </a>
                        </div>

                        <div class="col-md-6 text-center">
                            <a
                                href="<?php echo $subscribe["telegram"]["link"]["url"] ?>"
                                target="_blank"
                                class="btn shape-rnd hvr-invert size-xl bg-telegram-color" style="width: 100%; max-width: 250px"
                            >
                                <i class="fab fa-telegram-plane"></i> Telegram
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
    <?php
}