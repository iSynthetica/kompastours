<?php
/**
 * Class ittourParamsApi
 */
class ittourExcursionTourApi extends ittourApi {
    protected $module = 'tour-excursion/';
    protected $key = null;
    private $date_from;
    private $date_till;

    public function __construct($key, $lang = 'ru') {
        parent::__construct($lang);

        $this->key = $key;
        $this->setDefaults();
    }

    private function setDefaults() {
        $now = $endDate = time();

        $this->date_from = date('d.m.y', strtotime('+1 day', $now));
        $this->date_till = date('d.m.y', strtotime('+11 days', $now));
    }

    private function getDefaults() {
        return array(
            'date_from' => $this->date_from,
            'date_till' => $this->date_till,
        );
    }

    public function info($args = array()) {
        $default = $this->getDefaults();

        $args = wp_parse_args( $args, $default );

        $params = 'info/' . $this->key;
        $params .= '?' . http_build_query($args);

        return $this->request($params);
    }

    public function validate() {

        $params = 'validate/' . $this->key;

        return $this->request($params);
    }

    public function flights() {

        $params = 'flights/' . $this->key;

        return $this->request($params);
    }
}