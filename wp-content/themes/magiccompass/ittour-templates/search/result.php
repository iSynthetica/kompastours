<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 17:33
 */
?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container margin_60">
                <div class="row">
                    <aside class="col-lg-3">

                    </aside>

                    <div class="col-lg-9">
                        <?php
                        $i = 1;
                        foreach ($result['hotels'] as $hotel) {
                            $delay = $i / 10;
                            $first_offer = $hotel['offers'][0];

                            unset ($hotel['offers'][0]);

                            ittour_show_template('loop-hotel/tour-list-default.php', array(
                                    'hotel' => $hotel,
                                    'first_offer' => $first_offer,
                                    'delay' => $delay
                                )
                            );
                            $i++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<div id="search-result" class="search-result">
    <div class="content-wrap">
        <div class="container clearfix">
            <?php // ittour_show_template('search/hotels.php', array('hotels' => $result['hotels'])); ?>

            <div class="row common-height clearfix">
                <?php ittour_show_template('search/pagination.php', array('result' => $result)); ?>
            </div>

            <?php
//            unset ($result['hotels']);
//            var_dump($result);
            ?>
        </div>
    </div>
</div>
