<?php
/**
 * Content template file
 *
 * @package Hooka
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
//            $params_obj = ittour_params('ru');
//            $countries_en = $params_obj->getCountry(318);
//            var_dump($countries_en);

            $params_obj = ittour_search('ru');
            $countries_en = $params_obj->get(318);
            var_dump($countries_en);
            ?>
        </main>
    </div>
</div>