<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AccountsServices {

    function __construct() {
        $this->CI =& get_instance();
        log_message('Debug', 'Member services is loaded.');
    }

    public function GenerateTradingLoginId($groups){

        $newLoginId  = $this->newLoginId($groups);
        $isInvalidId = true;

        while($isInvalidId){
            $endpoint   = $this->CI->endpoints->sogeeapi_real(Accounts::GET_SINGLE_RECORD, $newLoginId);
            $rest       = $this->CI->restclient->requestGet($endpoint);

            if ($rest["code"] == 200){
                $newLoginId =  $this->newLoginId($groups);
            } else {
                $isInvalidId = false;
            }
        }

       return $newLoginId;

    }

    private function newLoginId($groups){
        return intval($groups).mt_rand(1000,9999);
    }

}