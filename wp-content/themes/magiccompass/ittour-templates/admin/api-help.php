<?php
$params_obj = ittour_params(ITTOUR_LANG);
$default_country = 338;
$default_from_city = 2014;
$ittour_from_cities = get_option('ittour_from_cities', array());
$params = get_transient('ittour_search_params');

if (!$params) {
    $params = $params_obj->get();

    set_transient('ittour_search_params', $params, 60 * 60 * 12);
}

$country_params = get_transient('ittour_country_search_params_' . $default_country);

if (!$country_params) {
    $country_params = $params_obj->getCountry($default_country);

    set_transient('ittour_country_search_params_' . $default_country, $country_params, 60 * 60 * 12);
}

$regions_by_countries = array();

foreach ( $params['regions'] as $region ) {
    if (false === strpos($region['id'], '-')) {
        $regions_by_countries[$region['country_id']][] = array(
            'id' => $region['id'],
            'name' => $region['name']
        );
    }
}

$regions_by_countries_json = json_encode($regions_by_countries, JSON_HEX_APOS);

if (!$params) {
    $params_obj = ittour_params('ru');
    $params = $params_obj->get();

    set_transient('ittour_search_params', $params, 60 * 60 * 6);
}
?>
<h3>
    Шорткод для вывода списка туров по фильтрам
</h3>

<p id="tours_grid_shortcode_holder" class="code-example">
    <span class="code-example-value">[ittour_tours_grid country="<?php echo $default_country; ?>" from_city="<?php echo $default_from_city; ?>"]</span>

    <span class="code-example-copy"><?php echo __('Copy', 'woo-product-reviews-shrtcd'); ?></span>
    <span class="code-example-copied"><?php echo __('Copied. Input into your content!', 'woo-product-reviews-shrtcd'); ?></span>
</p>

<p id="shortcode_explanation">
    Страна <strong id="param_country_label">Египет</strong>,
    город вылета <strong id="param_from_city_label">Киев</strong>
    <span id="param_region_description" style="display: none;">, регион <strong id="param_region_label"></strong></span>
    <span id="param_hotel_description" style="display: none;">, список отелей <strong id="param_hotel_label"></strong></span>
    <span id="param_hotel_rating_description" style="display: none;">, звезд в отелях <strong id="param_hotel_rating_label"></strong></span>
    <span id="param_night_from_description" style="display: none;">, количество ночей в туре от <strong id="param_night_from_label"></strong></span>
    <span id="param_night_till_description" style="display: none;">, количество ночей в туре до <strong id="param_night_till_label"></strong></span>
    <span id="param_date_from_description" style="display: none;">, дата начала тура от <strong id="param_date_from_label"></strong></span>
    <span id="param_date_till_description" style="display: none;">, дата начала тура до <strong id="param_date_till_label"></strong></span>
    <span id="param_adult_amount_description" style="display: none;">, количество взрослых <strong id="param_adult_amount_label"></strong></span>
    <span id="param_child_amount_description" style="display: none;">, количество детей <strong id="param_child_amount_label"></strong></span>
    <span id="param_child_age_description" style="display: none;">, возраст детей <strong id="param_child_age_label"></strong></span>
    <span id="param_meal_type_description" style="display: none;">, типы питания <strong id="param_meal_type_label"></strong></span>
</p>

<h4>
    Обязательные параметры
</h4>

<div class="two-col-holder">
    <div>
        <p>
            <code>country="XXX"</code> - страна тура, где "XXX" id страны (число).
        </p>

        <div class="add-parameter">
            <select id="add_parameter_country" data-parameter="country">
                <?php
                foreach ($params["countries"] as $country) {
                    ?>
                    <option value="<?php echo $country['id'] ?>"<?php echo (int)$default_country === (int)$country['id'] ? ' selected' : ''; ?>><?php echo $country['name'] ?></option>
                    <?php
                }
                ?>
            </select>
            <input id="regions_by_countries_hidden" type="hidden" value='<?php echo $regions_by_countries_json; ?>'>
        </div>
    </div>

    <div>
        <p>
            <code>from_city="XXXX"</code> - город вылета в Украине, где "XXXX" id города (число).
        </p>

        <div class="add-parameter">
            <select id="add_parameter_from_city" data-parameter="from_city">
                <?php
                foreach ($ittour_from_cities as $id => $city_data) {
                    ?>
                    <option value="<?php echo $id ?>"<?php echo (int)$default_from_city === (int)$id ? ' selected' : ''; ?>><?php echo $city_data['name'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
</div>

<hr>

<h4>
    Дополнительные параметры (эти параметры не обязательные)
</h4>

<div class="two-col-holder">
    <div>
        <p>
            <code>region="XXXX"</code> - регион в стране тура, где "XXXX" id региона (число).
        </p>

        <div class="add-parameter">
            <select id="add_parameter_region" data-parameter="region">
                <option value="">выберите регион</option>
                <?php
                foreach ($regions_by_countries[$default_country] as $region_data) {
                    ?>
                    <option value="<?php echo $region_data['id'] ?>"><?php echo $region_data['name'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div>
    </div>
</div>

<hr>

<div class="two-col-holder">
    <div>
        <p>
            <code>hotel="XXXX:XXXX:XXXX"</code> - отели в стране тура, где "XXXX" id отелей разделенных ":", можно указать от 1 до 10 отелей в одном шорткоде.
        </p>

        <?php $parameter_item = 'hotel'; ?>

        <div class="add-parameter">
            <input id="add_parameter_<?php echo $parameter_item ?>" class="add_multi_parameter_text" data-parameter="<?php echo $parameter_item ?>" type="text" style="width: 100%;">

            <div id="<?php echo $parameter_item ?>-container" class="add-multi-parameter-container">
                <ul>
                    <?php
                    foreach ($country_params["hotels"] as $hotel) {
                        ?>
                        <li>
                            <label for="<?php echo $parameter_item . '_' . $hotel['id'] ?>">
                                <input
                                        id="<?php echo $parameter_item . '_' . $hotel['id'] ?>"
                                        type="checkbox"
                                        value="<?php echo $hotel['id'] ?>"
                                        data-name='<?php echo $hotel['name'] ?> <?php echo ittour_get_hotel_number_rating_by_id($hotel['hotel_rating_id']) ?>'
                                        data-region="<?php echo $hotel['region_id'] ?>"
                                >
                                <?php echo $hotel['name'] ?> <?php echo ittour_get_hotel_number_rating_by_id($hotel['hotel_rating_id']) ?> (id <?php echo $hotel['id'] ?>)
                            </label>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div>
        <p>
            <code>hotel_rating="XX:XX"</code> - количество звезд отелей в результате поиска, где "XX" id звезд отелей разделенных ":", можно указать от 1 до 2 id в одном шорткоде.
        </p>

        <?php $parameter_item = 'hotel_rating'; ?>

        <div class="add-parameter">
            <input id="add_parameter_<?php echo $parameter_item ?>" class="add_multi_parameter_text" data-parameter="<?php echo $parameter_item ?>" type="text" style="width: 100%;">

            <div id="<?php echo $parameter_item ?>-container" class="add-multi-parameter-container">
                <ul>
                    <?php
                    foreach ($params["hotel_ratings"] as $hotel_rating) {
                        ?>
                        <li>
                            <label for="<?php echo $parameter_item . '_' . $hotel_rating['id'] ?>">
                                <input
                                        id="<?php echo $parameter_item . '_' . $hotel_rating['id'] ?>"
                                        type="checkbox"
                                        value="<?php echo $hotel_rating['id'] ?>"
                                        data-name="<?php echo $hotel_rating['name'] ?>*"
                                >
                                <?php echo $hotel_rating['name'] ?>* (id <?php echo $hotel_rating['id'] ?>)
                            </label>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="two-col-holder">
    <div>
        <p>
            <code>night_from="X"</code> - количество ночей в туре от (число от 1 до 30).
        </p>

        <div class="add-parameter">
            <input id="add_parameter_night_from" class="add_parameter_text" data-parameter="night_from" type="number" min="1" max="30">
        </div>
    </div>

    <div>
        <p>
            <code>night_till="X"</code> - количество ночей в туре до (число от 1 до 30).
        </p>

        <div class="add-parameter">
            <input id="add_parameter_night_till" class="add_parameter_text" data-parameter="night_till" type="number" min="1" max="30">
        </div>
    </div>
</div>

<hr>

<div class="two-col-holder">
    <div>
        <p>
            <code>date_from="ДД.ММ.ГГ"</code> - дата начала тура от (например: 20.12.19).
        </p>

        <div class="add-parameter">
            <input id="add_parameter_date_from" class="add_parameter_text" data-parameter="date_from" type="text">
        </div>

    </div>

    <div>
        <p>
            <code>date_till="ДД.ММ.ГГ"</code> - дата начала тура до (например: 30.12.19) не больше 12-ти дней от date_from.
        </p>

        <div class="add-parameter">
            <input id="add_parameter_date_till" class="add_parameter_text" data-parameter="date_till" type="text">
        </div>
    </div>
</div>

<hr>

<div class="two-col-holder">
    <div>
        <p>
            <code>adult_amount="X"</code> - количество взрослых (число) от 1 до 4.
        </p>

        <div class="add-parameter">
            <input id="add_parameter_adult_amount" class="add_parameter_text" data-parameter="adult_amount" type="number" min="1" max="4">
        </div>
    </div>

    <div>
        <p>
            <code>child_amount="X"</code> - количество детей (число) от 1 до 3.
        </p>

        <div class="add-parameter">
            <input id="add_parameter_child_amount" class="add_parameter_text" data-parameter="child_amount" type="number" min="0" max="3">
        </div>

        <p>
            <code>child_age="XX:XX"</code> - возраст каждого ребенка разделенный ":" (этот параметр обязательный если указан <strong>child_amount</strong>).
        </p>

        <div class="add-parameter">
            <input id="add_parameter_child_age" class="add_parameter_text" data-parameter="child_age" type="text">
        </div>
    </div>
</div>

<hr>

<div class="two-col-holder">
    <div>
        <p>
            <code>meal_type="XX:XX:XX"</code> - ID типов питания разделенные ":".
        </p>

        <?php $parameter_item = 'meal_type'; ?>

        <div class="add-parameter">
            <input id="add_parameter_<?php echo $parameter_item ?>" class="add_multi_parameter_text" data-parameter="<?php echo $parameter_item ?>" type="text" style="width: 100%;">

            <div id="<?php echo $parameter_item ?>-container" class="add-multi-parameter-container">
                <ul>
                    <?php
                    foreach ($country_params["meal_types"] as $meal_type) {
                        ?>
                        <li>
                            <label for="<?php echo $parameter_item . '_' . $meal_type['id'] ?>">
                                <input
                                        id="<?php echo $parameter_item . '_' . $meal_type['id'] ?>"
                                        type="checkbox"
                                        value="<?php echo $meal_type['id'] ?>"
                                       data-name="<?php echo $meal_type['name'] ?>">
                                <?php echo $meal_type['name'] ?> (id <?php echo $meal_type['id'] ?>)
                            </label>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <div>

    </div>
</div>