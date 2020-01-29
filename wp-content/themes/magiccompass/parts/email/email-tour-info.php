<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 16.06.19
 * Time: 18:16
 *
 * @var $tour_info
 */

if (empty($tour_info)) {
    return;
}
?>

<!-- Section 7 -->
<layout label='Section 7'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
        <tr>
            <?php snth_email_content_spacing(); ?>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                    <tr>
                        <td height="20" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%"> </td>
                    </tr>
                </table>

                <!-- Head -->
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <div class="section-title" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:16px; line-height:24px; text-align:left; text-transform:uppercase"><?php _e( 'Tour Information', 'snthwp' ); ?></div>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                <tr>
                                    <td height="5" class="spacer" style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                        &nbsp;
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="img" style="font-size:0pt; line-height:0pt; text-align:left" bgcolor="#ff5e56" height="3">&nbsp; </td>
                                </tr>
                            </table>

                            <?php snth_email_content_row_spacer(10) ?>
                        </td>
                    </tr>
                </table>
                <!-- Head -->
            </td>
            <?php snth_email_content_spacing(); ?>
        </tr>
        <tr>
            <?php snth_email_content_spacing(); ?>
            <td>
                <?php snth_email_content_row_spacer(5) ?>

                <?php
                if (!empty($tour_info['tour_name'])) {
                    ?>
                    <!-- Content -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="35%">
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; text-align:left">
                                    <?php _e('Tour title', 'snthwp'); ?>
                                </div>
                            </td>

                            <td>
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; font-weight: 700; text-align:left">
                                    <?php echo $tour_info['tour_name']; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php snth_email_content_row_spacer(5) ?>
                    <!-- Content -->
                    <?php
                }

                if (!empty($tour_info['tour_url'])) {
                    ?>
                    <!-- Content -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="35%">
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; text-align:left">
                                    <?php _e('Tour link', 'snthwp'); ?>
                                </div>
                            </td>

                            <td>
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; font-weight: 700; text-align:left">
                                    <?php echo $tour_info['tour_url']; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php snth_email_content_row_spacer(5) ?>
                    <!-- Content -->
                    <?php
                }

                if (!empty($tour_info['country_name_list'])) {
                    ?>
                    <!-- Content -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="35%">
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; text-align:left">
                                    <?php _e('Countries', 'snthwp'); ?>
                                </div>
                            </td>

                            <td>
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; font-weight: 700; text-align:left">
                                    <?php echo $tour_info['country_name_list']; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php snth_email_content_row_spacer(5) ?>
                    <!-- Content -->
                    <?php
                }

                if (!empty($tour_info['city_name_list'])) {
                    ?>
                    <!-- Content -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="35%">
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; text-align:left">
                                    <?php _e('Cities', 'snthwp'); ?>
                                </div>
                            </td>

                            <td>
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; font-weight: 700; text-align:left">
                                    <?php echo $tour_info['city_name_list']; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php snth_email_content_row_spacer(5) ?>
                    <!-- Content -->
                    <?php
                }

                if (!empty($tour_info['meal_type'])) {
                    ?>
                    <!-- Content -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="35%">
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; text-align:left">
                                    <?php _e('Meal type', 'snthwp'); ?>
                                </div>
                            </td>

                            <td>
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; font-weight: 700; text-align:left">
                                    <?php echo $tour_info['meal_type']; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php snth_email_content_row_spacer(5) ?>
                    <!-- Content -->
                    <?php
                }

                if (!empty($tour_info['night_from'])) {
                    ?>
                    <!-- Content -->
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="35%">
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; text-align:left">
                                    <?php _e('Tour duration', 'snthwp'); ?>
                                </div>
                            </td>

                            <td>
                                <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:14px; line-height:18px; font-weight: 700; text-align:left">
                                    <?php echo $tour_info['night_from']; ?> <?php echo __('nights', 'snthwp'); ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php snth_email_content_row_spacer(5) ?>
                    <!-- Content -->
                    <?php
                }
                ?>
            </td>
            <?php snth_email_content_spacing(); ?>
        </tr>
        <tr>
            <?php snth_email_content_spacing(); ?>
            <td>
                <?php snth_email_content_row_spacer(20) ?>
            </td>
            <?php snth_email_content_spacing(); ?>
        </tr>
    </table>

    <?php snth_email_content_row_spacer(10) ?>

</layout>
<!-- END Section 7 -->