<?php
/**
 * Class ittourParamsApi
 */
class ittourHotelApi extends ittourApi {
    protected $module = 'hotel/';
    protected $hotel_id = null;

    public function __construct($hotel_id, $lang = 'ru') {
        parent::__construct($lang);

        $this->hotel_id = $hotel_id;
    }

    public function reviews() {

        $params = $this->hotel_id . '/reviews';

        return $this->request($params);
    }

    public function min_prices() {

        $params = $this->hotel_id . '/min-prices';

        return $this->request($params);
    }
}