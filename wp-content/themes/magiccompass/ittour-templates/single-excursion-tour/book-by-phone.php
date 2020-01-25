<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/SingleTour
 * @version 0.1.0
 * @since 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;
$phones = get_field('phones', 'options');
$schedule = get_field('schedule', 'options');

if (empty($phones)) {
    return;
}
?>

<div class="box_style_4">
    <i class="icon_set_1_icon-90"></i>

    <h4 class="mt-0 mb-20"><?php echo __('<span>Book</span> by phone', 'snthwp'); ?></h4>

    <?php
    foreach ($phones as $phone) {
        ?>
        <p class="m-0">
            <a href="<?php echo $phone["link"]; ?>" class="phone font-alt font-weight-900"><?php echo $phone["label"]; ?></a>
        </p>
        <?php
    }

    if (false) {
        foreach ($schedule as $item) {
            if (!empty($item['description']) && !empty($item['time'])) {
                ?>
                <p class="m-0">
                    <small><?php echo $item['description'] ?></small>: <strong><?php echo $item['time'] ?></strong>
                </p>
                <?php
            }
        }
    }
    ?>
</div>
