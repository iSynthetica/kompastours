<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 16:36
 */

$description_order = array(
    'description' => '',
    'child' => '',
    'sport' => '',
    'descapt' => '',
    'featureshotel' => '',
    'disposition' => '',
    'beach' => '',
);
?>

<div>
    <?php
    foreach ($description_order as $feature => $title) {
        if (!empty($hotel_info[$feature])) {
            ?>
            <p>
                <?php echo '' !== $title ? '<strong>'.$title.'</strong>:' : ''; ?> <?php echo $hotel_info[$feature] ?>
            </p>
            <?php
        }
    }
    ?>
</div>