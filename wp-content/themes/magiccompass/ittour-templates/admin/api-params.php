<?php
/**
 * Display API Params Page
 *
 * @package Magiccompass/IttourTemplates/Admin
 * @version 0.0.7
 * @since 0.0.7
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$params_obj = ittour_params('ru');
$params = $params_obj->get();

if (isset($_POST['ittour_token_key'])) {
    $value = $_POST['ittour_token_key'];
    update_option('ittour_token_key', $value);
}

$value = get_option('ittour_token_key', '');
?>

<h2><?php _e('Master Token key', 'snthwp'); ?></h2>

<form method="POST">
    <table class="form-table">
        <tr>
            <th scope="row"><label for="ittour_token_key"><?php _e('Token key', 'snthwp'); ?></label></th>

            <td>
                <input type="text" name="ittour_token_key" class="regular-text" id="ittour_token_key" value="<?php echo $value; ?>">
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Save" class="button button-primary button-large"></td>
        </tr>
    </table>
</form>

<h2><?php _e('REST API settings', 'snthwp'); ?></h2>

<div id="ittour_create_new_api_user">
    <table class="form-table">
        <tr>
            <th scope="row"><label for="ittour_token_key"><?php _e('New API user', 'snthwp'); ?></label></th>

            <td>
                <button id="ittour_create_new_api_user_btn" type="button" class="button button-primary button-large">
                    <?php _e('Create new API key', 'snthwp'); ?>
                </button>
            </td>
        </tr>
    </table>
</div>
