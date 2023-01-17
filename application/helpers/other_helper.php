<?php
defined('BASEPATH') or exit('No direct script access allowed');


function flash_alert($isi = "", $tipe = 'success')
{
    $ci = &get_instance();
    $ci->session->set_flashdata(
        'message',
        '<div class="alert alert-' . $tipe . '" role="alert" id="tooltip-alert">
        ' . $isi . '
        </div>'
    );
}

function new_date()
{
    // $ci = &get_instance();

    // $query = $ci->db->query(" SELECT nilai
    //                             FROM tb_setting
    //                             WHERE kode = 'TIMEZONE'");
    // $result = $query->row_array();

    // $timezone = $result['nilai'];

    $timezone = new DateTimeZone("Asia/Makassar");
    $dt = new DateTime();
    $dt->setTimeZone($timezone);
    $date = $dt->format('Y-m-d H:i:s');

    return $date;
}

function date_tampil($tgl = '', $format = 'd/m/Y H:i')
{

    $date = date($format, strtotime($tgl));
    return $date;
}

function nama_date($tanggal)
{
    // nama hari
    $day = date('D', strtotime($tanggal));
    $array_hari = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
    );
    // if (array_key_exists($day, $array_hari)) {
    $rtrn['hari'] = $array_hari[$day];
    // }

    // nama bulan
    $bln = date('m', strtotime($tanggal));
    $array_bulan = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    );
    // if (array_key_exists($bln, $array_bulan)) {
    $rtrn['bulan'] = $array_bulan[$bln];
    // }

    return $rtrn;
}

// ###############################################

// menampilkan wilayah berdasarkan table dan id
function tampilkan_wilayah($table, $where, $selected)
{
    $ci = &get_instance();
    $str = "";
    $query = $ci->db->get_where($table, $where);
    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $str .= '<option value="' . $row->id . '"';
            $str .= (($row->id == $selected) ? " selected >" : ">");
            $str .= $row->name . " </option>";
        }
    } else {
        $str .= "Failed to load table $table";
    }

    return $str;
}

// ###############################################

// untuk kode
function generate_kd($total_char, $char, $format = '0')
{
    $char_length = strlen($char);

    $panjang_format = $total_char - $char_length;

    $format_only = '';

    for ($i = 1; $i <= $panjang_format; $i++) {
        $format_only .= $format;
    }

    return $format_only . $char;
}

// ###############################################

function rupiah_lama($angka)
{
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function rupiah($num, $decimalSeparator = ',', $thousandSeparator = '.')
{
    $num = floatval($num);

    if ($num != '') {
        $asStr = strval($num);

        $exploded = explode('.', $asStr);
        $int = $exploded[0];
        $decimal = isset($exploded[1]) ? $exploded[1] : null;

        $result = number_format($int, 0, ".", $thousandSeparator);
        if ($decimal !== null) {
            $result .= $decimalSeparator . $decimal;
        }

        return $result;
    } else {
        return 0;
    }
}

function my_role_id($marketing_id = '')
{
    $CI = &get_instance();

    if ($marketing_id == '') {
        $marketing_id = sess('mkt');
    }

    // get role_id user
    $qry1 = $CI->db->query('SELECT role_id FROM marketing WHERE id="' . $marketing_id . '"')->row_array();
    return $qry1['role_id'];
}

function after_pph21($amount)
{
    $pph21 = $amount * (50 / 100) * (5 / 100);
    return $amount - $pph21;
}
