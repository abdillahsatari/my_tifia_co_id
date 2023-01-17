<?php
defined('BASEPATH') or exit('No direct script access allowed');

function mkt_total_balance($id = '')
{
    $ci = &get_instance();

    if ($id == '') {
        $id = $ci->session->userdata('mkt');
    }

    $total = mkt_komisi($id, 'IDR') - mkt_withdrawal($id);
    if ($total > 0) {
        return $total;
    } else {
        return 0;
    }
}

function mkt_komisi($id = '', $currency = 'IDR')
{
    $ci = &get_instance();

    if ($id == '') {
        $id = $ci->session->userdata('mkt');
    }

    $query = $ci->db->query("SELECT SUM(amount) AS amount, SUM(amount_usd) AS amount_usd FROM marketing_komisi WHERE marketing_id='$id'");
    $result = $query->row_array();

    if ($currency == 'USD') $amount = $result['amount_usd'];
    else $amount = $result['amount'];

    return ($amount > 0 ? $amount : 0);
}

// #################################################################
// WITHDRAWAL

function mkt_withdrawal($id = '')
{
    $ci = &get_instance();

    if ($id == '') {
        $id = $ci->session->userdata('mkt');
    }

    $query = $ci->db->query("SELECT SUM(amount_kotor) FROM marketing_withdrawal WHERE status!='Declined' AND marketing_id='$id'");
    $result = $query->row_array();
    return $result['SUM(amount_kotor)'];
}

// #################################################################
#LOT

function mkt_total_lot($id)
{
    $ci = &get_instance();

    if ($id == '') {
        $id = $ci->session->userdata('mkt');
    }

    $ci->load->library('Tree');

    // get direct child
    $child = $ci->db->query("SELECT nasabah_id FROM nasabah WHERE parent_id='$id'")->result();

    $total_lot = 0;

    foreach ($child as $children) {

        // get akun trading nasabah
        $acc_trading = $ci->db->query("SELECT no_akun FROM acc_trading WHERE nasabah_id='$children->nasabah_id'")->result();

        foreach ($acc_trading as $r) {

            // get lot transaksi trading nasabah
            $transaksi_trading = $ci->db->query("SELECT SUM(lot) AS total_lot FROM nasabah_transaksi_trading WHERE no_akun='$r->no_akun'")->row_array();
            $total_lot += $transaksi_trading['total_lot'];
        }
    }

    return $total_lot;
}


// #################################################################

// omset 
function mkt_omset($id = '')
{
    $ci = &get_instance();

    if ($id == '') {
        $id = $ci->session->userdata('mkt');
    }

    //cek dulu apakah user seorang member biasa(1) atau founder(2)

    $query = $ci->db->query("SELECT status_member FROM tb_member WHERE id_member='$id'");
    $result = $query->row_array();
    $status_uom = $result['status_member'];

    if ($status_uom == '1') {

        return mkt_total_omset_direct($id);
    } elseif ($status_uom == '2') {

        return mkt_total_omset_all($id);
    }
}

function mkt_total_omset_direct($id)
{
    $ci = &get_instance();

    $query = $ci->db->query("SELECT SUM(tb_investment.amount) FROM tb_investment, tb_member WHERE tb_investment.id_member=tb_member.id_member AND tb_member.id_parent='$id'");
    $result = $query->row_array();
    return $result['SUM(tb_investment.amount)'];
}

function mkt_total_omset_all($id)
{
    $ci = &get_instance();


    $total = 0;

    $query = $ci->db->query("SELECT id_member
        FROM 
            (SELECT * FROM tb_member ORDER BY id_parent, id_member ASC) as a,
            (SELECT @pv := $id) initialisation
        WHERE find_in_set(id_parent, @pv) > 0 AND @pv := CONCAT(@pv, ',', id_member)");

    foreach ($query->result() as $r) {
        $id = $r->id_member;

        $query = $ci->db->query("SELECT SUM(amount) FROM tb_investment WHERE id_member=$id");
        $result = $query->row_array();
        $total += $result['SUM(amount)'];
    }

    return $total;
}



// ##########################################################################

function mkt_jumlah_referral($id = '')
{
    $ci = &get_instance();

    if ($id == '') {
        $id = $ci->session->userdata('mkt');
    }

    $query = $ci->db->query("SELECT COUNT(tb_member.id_member) FROM tb_member, tb_login_member WHERE tb_member.id_member=tb_login_member.id_member AND tb_member.id_parent='$id' AND tb_login_member.status_registrasi='1'");
    $result = $query->row_array();
    return $result['COUNT(tb_member.id_member)'];
}

function mkt_jumlah_referral_waiting($id = '')
{
    $ci = &get_instance();

    if ($id == '') {
        $id = $ci->session->userdata('mkt');
    }

    $query = $ci->db->query("SELECT COUNT(tb_member.id_member) FROM tb_member, tb_login_member WHERE tb_member.id_member=tb_login_member.id_member AND tb_member.id_parent='$id' AND tb_login_member.status_registrasi='0'");
    $result = $query->row_array();
    return $result['COUNT(tb_member.id_member)'];
}
