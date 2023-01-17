<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Endpoints{

    public $result = NULL;
    public $demo_prefix = 'https://beapigateway.forexindo.co.id:8000/61/136/';
    public $real_prefix = 'https://beapigateway.forexindo.co.id:8000/2/1/';

    function __construct() {
        $this->CI =& get_instance();
        log_message('Debug', 'Generate Token services is loaded.');
    }

    public function sogeeapi_demo($resources, $params = NULL){
        switch ($resources){
            case Accounts::GET_SINGLE_RECORD:
                $this->result = $this->demo_prefix."353/accounts/$params?ApiAccount=229";
                break;
            case Accounts::POST_ACCOUNT:
                $this->result = $this->demo_prefix."354/accounts?ApiAccount=229";
                break;
            case Accounts::POST_DEPOSIT:
                $this->result = $this->demo_prefix."362/accounts/$params/balance?ApiAccount=229";
                break;
        }

        return $this->result;
    }

    public function sogeeapi_real($resources, $params = NULL){
        switch ($resources){
            case Accounts::GET_RECORDS:
                $this->result = $this->real_prefix."2/accounts?ApiAccount=227";
                break;
            case Accounts::GET_RECORDS_BY_GROUP:
                $this->result = $this->real_prefix."2/accounts?ApiAccount=227&Groups=$params";
                break;
            case Accounts::GET_SINGLE_RECORD:
                $this->result = $this->real_prefix."10/accounts/$params?ApiAccount=227";
                break;
            case Accounts::POST_ACCOUNT:
                $this->result = $this->real_prefix."9/accounts?ApiAccount=227";
                break;
            case Accounts::POST_DEPOSIT:
                $this->result = $this->real_prefix."11/accounts/$params/balance?ApiAccount=231";
                break;
            case Accounts::POST_WITHDRAWAL:
                $this->result = $this->real_prefix."11/accounts/$params/balance?ApiAccount=231";
        }

        return $this->result;
    }

}