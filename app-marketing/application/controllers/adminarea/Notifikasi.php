<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Log_model', 'Nasabah_model'));
    }

    public function getcountall()
    {
        $jumlah = $this->Log_model->get_count_unread_deposit();
        echo $jumlah;
    }

    public function getalldata()
    {
        $jumlah = $this->Log_model->get_data_unread_deposit();
        header('Content-Type: application/json');
        echo json_encode($jumlah);
    }

    public function readall()
    {
        $this->Log_model->set_read_all_deposit();
        // echo $status;
    }

    public function getTotalNotification()
    {
        $data = $this->Nasabah_model->get_count_email_notverify();
        $data1 = $this->Nasabah_model->get_count_register();
        $data2 = $this->Nasabah_model->get_count_complete_register();

        echo $data + $data1 + $data2;
    }

    public function getAllUnverifiedEmail()
    {
        $data = $this->Nasabah_model->get_count_email_notverify();
        echo $data;
    }

    public function getNewRegistered()
    {
        $data = $this->Nasabah_model->get_count_register();
        echo $data;
    }

    public function getAllNotif()
    {
        $user_id = $this->ion_auth->get_user_id();
        $users_groups = $this->db->query("SELECT * FROM users_groups WHERE user_id='$user_id'")->result();
        $my_group_ids = [];
        foreach ($users_groups as $r) {
            array_push($my_group_ids, $r->group_id);
        }

        $email_unverified = $this->Nasabah_model->get_count_email_notverify();
        // $nasabah_register = $this->Nasabah_model->get_count_register();
        $nasabah_completed_agreement = $this->Nasabah_model->get_count_complete_register();

        $this->load->helper('admin_notif');

        $all_notif = [
            ['count' => $email_unverified, 'icon' => 'fa fa-envelope text-warning', 'text' => 'member with unverified email', 'link' => 'adminarea/nasabah_list_register', 'accessible_by' => ['7', '8', '4']],
            // ['count' => $nasabah_register, 'icon' => 'fa fa-users text-info', 'text' => 'new member <strong>register</strong>', 'link' => 'adminarea/nasabah_list_register'],
            ['count' => $nasabah_completed_agreement, 'icon' => 'fa fa-file text-info', 'text' => 'member <strong>completed agreement</strong>', 'link' => 'adminarea/nasabah_check_in', 'accessible_by' => ['8', '4']],
            ['count' => nsb_request_akun_trading('Real'), 'icon' => 'fa fa-newspaper text-success', 'text' => 'member <strong>request akun real</strong>', 'link' => 'adminarea/acc_request', 'accessible_by' => ['4']],
            ['count' => nsb_request_akun_trading('Demo'), 'icon' => 'fa fa-newspaper text-success', 'text' => 'member <strong>request akun demo</strong>', 'link' => 'adminarea/acc_demo_request', 'accessible_by' => ['4']],
            ['count' => nsb_deposit('Pending'), 'icon' => 'fa fa-arrow-right text-success', 'text' => 'new <strong>deposit</strong>', 'link' => 'adminarea/deposit', 'accessible_by' => ['7', '4']],
            ['count' => nsb_withdraw('Pending'), 'icon' => 'fa fa-arrow-left text-danger', 'text' => 'new <strong>withdrawal</strong>', 'link' => 'adminarea/withdraw', 'accessible_by' => ['7', '4']],
        ];

        $data['count'] = 0;
        $data['list'] = '';
        foreach ($all_notif as $r) {

            if (
                count(array_intersect($my_group_ids, $r['accessible_by'])) > 0 ||
                in_array('1', $my_group_ids)
            ) {

                $data['list'] .= '
                    <li>
                        <a href="' . base_url($r['link']) . '">
                            <i class="' . $r['icon'] . '"></i> ' . $r['count'] . ' ' . $r['text'] . '
                        </a>
                    </li>';

                $data['count'] += $r['count'];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function getAllNotifMarketing()
    {
        $this->load->helper('admin_notif');

        $user_id = $this->ion_auth->get_user_id();
        $users_groups = $this->db->query("SELECT * FROM users_groups WHERE user_id='$user_id'")->result();
        $my_group_ids = [];
        foreach ($users_groups as $r) {
            array_push($my_group_ids, $r->group_id);
        }

        $all_notif = [
            ['count' => mkt_verify('T'), 'icon' => 'fa fa-envelope text-warning', 'text' => 'member with unverified email', 'link' => 'adminarea/marketing/sales', 'accessible_by' => []],
            ['count' => mkt_withdraw('New'), 'icon' => 'fa fa-arrow-left text-info', 'text' => 'new <strong>komisi request</strong>', 'link' => 'adminarea/marketing/withdrawal_request', 'accessible_by' => ['7']],
            ['count' => mkt_allowance('New'), 'icon' => 'fa fa-arrow-left text-info', 'text' => 'new <strong>allowance request</strong>', 'link' => 'adminarea/marketing/allowance_approval', 'accessible_by' => ['7']],
        ];

        $data['count'] = 0;
        $data['list'] = '';
        foreach ($all_notif as $r) {
            if (
                count(array_intersect($my_group_ids, $r['accessible_by'])) > 0 ||
                in_array('1', $my_group_ids)
            ) {

                $data['list'] .= '
                    <li>
                        <a href="' . base_url($r['link']) . '">
                            <i class="' . $r['icon'] . '"></i> ' . $r['count'] . ' ' . $r['text'] . '
                        </a>
                    </li>';

                $data['count'] += $r['count'];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
