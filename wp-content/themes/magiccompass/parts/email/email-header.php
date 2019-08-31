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
<body class="body"
      style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#f1f1f1; -webkit-text-size-adjust:none">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f1f1f1">
    <tr>
        <td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left" width="1"></td>
        <td align="center" valign="top">
            <table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
                <tr>
                    <td class="td"
                        style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; Margin:0">
                        <div class="hide-for-mobile">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer"
                                   style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                <tr>
                                    <td height="38" class="spacer"
                                        style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                        &nbsp;
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer"
                               style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                            <tr>
                                <td height="20" class="spacer"
                                    style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                    &nbsp;
                                </td>
                            </tr>
                        </table>

                        <!-- Top Bar -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ff5e56">
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
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                       class="spacer"
                                                       style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                    <tr>
                                                        <td height="14" class="spacer"
                                                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                </table>

                                                <table class="center" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="text-top-white"
                                                            style="color:#ffffff; font-family:Arial,sans-serif; font-size:11px; line-height:16px; text-align:left; text-transform:uppercase">
                                                            <multiline>
                                                                <a href="#" target="_blank" class="link-white-u"
                                                                   style="color:#ffffff; text-decoration:underline"><span
                                                                            class="link-white-u"
                                                                            style="color:#ffffff; text-decoration:underline">View Online</span></a>
                                                            </multiline>
                                                        </td>
                                                        <td class="img"
                                                            style="font-size:0pt; line-height:0pt; text-align:left"
                                                            width="26"></td>
                                                        <td class="text-top-white"
                                                            style="color:#ffffff; font-family:Arial,sans-serif; font-size:11px; line-height:16px; text-align:left; text-transform:uppercase">
                                                            <multiline>
                                                                <a href="#" target="_blank" class="link-white-u"
                                                                   style="color:#ffffff; text-decoration:underline"><span
                                                                            class="link-white-u"
                                                                            style="color:#ffffff; text-decoration:underline">FORWARD</span></a>
                                                            </multiline>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                       class="spacer"
                                                       style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                    <tr>
                                                        <td height="14" class="spacer"
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
                                </th>
                                <!-- END Column -->
                                <!-- Column -->
                                <th class="column-top"
                                    style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal; vertical-align:top; Margin:0">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td class="content-spacing"
                                                style="font-size:0pt; line-height:0pt; text-align:left" width="20"></td>
                                            <td align="right">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                       class="spacer"
                                                       style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                    <tr>
                                                        <td height="14" class="spacer"
                                                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                </table>

                                                <!-- Socials -->
                                                <table class="center" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="img-center"
                                                            style="font-size:0pt; line-height:0pt; text-align:center"
                                                            width="40"><a href="https://www.facebook.com/k0mpas.tours" target="_blank"><img
                                                                        src="<?php echo SNTH_IMAGES_URL; ?>/email/ico_facebook.jpg" border="0"
                                                                        width="14" height="13" alt=""/></a></td>
                                                        <td class="img-center"
                                                            style="font-size:0pt; line-height:0pt; text-align:center"
                                                            width="40"><a href="#" target="_blank"><img
                                                                        src="<?php echo SNTH_IMAGES_URL; ?>/email/ico_twitter.jpg" border="0"
                                                                        width="14" height="13" alt=""/></a></td>
                                                        <td class="img-center"
                                                            style="font-size:0pt; line-height:0pt; text-align:center"
                                                            width="40"><a href="#" target="_blank"><img
                                                                        src="<?php echo SNTH_IMAGES_URL; ?>/email/ico_gplus.jpg" border="0" width="14"
                                                                        height="13" alt=""/></a></td>
                                                        <td class="img-center"
                                                            style="font-size:0pt; line-height:0pt; text-align:center"
                                                            width="40"><a href="#" target="_blank"><img
                                                                        src="<?php echo SNTH_IMAGES_URL; ?>/email/ico_pinterest.jpg" border="0"
                                                                        width="14" height="13" alt=""/></a></td>
                                                        <td class="img-center"
                                                            style="font-size:0pt; line-height:0pt; text-align:center"
                                                            width="40"><a href="#" target="_blank"><img
                                                                        src="<?php echo SNTH_IMAGES_URL; ?>/email/ico_instagram.jpg" border="0"
                                                                        width="14" height="13" alt=""/></a></td>
                                                    </tr>
                                                </table>
                                                <!-- END Socials -->
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                                       class="spacer"
                                                       style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                    <tr>
                                                        <td height="14" class="spacer"
                                                            style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                </table>

                                            </td>
                                            <td class="content-spacing"
                                                style="font-size:0pt; line-height:0pt; text-align:left" width="20"></td>
                                        </tr>
                                    </table>
                                </th>
                                <!-- END Column -->
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

                        <!-- END Top Bar -->

                        <!-- Header -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                            <tr>
                                <td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left"
                                    width="20"></td>
                                <td>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer"
                                           style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                        <tr>
                                            <td height="32" class="spacer"
                                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                &nbsp;
                                            </td>
                                        </tr>
                                    </table>

                                    <div class="fluid-img-logo" style="font-size:0pt; line-height:0pt; text-align:left">
                                        <div class="img-center"
                                             style="font-size:0pt; line-height:0pt; text-align:center"><a href="#"
                                                                                                          target="_blank"><img
                                                        src="<?php echo SNTH_IMAGES_URL; ?>/logo-new-color.png" border="0" width="210"
                                                        height="78" alt=""/></a></div>
                                    </div>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="spacer"
                                           style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                        <tr>
                                            <td height="32" class="spacer"
                                                style="font-size:0pt; line-height:0pt; text-align:center; width:100%; min-width:100%">
                                                &nbsp;
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td class="content-spacing" style="font-size:0pt; line-height:0pt; text-align:left"
                                    width="20"></td>
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

                        <repeater>