<?php
/**
 * Class ittourParamsApi
 */
class ittourParamsApi extends ittourApi {
    protected $module = 'module/params';

    public function __construct($lang = 'ru') {
        parent::__construct($lang);
    }

    public function get() {
        return $this->request();
    }

    public function getDestinations($args) {
        if (!is_array($args) || !isset($args['query']) || !isset($args['type'])) {
            return 'error';
        }

        $request = '/destinations?' . http_build_query($args);

        return $this->request($request);
    }

    public function getCountry($id, $params = array()) {
        $default = array(
            'entity' => 'hotel:meal_type:from_city',
        );

        $args = wp_parse_args( $params, $default );
        $params = '/' . $id . '?' . http_build_query($args);

        return $this->request($params);
    }
}