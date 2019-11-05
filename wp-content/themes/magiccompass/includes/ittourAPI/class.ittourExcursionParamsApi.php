<?php
class ittourExcursionParamsApi extends ittourApi {
    protected $module = 'module-excursion/params';

    public function __construct($lang = 'ru') {
        parent::__construct($lang);
    }

    public function get() {
        return $this->request();
    }
}