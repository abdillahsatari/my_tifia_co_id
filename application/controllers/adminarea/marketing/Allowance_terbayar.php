<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Allowance_terbayar extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model(['sales/Allowance_terbayar_model' => 'model']);
    }

    public function index()
    {
        $data['title'] = 'Allowance';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Allowance' => '#',
            'Terbayar' => '#',
        ];
        $data['page'] = 'admin_marketing/allowance/list_terbayar';
        $this->load->view('template/backend', $data);
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "allowance approved.xls";
        $judul = "allowance approved";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Allowance");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Marketing");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Marketing");
        xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Amount Request");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Request");
        xlsWriteLabel($tablehead, $kolomhead++, "Amount Transfer");
        xlsWriteLabel($tablehead, $kolomhead++, "Bank");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Pemilik Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Nomor Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Approved");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        foreach ($this->model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode_sales);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
            xlsWriteLabel($tablebody, $kolombody++, $data->amount_kotor);
            xlsWriteLabel($tablebody, $kolombody++, $data->date_requested);
            xlsWriteLabel($tablebody, $kolombody++, $data->amount_bersih);
            xlsWriteLabel($tablebody, $kolombody++, $data->rekening_bank);
            xlsWriteLabel($tablebody, $kolombody++, $data->rekening_nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->rekening_nomor);
            xlsWriteLabel($tablebody, $kolombody++, $data->date_updated);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);

            $tablebody++;
            $nourut++;
        }



        xlsEOF();
        exit();
    }

    // ################################################
    // datatables
    function fetch_list()
    {
        $fetch_data = $this->model->make_datatables_list();
        $data = array();
        $no = 1;
        foreach ($fetch_data as $r) {

            $sub_array = array();
            $sub_array[] =  '<div class="text-center">' . $no . "." . '</div>';
            $sub_array[] =  '<div class="text-center font-weight-bold text-danger">' . $r->kode . '</div>';
            $sub_array[] =  '<div class="text-left">
                                <a href="' . base_url('adminarea/marketing/sales/view/' . $r->marketing_id) . '" class="text-danger">' . $r->kode_sales . '</a>
								<br>
								' . $r->nama . '
								</div>';
            $sub_array[] =  '<div class="text-center">' . $r->jabatan . '</div>';
            $sub_array[] =  '<div class="text-center">IDR ' . rupiah($r->amount_bersih) . '</div>';
            $sub_array[] =  '<div class="text-center">' . date_tampil($r->date_updated) . '</div>';
            $sub_array[] =  '<div class="text-center"><code>' . $r->status . '</code></div>';
            if ($r->status == 'New' || $r->status == 'Pending') {
                $sub_array[] =  '<div class="text-center">
                                <div class="btn-group">
									<button data-href="' . base_url('adminarea/marketing/allowance_approval/allowance_model/' . $r->id) . '" class="btn btn-success btn-sm modalEdit">Process <i class="fa fa-arrow-right"></i></button>
								</div></div>';
            } else {
                $sub_array[] =  '<div class="text-center">
                                <div class="btn-group">
									<button data-href="' . base_url('adminarea/marketing/allowance_approval/allowance_model/' . $r->id) . '" class="btn btn-primary btn-sm modalEdit">Detail <i class="fa fa-info-circle"></i></button>
								</div></div>';
            }
            $data[] = $sub_array;
            $no++;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->model->get_all_data_list(),
            "recordsFiltered" => $this->model->get_filtered_data_list(),
            "data" => $data
        );
        echo json_encode($output);
    }
}
