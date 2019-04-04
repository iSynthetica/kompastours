<?php
/**
 * Shortcodes - Need Help
 *
 * @package Magiccompass
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$phones = get_field('phones', 'options');

if (!empty($phones)) {
    ?>
    <div id="phone_container">
        <i class="fas fa-phone contact-item__icon"></i>
        <?php
        foreach ($phones as $phone) {
            ?>
            <p class="contact-item__holder">
                <?php
                if (!empty($phone['link'])) {
                    echo '<a href="'.$phone['link'].'">';
                } else {
                    echo '<span>';
                }

                echo $phone['label'];

                if (!empty($phone['link'])) {
                    echo '</a>';
                } else {
                    echo '</span>';
                }
                ?>
            </p>
            <?php
        }
        ?>
    </div>
    <?php
}
?>

<a href="tel://004542344599" id="phone">+45 423 445 99</a>
<a href="mailto:help@citytours.com" id="email_footer">help@citytours.com</a>
