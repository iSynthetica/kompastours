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
    <div id="phone_container" class="contact__container">
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

$emails = get_field('emails', 'options');

if (!empty($emails)) {
    ?>
    <div id="email_container" class="contact__container">
        <i class="far fa-envelope contact-item__icon"></i>
        <?php
        foreach ($emails as $email) {
            ?>
            <p class="contact-item__holder">
                <?php
                if (!empty($email['link'])) {
                    echo '<a href="'.$email['link'].'">';
                } else {
                    echo '<span>';
                }

                echo $email['label'];

                if (!empty($email['link'])) {
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

$schedule = get_field('schedule', 'options');

if (!empty($schedule)) {
    ?>
    <div id="schedule_container" class="contact__container">
        <i class="far fa-clock contact-item__icon"></i>

        <?php
        foreach ($schedule as $item) {
            if (!empty($item['description']) && !empty($item['time'])) {
                ?>
                <p class="contact-item__holder">
                    <small><?php echo $item['description'] ?></small>: <strong><?php echo $item['time'] ?></strong>
                </p>
                <?php
            }
        }
        ?>
    </div>
    <?php
}

?>
