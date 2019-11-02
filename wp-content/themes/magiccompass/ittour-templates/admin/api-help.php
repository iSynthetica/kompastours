<?php
$ittour_from_cities = get_option('ittour_from_cities', array());
$params = get_transient('ittour_search_params');
$default_country = 338;
$default_from_city = 2014;

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
    город вылета <strong id="param_from_city_label">Киев</strong><span id="param_region_description" style="display: none;">,
    регион <strong id="param_region_label"></strong>
    </span>
</p>

<h4>
    Обязательные параметры
</h4>

<p>
    <code>country="XXX"</code> - страна тура, где "XXX" id страны (число).
    id можно получить на странице <a href="admin.php?page=ittour-countries" target="_blank">Страны</a> в колонке <strong>itTour ID</strong>.
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

<hr>

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

<h4>
    Дополнительные параметры (эти параметры не обязательные)
</h4>

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

<p>
    <code>hotel="XXXX:XXXX:XXXX"</code> - отели в стране тура, где "XXXX" id отелей разделенных ":", можно указать от 1 до 10 отелей в одном шорткоде.
</p>

<p>
    <code>hotel_rating="XX:XX"</code> - количество звезд отелей в результате поиска, где "XX" id звезд отелей разделенных ":", можно указать от 1 до 2 id в одном шорткоде.
</p>

<p>
    <code>night_from="X"</code> - количество ночей в туре от (число от 1 до 30).
</p>

<p>
    <code>night_till="X"</code> - количество ночей в туре до (число от 1 до 30).
</p>

<p>
    <code>date_from="ДД.ММ.ГГ"</code> - дата начала тура от (например: 20.12.19).
</p>

<p>
    <code>date_till="ДД.ММ.ГГ"</code> - дата начала тура до (например: 30.12.19) не больше 12-ти дней от date_from.
</p>

<p>
    <code>adult_amount="X"</code> - количество взрослых (число) от 1 до 4.
</p>

<p>
    <code>child_amount="X"</code> - количество детей (число) от 1 до 3.
</p>

<p>
    <code>child_age="XX:XX"</code> - возраст каждого ребенка разделенный ":" (этот параметр обязательный если указан <strong>child_amount</strong>).
</p>

<p>
    <code>meal_type="XX:XX:XX"</code> - ID типов питания разделенные ":".
</p>