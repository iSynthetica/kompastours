<?php
/**
 * Customer note email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-note.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @var $message
 */
?>
    <!-- Section 3 -->
    <layout label='Section 3'>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
            <tr>
                <td class="content-spacing"
                    style="font-size:0pt; line-height:0pt; text-align:left" width="30"></td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"
                           class="spacer"
                           style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                        <tr>
                            <td height="30" class="spacer"
                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                &nbsp;
                            </td>
                        </tr>
                    </table>

                    <div class="text" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:12px; line-height:20px; text-align:left">
                        <?php echo $message ?>
                    </div>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0"
                           class="spacer"
                           style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                        <tr>
                            <td height="30" class="spacer"
                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                &nbsp;
                            </td>
                        </tr>
                    </table>

                </td>
                <td class="content-spacing"
                    style="font-size:0pt; line-height:0pt; text-align:left" width="30"></td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer"
               style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
            <tr>
                <td height="20" class="spacer"
                    style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                    &nbsp;
                </td>
            </tr>
        </table>

    </layout>
    <!-- END Section 3 -->
