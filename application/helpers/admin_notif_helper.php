<?php
defined('BASEPATH') or exit('No direct script access allowed');


# NASABAH
function nsb_deposit($status_deposit = 'Pending')
{
    $ci = &get_instance();

    return $ci->db->query("SELECT deposit_id FROM deposit WHERE status_deposit='$status_deposit'")->num_rows();
}

function nsb_withdraw($status_withdraw = 'Pending')
{
    $ci = &get_instance();

    return $ci->db->query("SELECT withdraw_id FROM withdraw WHERE status_withdraw='$status_withdraw'")->num_rows();
}

function nsb_request_akun_trading($jenis = 'Real') // Real atau Demo
{
    $ci = &get_instance();

    return $ci->db->query("SELECT acc_request_id FROM acc_request, acc_type WHERE acc_request.acc_type_id=acc_type.acc_type_id AND acc_request.status_request='Dikonfirmasi' AND acc_type.jenis='$jenis'")->num_rows();
}

# MARKETING

function mkt_withdraw($status = 'New') // komisi
{
    $ci = &get_instance();

    return $ci->db->query("SELECT id FROM marketing_withdrawal WHERE status='$status'")->num_rows();
}

function mkt_allowance($status = 'New')
{
    $ci = &get_instance();

    return $ci->db->query("SELECT id FROM marketing_allowance WHERE status='$status'")->num_rows();
}

function mkt_verify($status = 'T')
{
    $ci = &get_instance();

    return $ci->db->query("SELECT id FROM marketing WHERE status_verify='$status'")->num_rows();
}


# UMUM

function failed_email()
{
    $ci = &get_instance();

    return $ci->db->query("SELECT id FROM log_email")->num_rows();
}
