<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates/Emails
 * @version 2.4.0
 *
 * @var $preheader_text
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * @var $email_heading
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--[if gte mso 15]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="format-detection" content="date=no"/>
    <meta name="format-detection" content="address=no"/>
    <meta name="format-detection" content="telephone=no"/>
    <title>Email Template</title>


    <style type="text/css" media="screen">
        /* Linked Styles */
        body {
            padding: 0 !important;
            margin: 0 !important;
            display: block !important;
            min-width: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
            -webkit-text-size-adjust: none
        }

        a {
            color: #ff0000;
            text-decoration: none
        }

        p {
            padding: 0 !important;
            margin: 0 !important
        }

        img {
            -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */
        }

        .text4 a {
            color: #777777 !important;
            text-decoration: none !important;
        }

        .h2-white-m-center a {
            color: #ffffff !important;
        }

        .h4-white a {
            color: #ffffff !important;
        }

        .h3-white a {
            color: #ffffff !important;
        }

        .text-top-white a {
            color: #ffffff !important;
        }

        .text-white-m-center a {
            color: #ffffff !important;
        }

        .text-white-r-m-center a {
            color: #ffffff !important;
        }

        .text-white-center a {
            color: #ffffff !important;
        }

        .text-white a {
            color: #ffffff !important;
        }

        .text-mont a {
            color: #ffffff !important;
        }

        .text-day3 a {
            color: #ffffff !important;
        }

        .yellow a {
            color: #ebb44a !important;
        }

        .green a {
            color: #3cb371 !important;
        }

        .red a {
            color: #ff5e56 !important;
        }

        .text-list a {
            color: #777777 !important;
        }

        .text-top a {
            color: #777777 !important;
        }

        /* Mobile styles */
        @media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
            div[class='mobile-br-1'] {
                height: 1px !important;
                background: #e8e8e8 !important;
                display: block !important;
            }

            div[class='mobile-br-5'] {
                height: 5px !important;
            }

            div[class='mobile-br-10'] {
                height: 10px !important;
            }

            div[class='mobile-br-15'] {
                height: 15px !important;
            }

            th[class='m-td'],
            td[class='m-td'],
            div[class='hide-for-mobile'],
            span[class='hide-for-mobile'] {
                display: none !important;
                width: 0 !important;
                height: 0 !important;
                font-size: 0 !important;
                line-height: 0 !important;
                min-height: 0 !important;
            }

            span[class='mobile-block'] {
                display: block !important;
            }

            div[class='text-top'],
            div[class='h2-white-m-center'],
            div[class='text-white-m-center'],
            div[class='text-white-r-m-center'],
            div[class='h2-m-center'],
            div[class='text-m-center'],
            div[class='text-r-m-center'],
            div[class='text-top-white'] {
                text-align: center !important;
            }

            div[class='text-right'] {
                text-align: left !important;
            }

            div[class='img-m-center'] {
                text-align: center !important;
            }

            div[class='fluid-img'] img,
            td[class='fluid-img'] img {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
            }

            div[class='fluid-img-logo'] img {
                width: 100% !important;
                max-width: 260px !important;
                height: auto !important;
            }

            table[class='mobile-shell'] {
                width: 100% !important;
                min-width: 100% !important;
            }

            table[class='center'] {
                margin: 0 auto;
            }

            th[class='column-top'],
            th[class='column'] {
                float: left !important;
                width: 100% !important;
                display: block !important;
            }

            td[class='td'] {
                width: 100% !important;
                min-width: 100% !important;
            }

            td[class='content-spacing'] {
                width: 15px !important;
            }
        }
    </style>
</head>
<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#f1f1f1; -webkit-text-size-adjust:none">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f1f1f1">
    <tr>
        <td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left" width="1"></td>
        <td align="center" valign="top">
            <table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
                <tr>
                    <td class="td" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; Margin:0">
                        <div class="hide-for-mobile">
                            <?php snth_email_content_row_spacer(38) ?>
                        </div>
                        <?php snth_email_content_row_spacer(20) ?>

                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <!-- Column -->
                                <th class="column-top" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top; Margin:0">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left" width="20"></td>
                                            <td align="center">
                                                <?php snth_email_content_row_spacer(5) ?>

                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                            <div class="section-title" style="color:#2c2c2c; font-family:Arial,sans-serif; font-size:12px; line-height:16px; text-align:center; text-transform:uppercase">
                                                                <?php echo $preheader_text ?> &nbsp;
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <?php snth_email_content_row_spacer(5) ?>
                                            </td>
                                            <td class="content-spacing"
                                                style="font-size:0pt; line-height:0pt; text-align:left" width="20"></td>
                                        </tr>
                                    </table>
                                </th>
                                <!-- END Column -->
                            </tr>
                        </table>

                        <!-- Top Bar -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f1712a">
                            <tr>
                                <!-- Column -->
                                <th class="column-top"
                                    style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top; Margin:0"
                                    width="440">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="content-spacing"
                                                style="font-size:0pt; line-height:0pt; text-align:left" width="30"></td>
                                            <td>
                                                <?php snth_email_content_row_spacer(14) ?>

                                                <table class="center" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="text-top-white"
                                                            style="color:#ffffff; font-family:Arial,sans-serif; font-size:11px; line-height:26px; text-align:left; text-transform:uppercase">
                                                            <multiline>
                                                                <a href="https://kompas.tours/" target="_blank" class="link-white-u"
                                                                   style="color:#ffffff; text-decoration:underline"><span
                                                                            class="link-white-u"
                                                                            style="color:#ffffff; text-decoration:underline"><?php _e('Home page', 'snthwp'); ?></span></a>
                                                            </multiline>
                                                        </td>
                                                        <td class="img"
                                                            style="font-size:0pt; line-height:0pt; text-align:left"
                                                            width="26"></td>
                                                        <td class="text-top-white"
                                                            style="color:#ffffff; font-family:Arial,sans-serif; font-size:11px; line-height:16px; text-align:left; text-transform:uppercase">
                                                            <multiline>
                                                                <a href="https://kompas.tours/countries/" target="_blank" class="link-white-u"
                                                                   style="color:#ffffff; text-decoration:underline"><span
                                                                            class="link-white-u"
                                                                            style="color:#ffffff; text-decoration:underline"><?php _e('Popular countries', 'snthwp'); ?></span></a>
                                                            </multiline>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <?php snth_email_content_row_spacer(14) ?>

                                            </td>
                                            <td class="content-spacing"
                                                style="font-size:0pt; line-height:0pt; text-align:left" width="30"></td>
                                        </tr>
                                    </table>
                                </th>
                                <!-- END Column -->
                                <!-- Column -->
                                <th class="column-top" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top; Margin:0">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left" width="20"></td>
                                            <td align="right">
                                                <?php snth_email_content_row_spacer(14) ?>

                                                <!-- Socials -->
                                                <table class="center" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="img-center"
                                                            style="font-size:0pt; line-height:0pt; text-align:center"
                                                            width="30"><a href="https://www.facebook.com/k0mpas.tours/" target="_blank"><img
                                                                        src="<?php echo SNTH_IMAGES_URL; ?>/email-icons/fb.jpg" border="0"
                                                                        width="26" height="26" alt=""/></a>
                                                        </td>
                                                        <td class="img-center"
                                                            style="font-size:0pt; line-height:0pt; text-align:center"
                                                            width="30"><a href="https://www.instagram.com/kompas.tours/" target="_blank"><img
                                                                        src="<?php echo SNTH_IMAGES_URL; ?>/email-icons/insta.jpg" border="0"
                                                                        width="26" height="26" alt=""/></a>
                                                        </td>
                                                        <td class="img-center"
                                                            style="font-size:0pt; line-height:0pt; text-align:center"
                                                            width="30"><a href="https://t.me/Kompastours" target="_blank"><img
                                                                        src="<?php echo SNTH_IMAGES_URL; ?>/email-icons/telegram.jpg" border="0"
                                                                        width="26" height="26" alt=""/></a>
                                                        </td>
                                                        <td class="img-center"
                                                            style="font-size:0pt; line-height:0pt; text-align:center"
                                                            width="30"><a href="https://invite.viber.com/?g2=AQBIE%2Fnv0OsV%2FkiV1LuRl7BUAnQ2eiIQwVEU%2FMg%2BzXtsqfeH1G9xLF3DD8QRe%2B41" target="_blank"><img
                                                                        src="<?php echo SNTH_IMAGES_URL; ?>/email-icons/viber.jpg" border="0"
                                                                        width="26" height="26" alt=""/></a>
                                                        </td>
                                                        <td class="img-center"
                                                            style="font-size:0pt; line-height:0pt; text-align:center"
                                                            width="30"><a href="https://www.youtube.com/channel/UCH778PYnWOLiU9I641pOCnQ" target="_blank"><img
                                                                        src="<?php echo SNTH_IMAGES_URL; ?>/email-icons/yt.jpg" border="0"
                                                                        width="26" height="26" alt=""/></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- END Socials -->
                                                <?php snth_email_content_row_spacer(14) ?>

                                            </td>
                                            <td class="content-spacing"
                                                style="font-size:0pt; line-height:0pt; text-align:left" width="20"></td>
                                        </tr>
                                    </table>
                                </th>
                                <!-- END Column -->
                            </tr>
                        </table>
                        <?php snth_email_content_row_spacer(20) ?>

                        <!-- END Top Bar -->

                        <!-- Header -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                            <tr>
                                <td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left"
                                    width="20"></td>
                                <td>
                                    <?php snth_email_content_row_spacer(32) ?>

                                    <div class="fluid-img-logo" style="font-size:0pt; line-height:0pt; text-align:left">
                                        <div class="img-center"
                                             style="font-size:0pt; line-height:0pt; text-align:center"><a href="#"
                                                                                                          target="_blank"><img
                                                        src="<?php echo SNTH_IMAGES_URL; ?>/logo-new-color.png" border="0" width="210"
                                                        height="78" alt=""/></a></div>
                                    </div>
                                    <?php snth_email_content_row_spacer(32) ?>

                                </td>
                                <td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left"
                                    width="20"></td>
                            </tr>
                        </table>
                        <?php snth_email_content_row_spacer(10) ?>

                        <repeater>