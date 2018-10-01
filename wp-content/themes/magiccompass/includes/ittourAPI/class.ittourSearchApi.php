<?php
/**
 * Class ittourParamsApi
 */
class ittourSearchApi extends ittourApi {
    protected $module = 'module/search';

    private $night_from;
    private $night_till;
    private $date_from;
    private $date_till;
    private $adult_amount;
    private $hotel_rating;
    private $from_city;

    public function __construct($lang = 'ru') {
        parent::__construct($lang);

        $this->setDefaults();
    }

    private function setDefaults() {
        $now = $endDate = time();

        $this->date_from = date('d.m.y', strtotime('+1 day', $now));
        $this->date_till = date('d.m.y', strtotime('+7 days', $now));
        $this->night_from = 7;
        $this->night_till = 10;
        $this->from_city = 2014;
        $this->adult_amount = 2;
        $this->hotel_rating = '78:4';
    }

    private function getDefaults() {
        return array(
            'date_from' => $this->date_from,
            'date_till' => $this->date_till,
            'night_from' => $this->night_from,
            'night_till' => $this->night_till,
            'from_city' => $this->from_city,
            'adult_amount' => $this->adult_amount,
            'hotel_rating' => $this->hotel_rating,
        );
    }

    public function get($country_id, $args = array()) {
        $default = $this->getDefaults();

        $args = wp_parse_args( $args, $default );
        $args = wp_parse_args('country=' . $country_id, $args );

        $params = '?' . http_build_query($args);

        return $this->request($params);
    }
}