<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 17:33
 */


?>

<div id="search-result" class="search-result">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row common-height clearfix">
                <div class="col-xs-12 col-padding">
                    <h1 class="page-title"><?php echo __('Search results', 'snthwp'); ?></h1>
                </div>
            </div>

            <?php ittour_show_template('search/hotels.php', array('hotels' => $result['hotels'])); ?>

            <div class="row common-height clearfix">
                <?php ittour_show_template('search/pagination.php', array('result' => $result)); ?>
            </div>

            <?php
            unset ($result['hotels']);
            var_dump($result);
            ?>
        </div>
    </div>
</div>
