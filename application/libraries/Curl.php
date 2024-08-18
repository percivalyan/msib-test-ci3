<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curl {
    private $ch;

    public function __construct() {
        $this->ch = curl_init();
    }

    public function simple_get($url) {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($this->ch);
        if(curl_errno($this->ch)) {
            return curl_error($this->ch);
        }
        return $response;
    }

    public function __destruct() {
        curl_close($this->ch);
    }
}
