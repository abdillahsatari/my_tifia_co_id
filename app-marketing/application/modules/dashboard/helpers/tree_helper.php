<?php
defined('BASEPATH') or exit('No direct script access allowed');



function mitra($id)
{
    $ci = &get_instance();
    return $ci->db->query("SELECT marketing.id, marketing.role_id, marketing.nama, marketing.kode, marketing_role.role FROM marketing, marketing_role WHERE marketing.id='$id' AND marketing.role_id=marketing_role.id")->row_array();
}

function spasi($jumlah)
{
    $spasi = '';

    for ($i = 1; $i <= $jumlah; $i++) {
        $spasi .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }

    return $spasi;
}
