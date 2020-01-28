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

/**
 * @var array $tour_info
 * @var integer $main_currency
 * @var string $main_currency_label
 */

if (empty($tour_info)) {
    return;
}

if (!empty($tour_info['accomodations'])) {
    $accomodations = ittour_get_excursion_accomodation_by_id($tour_info['accomodations']);
}
?>

<div id="single-tour-booking__holder" class="box_style_1 expose table-summary_holder"
     data-key="<?php echo $tour_info["tour_id"]; ?>"
     data-currency="<?php // echo $main_currency; ?>"
>
    <?php
    if (!empty($tour_info['dates'])) {
        $local_currency = $tour_info['local_currency'];
        $currency = $tour_info['tour_currency'];

        foreach ($tour_info['dates'] as $tour_date) {
            if (false) {
                ?>
                <h4><?php echo $tour_date['date_from']; ?></h4>
                <?php
            }

            foreach ($tour_date['prices'] as $price) {
                $accomodation = $accomodations[$price['accomodation_id']];
                $accomodation_name = $accomodation['name'];
                $accomodation_icon = '<span style="display: inline-block;color: #e04f67;font-size:120%;">';

                if (1 == $accomodation['adult_amount']) {
                    $accomodation_icon .= '<i class="fas fa-male"></i>';
                } elseif(2 == $accomodation['adult_amount']) {
                    $accomodation_icon .= '<i class="fas fa-male"></i><i class="fas fa-male"></i>';
                } elseif(3 == $accomodation['adult_amount']) {
                    $accomodation_icon .= '<i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i>';
                } elseif(4 == $accomodation['adult_amount']) {
                    $accomodation_icon .= '<i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i><i class="fas fa-male"></i>';
                }

                if (1 == $accomodation['child_amount']) {
                    $accomodation_icon .= '<small><i class="fas fa-child"></i></small>';
                } elseif(2 == $accomodation['child_amount']) {
                    $accomodation_icon .= '<small><i class="fas fa-child"></i><i class="fas fa-child"></i></small>';
                } elseif(3 == $accomodation['child_amount']) {
                    $accomodation_icon .= '<small><i class="fas fa-child"></i><i class="fas fa-child"></i><i class="fas fa-child"></i></small>';
                } elseif(4 == $accomodation['child_amount']) {
                    $accomodation_icon .= '<small><i class="fas fa-child"></i><i class="fas fa-child"></i><i class="fas fa-child"></i><i class="fas fa-child"></i></small>';
                }
                $accomodation_icon .= '</span>';

                // var_dump($accomodation);
                if ($local_currency === $currency) {
                    ?>
                    <p>
                        <?php echo $accomodation_icon ?>
                        <?php echo __('from', 'snthwp'); ?> <?php echo $price['prices'][$local_currency] ?>
                        <?php echo __('UAH', 'snthwp'); ?>
                    </p>
                    <?php
                } else {
                    ?>
                    <p>
                        <?php echo $accomodation_icon ?>
                        <?php echo __('from', 'snthwp'); ?> <?php echo $tour_info['tour_currency_label']; ?><?php echo $price['prices'][$currency] ?>
                        (<?php echo $price['prices'][$local_currency] ?> <?php echo __('UAH', 'snthwp'); ?>)
                        <?php
                        if (8 == $price['accomodation_id']) {
                            ?><small>(<?php echo $accomodation_name ?>)</small><?php
                        }
                        ?>
                    </p>
                    <?php
                }
            }

            break;
        }
    }

    ittour_show_template('single-excursion-tour/open-booking-btn.php');

    if (false) {
        ?>
        <button id="change-parameters-btn"
                class="btn bg-primary-color type-hollow shape-rnd hvr-invert size-xs size-extended text-uppercase mb-0 font-alt font-weight-900"
                type="button"
        >
            <?php echo __('Change parameters', 'snthwp'); ?>
        </button>
        <?php
    }
    ?>


    <button class="btn bg-gray-50-color type-hollow size-sm shape-rnd hvr-invert size-extended text-uppercase font-alt font-weight-900 d-none">
        <?php echo __('Ask a question', 'snthwp'); ?>
    </button>

    <?php
    ittour_show_template('single-excursion-tour/book-tour-form-popup.php', array(
           'tour_info' => $tour_info,
    ));
    ?>
</div>
