<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rapiwha_model extends CI_Model
{
    // https://panel.rapiwha.com/landing/login.php
    // aya_maruf@yahoo.com
    // Ujungpandang01

    public $my_apikey = "7QGMA10NIW2W4WCYCE38";

    // Get api_key
    public function apikey()
    {
        return $this->my_apikey;
    }

    // Get Credit
    public function get_credit()
    {
        $api_url = "http://panel.rapiwha.com/get_credit.php";
        $api_url .= "?apikey=" . urlencode($this->my_apikey);

        $result_object = json_decode(file_get_contents($api_url, false));
        return $result_object->credit;
        // var_dump($result_object);
    }

    // Send Message
    public function send($destination = '', $message)
    {
        $number = $this->hp($destination);
        if ($number != '') {

            $api_url = "http://panel.rapiwha.com/send_message.php";
            $api_url .= "?apikey=" . urlencode($this->my_apikey);
            $api_url .= "&number=" . urlencode($number);
            $api_url .= "&text=" . urlencode($message . ' - tfx.co.id');
            $result_object = json_decode(file_get_contents($api_url, false));

            return [
                'result' => $result_object->success,
                'description' => $result_object->description,
                'result_code' => $result_object->result_code,
            ];
        }
    }

    // Senf message from Admin
    function send_fromAdmin($message, $user_id) // 3 = finance, 6 = settlement
    {
        $user = $this->db->query('SELECT users.username, users.phone FROM users WHERE users.phone!="" AND users.id=' . $user_id)->row_array();
        if (!empty($user)) {
            return $this->send($user['phone'], $message);
        }
    }

    // Pull messages (for push messages please go to settings of the number)
    public function pull_message($number = '')
    {
        $number = $this->hp($number);
        $type = "OUT"; // TYPE OF MESSAGE: IN or OUT
        $markaspulled = "1"; // 1 or 0
        $getnotpulledonly = "0"; // 1 or 0
        $api_url  = "http://panel.rapiwha.com/get_messages.php";
        $api_url .= "?apikey=" . urlencode($this->my_apikey);
        if ($number != '') {
            $api_url .= "&number=" . urlencode($number);
        }
        $api_url .= "&type=" . urlencode($type);
        $api_url .= "&markaspulled=" . urlencode($markaspulled);
        $api_url .= "&getnotpulledonly=" . urlencode($getnotpulledonly);
        $my_json_result = file_get_contents($api_url, false);
        $my_php_arr = json_decode($my_json_result);

        return $my_php_arr;
    }

    public function hp($nohp = '')
    {
        if ($nohp != '') {
            // kadang ada penulisan no hp 0811 239 345
            $nohp = str_replace(" ", "", $nohp);
            // kadang ada penulisan no hp (0274) 778787
            $nohp = str_replace("(", "", $nohp);
            // kadang ada penulisan no hp (0274) 778787
            $nohp = str_replace(")", "", $nohp);
            // kadang ada penulisan no hp 0811.239.345
            $nohp = str_replace(".", "", $nohp);

            // cek apakah no hp mengandung karakter + dan 0-9
            if (!preg_match('/[^0-9]/', trim($nohp))) {
                // cek apakah no hp karakter 1-3 adalah +62
                if (substr(trim($nohp), 0, 2) == '62') {
                    $hp = trim($nohp);
                    return $hp;
                }
                // cek apakah no hp karakter 1 adalah 0
                elseif (substr(trim($nohp), 0, 1) == '0') {
                    $hp = '62' . substr(trim($nohp), 1);
                    return $hp;
                }
            } else {
                return $nohp;
            }
        } else {
            return '';
        }
    }
}
