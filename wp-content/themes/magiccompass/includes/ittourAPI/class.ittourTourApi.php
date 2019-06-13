<?php
/**
 * Class ittourParamsApi
 */
class ittourTourApi extends ittourApi {
    protected $module = 'tour/';
    protected $key = null;

    public function __construct($key, $lang = 'ru') {
        parent::__construct($lang);

        $this->key = $key;
    }

    public function info() {

        $params = 'info/' . $this->key;

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