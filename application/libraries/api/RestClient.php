<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RestClient {

    function __construct() {
        $this->CI =& get_instance();
        log_message('Debug', 'Generate Token services is loaded.');
    }

    public function requestGet($endpoints){
        $curl = curl_init($endpoints);
        curl_setopt($curl, CURLOPT_URL, $endpoints);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        /* Define content type */
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjAsIm5hbWUiOiJmYWRoaWxmYXV6YW4uYmlzbmlzQGdtYWlsLmNvbSIsInVzZXJJZCI6MTEyfQ.B0Fb6U5oLmrOrmrInTnuTsvqHHrY6pGJ9vibP8u6wYo'));

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        $httpResponseHeader = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $resp = array("response" => $response,
                        "code" => $httpResponseHeader);

        return $resp;
    }

    public function requestPost($endpoints, $body){

        $postdata = json_encode($body);

        $curl = curl_init($endpoints);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjAsIm5hbWUiOiJmYWRoaWxmYXV6YW4uYmlzbmlzQGdtYWlsLmNvbSIsInVzZXJJZCI6MTEyfQ.B0Fb6U5oLmrOrmrInTnuTsvqHHrY6pGJ9vibP8u6wYo'));
        $response = curl_exec($curl);
        $httpResponseHeader = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $resp = array("response"    => $response,
                        "code"      => $httpResponseHeader);

        return $resp;
    }

    public function requestPut(){
        //
    }

    public function requestDelete(){
        //
    }
}