<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 17.09.18
 * Time: 19:35
 */

class ittourApi {
    protected $url = "https://api.ittour.com.ua/";
    protected $token = "5fa3c045525ca5e214af37e1f6786766";
    protected $lang;
    protected $headers;
    protected $module;

    public function __construct($lang = 'ru') {
        $this->lang = $lang;

        $this->setHeaders();
    }

    protected function setHeaders() {
        $this->headers = array();
        $this->headers[] = 'Authorization: ' . $this->token;
        $this->headers[] = 'Accept-Language: ' . $this->lang;
    }

    protected function request($params = '') {
        $url = $this->url . $this->module . $params;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $result = curl_exec($curl);
        curl_close($curl);

        return $this->prepare($result);
    }

    private function prepare($data) {
        $result = json_decode($data, 1);

        if (!empty($result['error'])) {
            return new WP_Error( 'ittour_error', $result['error'], 404 );
        }

        return $result;
    }
}