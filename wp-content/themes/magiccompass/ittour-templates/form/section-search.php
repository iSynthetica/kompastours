<?php
/**
 * Template part for displaying empty search section for loading via ajax
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/Form
 * @version 0.0.8
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$form_data = '';

if (!empty($country)) $form_data        .= ' data-country="'.$country.'"';
if (!empty($region)) $form_data         .= ' data-region="'.$region.'"';
if (!empty($hotel)) $form_data          .= ' data-hotel="'.$hotel.'"';
if (!empty($hotel_rating)) $form_data   .= ' data-hotel-rating="'.$hotel_rating.'"';
if (!empty($from_city)) $form_data      .= ' data-from-city="'.$from_city.'"';
if (!empty($date_from)) $form_data      .= ' data-date-from="'.$date_from.'"';
if (!empty($date_till)) $form_data      .= ' data-date-till="'.$date_till.'"';
if (!empty($night_from)) $form_data     .= ' data-night-from="'.$night_from.'"';
if (!empty($night_till)) $form_data     .= ' data-night-till="'.$night_till.'"';
if (!empty($adult_amount)) $form_data   .= ' data-adult-amount="'.$adult_amount.'"';
if (!empty($child_amount)) $form_data   .= ' data-child-amount="'.$child_amount.'"';
if (!empty($child_age)) $form_data      .= ' data-child-age="'.$child_age.'"';
?>

<section id="search-section">
    <div class="container">
        <div class="search-form_ajax"<?php echo $form_data; ?>>
            <div class="search-form__holder">
                <div class="progress-bar__container" style="padding:10px;">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="progress" style="height: 40px;">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    <span style="font-size:19px;font-weight:700;"><?php echo __('Loading search form', 'snthwp'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
