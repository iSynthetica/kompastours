<?php

class ittourExcursionSearchApi extends ittourApi {
    protected $module = 'module-excursion/search';

    private $date_from;
    private $date_till;

    public function __construct($lang = 'ru') {
        parent::__construct($lang);

        $this->setDefaults();
    }

    private function setDefaults() {
        $now = $endDate = time();

        $this->date_from = date('d.m.y', strtotime('+1 day', $now));
        $this->date_till = date('d.m.y', strtotime('+11 days', $now));
    }

    public function getDefaults() {
        return array(
            'date_from' => $this->date_from,
            'date_till' => $this->date_till,
            'show_selected_countries' => false,
            'show_selected_cities' => false,
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