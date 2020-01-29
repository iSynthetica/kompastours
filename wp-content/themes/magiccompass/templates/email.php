<?php
/**
 * Template Name: Email
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$subject = "Test Email Template";

$headers = array();
$headers[] = 'From: Vlad <i.synthetica@gmail.com>';
$headers[] = 'content-type: text/html';

$tour_data = '';

ob_start();

snth_show_template('email/email-header.php');
snth_show_template('email/email-title.php', array('email_heading' => 'New tour request'));
snth_show_template('email/email-tour-info.php');
snth_show_template('email/email-client-info.php');
snth_show_template('email/email-footer.php');

$email_content = ob_get_clean();

echo $email_content;

// $result = mail('info@kompas.tours', $subject, $email_content);

// $result = wp_mail( 'info@kompas.tours', $subject, $email_content, $headers );
// $result = wp_mail( 'zakaz@kompas.tours', $subject, $email_content, $headers );
//$result = wp_mail( 'i.synthetica@gmail.com', $subject, $email_content, $headers );
//$result = wp_mail( 'syntheticafreon@gmail.com', $subject, $email_content, $headers );
//$result = wp_mail( 'test-z1wvbpfpg@mail-tester.com', $subject, $email_content, $headers );

// var_dump($result);