<?php
defined('BASEPATH') or exit('No direct script access allowed');

function rules_edit_mitra()
{
    $rules = [
        1 => [],
        2 => [3, 4, 5],
        3 => [4, 5],
        4 => [],
        5 => []
    ];
    return $rules;
}

function agreement_check($marketing_id = '')
{
    $ci = &get_instance();

    if ($marketing_id == '') $marketing_id = sess('mkt');

    $status_perjanjian = $ci->db->query("SELECT status_perjanjian FROM marketing WHERE marketing.id='$marketing_id'")->row_array()['status_perjanjian'];

    if ($status_perjanjian != 'Approved') {
        flash_alert('Harap untuk mengisi Nota Kesepakatan Kerjasama Kegiatan Pemasaran terlebih dahulu', 'danger');
        redirect('dashboard');
    }
}
