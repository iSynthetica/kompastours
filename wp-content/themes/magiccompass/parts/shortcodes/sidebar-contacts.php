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
    <div class="contact__container phone-contact__container">
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

$messangers = get_field('messangers', 'options');

if (!empty($messangers)) {
    if (!empty($phones)) echo '<hr>';

    foreach ($messangers as $item) {
        ?>
        <div class="contact__container">
            <i class="fab fa-<?php echo $item['icon'] ?> contact-item__icon"></i>
            <p class="contact-item__holder">
                <a href="<?php echo $item['link'] ?>" title="<?php echo $item['label'] ?>">
                    <?php echo $item['label'] ?>
                </a>
            </p>
        </div>
        <?php
    }
}

$emails = get_field('emails', 'options');

if (!empty($emails)) {

    if (!empty($phones)) {
        ?>
        <hr>
        <?php
    }

    ?>
    <div class="contact__container">
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

    if (!empty($phones) || !empty($emails)) {
        ?>
        <hr>
        <?php
    }
    ?>
    <div class="contact__container">
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
