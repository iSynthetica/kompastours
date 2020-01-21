<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 17.09.18
 * Time: 19:35
 */

class ittourApi {
    protected $url = "https://kompas.tours/wp-json/ittour/v1/";
    protected $token = "7aa2df955c46238ae4cdeb2d187f1158";
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

        $result = wp_remote_get( $url, array('headers' => array(
            'Authorization' => $this->token,
            'Accept-Language' => $this->lang,
        )));

        $body = wp_remote_retrieve_body( $result );

//        $curl = curl_init($url);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
//        curl_setopt($curl, CURLOPT_HEADER, false);
//        $result = curl_exec($curl);
//        curl_close($curl);

        return $this->prepare($body);
    }

    private function prepare($data) {
        if (empty($data)) {
            return new WP_Error( 'ittour_error', 'Bad response', 404 );
        }

        $result = json_decode($data, 1);

        if (null === $result) {
            return new WP_Error( 'ittour_error', 'Bad response', 404 );
        }

        if (!empty($result['error'])) {
            return new WP_Error( 'ittour_error', $result['error'], 404 );
        } elseif (!empty($result["code"]) && 'ittour_error' === $result["code"]) {
            return new WP_Error( 'ittour_error', $result["message"], 404 );
        }

        return $result;
    }
}