<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/Form
 * @version 0.0.8
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if (empty($child_age)) {
    $child_age = 1;
}
?>

<div class="child_amount_item" style="margin-right:10px;float:left">
    <select name="child_amount[]" class="form-control" >
        <?php
        for ($i = 1; $i <= 17; $i++) {
            $selected = '';

            if ($i === $child_age) {
                $selected = ' selected';
            }

            ?><option value="<?php echo $i; ?>"<?php echo $selected; ?>><?php echo $i; ?><?php _e('y', 'snthwp') ?></option><?php
        }
        ?>
    </select>

    <button class="btn-delete" type="button">
        <i class="fas fa-times"></i>
    </button>
</div>
