<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 17:47
 */

?>
<div class="row">
    <?php
    foreach ($hotels as $hotel) {
        ittour_show_template('loop-hotel/template-default.php', array('hotel' => $hotel));
    }
    ?>
</div>