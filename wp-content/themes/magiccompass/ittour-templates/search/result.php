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
            <div id="position">
                <div class="container">
                    <ul>
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="#">Category</a>
                        </li>
                        <li>Page active</li>
                    </ul>
                </div>
            </div>


            <div class="container margin_60">
                <div class="row">
                    <aside class="col-lg-3">

                    </aside>

                    <div class="col-lg-9">
                        <div id="tools">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-6">
                                    <div class="styled-select-filters">
                                        <select name="sort_price" id="sort_price">
                                            <option value="" selected>Sort by price</option>
                                            <option value="lower">Lowest price</option>
                                            <option value="higher">Highest price</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-4 col-6">
                                    <div class="styled-select-filters">
                                        <select name="sort_rating" id="sort_rating">
                                            <option value="" selected>Sort by ranking</option>
                                            <option value="lower">Lowest ranking</option>
                                            <option value="higher">Highest ranking</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-4 d-none d-sm-block text-right">
                                    <a href="#" class="bt_filters"><i class="icon-th"></i></a> <a href="all_hotels_list.html" class="bt_filters"><i class=" icon-list"></i></a>
                                </div>
                            </div>
                        </div>

                        <?php
                        foreach ($result['hotels'] as $hotel) {
                            $first_offer = $hotel['offers'][0];

                            unset ($hotel['offers'][0]);
                            ?>
                            <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4">
                                        <div class="ribbon_3 popular"><span>Popular</span>
                                        </div>
                                        <div class="wishlist">
                                            <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                                        </div>
                                        <div class="img_list">
                                            <a href="single_hotel.html"><img src="<?php echo $hotel['images'][0]['full'] ?>" alt="Image">
                                                <div class="short_info"></div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="tour_list_desc">
                                            <div class="score">Superb<span><?php echo $hotel['hotel_review_rate']; ?></span>
                                            </div>
                                            <div class="rating">
                                                <?php echo ittour_get_hotel_rating_by_id($hotel['hotel_rating']); ?>
                                            </div>
                                            <h3><strong><?php echo $hotel['hotel']; ?></strong></h3>
                                            <p><?php echo $hotel['country'] . ', ' .$hotel['region']; ?></p>
                                            <p>
                                            </p>
                                            <ul class="add_info">
                                                <li>
                                                    <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Free Wifi"><i class="icon_set_1_icon-86"></i></a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Plasma TV with cable channels"><i class="icon_set_2_icon-116"></i></a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Swimming pool"><i class="icon_set_2_icon-110"></i></a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Fitness Center"><i class="icon_set_2_icon-117"></i></a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Restaurant"><i class="icon_set_1_icon-58"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="price_list">
                                            <div><sup><?php echo ittour_get_currency_by_id(1); ?></sup><?php echo $first_offer['prices'][1] ?><span class="normal_price_list">$99</span><small>*From/Per night</small>
                                                <p><a href="single_hotel.html" class="btn_1">Details</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <?php
                                    foreach ($hotel['offers'] as $offer) {
                                        ?>
                                        <div class="col-12">
                                            <?php var_dump($offer) ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <?php
                                        unset($hotel['hotel']);
                                        unset($hotel['country']);
                                        unset($hotel['region']);
                                        unset($hotel['region_id']);
                                        unset($hotel['hotel_id']);
                                        unset($hotel['hotel_rating']);
                                        unset($hotel['hotel_review_rate']);
                                        unset($hotel['hotel_facilities']);
                                        unset($hotel['hotel_review_count']);
                                        unset($hotel['images']);
                                        unset($hotel['offers']);

                                        var_dump($hotel)
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
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
