<?php
defined('BASEPATH') or exit('No direct script access allowed');


function flash_alert($isi = "", $tipe = 'success')
{
    $ci = &get_instance();
    $ci->session->set_flashdata(
        'message',
        '<div class="alert alert-' . $tipe . ' alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            ' . $isi . '
        </div>'
    );
}

function new_date()
{
    $timezone = new DateTimeZone("Asia/Jakarta");
    $dt = new DateTime();
    $dt->setTimeZone($timezone);
    $date = $dt->format('Y-m-d H:i:s');

    return $date;
}

function date_tampil($tgl = '', $format = 'd/m/Y H:i')
{
    if ($tgl != '') {
        $date = date($format, strtotime($tgl));
        return $date;
    } else {
        return '';
    }
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

function sess($nama)
{
    $ci = &get_instance();
    return $ci->session->userdata($nama);
}

// ###############################################

// generate new id / get id after last id
function after_last_id($table, $incremented_column)
{
    $ci = &get_instance();

    $query = $ci->db->query("SELECT MAX($incremented_column) as a FROM $table");
    if ($query->num_rows() > 0) {
        $res = $query->row_array();
        return $res["a"] + 1;
    } else {
        return 0;
    }
}

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

function gateway()
{
    $ci = &get_instance();

    return $ci->db->get_where('gateway', ['is_active' => '1', 'is_deleted' => '0'])->result();
}


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

// ##############################################################

function _error404()
{
    $ci = &get_instance();
    $ci->viewku->title('Error');
    $ci->viewku->view('error_404');
}
