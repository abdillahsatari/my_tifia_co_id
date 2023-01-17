<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Allowance_approval extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        cekLogin();
        cekRole('7');
        agreement_check();
        $this->load->model(['Allowance_approval_model' => 'model']);
    }

    public function index()
    {
        $this->viewku->title("Allowance Approval");
        $this->viewku->view("allowance/list_approval");
    }

    public function allowance_model($id)
    {
        $output = '';

        $query = $this->db->query("SELECT marketing_allowance.*, marketing.nama, marketing.kode as kode_sales, marketing.email, marketing.no_hp FROM marketing_allowance, marketing WHERE marketing_allowance.id='$id'");

        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            $output = '
                <form action="' . base_url() . 'dashboard/allowance_approval/allowance_action" method="POST" id="form">

                    <input type="hidden" name="id" value="' . $id . '">

                    <table class="table table-striped">
                        <tr>
                            <td colspan="2" class="font-weight-bold">Marketing Info</td>
                        </tr>
                        <tr>
                            <td>Marketing</td>
                            <td>
                            <b class="text-danger">' . $data['kode_sales'] . '</b><br>
                            ' . $data['nama'] . '
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>' . $data['email'] . '</td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td>' . $data['no_hp'] . '</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="font-weight-bold">Bank Info</td>
                        </tr>
                        
                        ';

            if ($data['status'] == 'New' || $data['status'] == 'Pending') {
                $output .= '   
                        <tr>
                            <td>Bank</td>
                            <td>
                                <input type="text" class="form-control input-sm" name="rekening_bank" value="' . $data['rekening_bank'] . '" id="rekening_bank">
                            </td>
                        </tr>
                        <tr>
                            <td>Nama pemilik rekening</td>
                            <td>
                                <input type="text" class="form-control input-sm" name="rekening_nama" value="' . $data['rekening_nama'] . '" id="rekening_nama">
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor rekening</td>
                            <td>
                                <input type="text" class="form-control input-sm" name="rekening_nomor" value="' . $data['rekening_nomor'] . '" id="rekening_nomor">
                            </td>
                        </tr>     
                        <tr>
                            <td colspan="2" class="font-weight-bold">Allowance Info</td>
                        </tr>
                        <tr>
                            <td>Kode</td>
                            <td class="font-weight-bold">' . $data['kode'] . '</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><code>' . $data['status'] . '</code></td>
                        </tr>
                        <tr>
                            <td>Date requested</td>
                            <td>' . date_tampil($data['date_requested']) . '</td>
                        </tr>
                        <tr>
                            <td>Amount requested</td>
                            <td>IDR ' . rupiah($data['amount_kotor']) . '</td>
                        </tr>
                        <tr>
                            <td>Amount to transfer</td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">IDR</span>
                                    </div>
                                    <input type="number" class="form-control input-sm" name="amount_bersih" min="0" step="1000" value="' . $data['amount_kotor'] . '" id="amount_bersih">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Status</td>
                            <td>
                                <select name="status" id="status" class="form-control">
                                    <option value="New" disabled>New</option>
                                    <option value="Pending"' . ($data['status'] == 'Pending' ? 'selected' : '') . '>Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Declined">Declined</option>
                                </select>
                            </td>
                        </tr>
                    </table>

                    <div class="form-group text-center mt-5">
                        <button class="btn btn-success" type="submit" id="submit">Kirim</button>
                    </div>';
            } else {
                $output .= ' 
                        <tr>
                            <td>Bank</td>
                            <td>' . $data['rekening_bank'] . '</td>
                        </tr>
                        <tr>
                            <td>Nama pemilik rekening</td>
                            <td>' . $data['rekening_nama'] . '</td>
                        </tr>
                        <tr>
                            <td>Nomor rekening</td>
                            <td>' . $data['rekening_nomor'] . '</td>
                        </tr>          
                        <tr>
                            <td colspan="2" class="font-weight-bold">Allowance Info</td>
                        </tr>
                        <tr>
                            <td>Kode</td>
                            <td class="text-danger font-weight-bold">' . $data['kode'] . '</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><code>' . $data['status'] . '</code></td>
                        </tr>
                        <tr>
                            <td>Date requested</td>
                            <td>' . date_tampil($data['date_requested']) . '</td>
                        </tr>
                        <tr>
                            <td>Date updated</td>
                            <td>' . date_tampil($data['date_updated']) . '</td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td>IDR ' . ($data['amount_bersih'] == NULL ? rupiah($data['amount_kotor']) : rupiah($data['amount_bersih']))  . '</td>
                        </tr>
                    </table>';
            }

            $output .= '</form>';
        } else {
            $output = 'Not found';
        }


        echo $output;
    }

    public function allowance_action()
    {
        if ($this->input->is_ajax_request()) {
            $json = ['form_validation' => false, 'success' => false, 'alert' => array()];

            $this->form_validation->set_rules('id', 'id', 'trim|numeric|required');
            $this->form_validation->set_rules('amount_bersih', 'amount', 'trim|required|numeric|greater_than[0]');
            $this->form_validation->set_rules('status', 'status', 'trim|required|in_list[New,Pending,Approved,Declined]');
            $this->form_validation->set_rules('rekening_bank', 'bank', 'trim|xss_clean');
            $this->form_validation->set_rules('rekening_nama', 'nama pemilik rekening', 'trim|xss_clean');
            $this->form_validation->set_rules('rekening_nomor', 'nomor rekening', 'trim|xss_clean');

            $this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

            if ($this->form_validation->run()) {
                $json['form_validation'] = TRUE;

                $date = new_date();
                $id = $this->input->post('id');
                $status = $this->input->post('status');

                // Start database transaction
                $this->db->trans_start();

                $query = $this->db->query("SELECT * FROM marketing_allowance WHERE id='$id'")->row_array();

                if ($query) {

                    $data = [
                        'amount_bersih' => $this->input->post('amount_bersih'),
                        'rekening_bank' => $this->input->post('rekening_bank'),
                        'rekening_nama' => $this->input->post('rekening_nama'),
                        'rekening_nomor' => $this->input->post('rekening_nomor'),
                        'status' => $status,
                        'approve_marketing_id' => sess('mkt'),
                        'approve_admin_id' => NULL,
                        'date_updated' => $date,
                    ];
                    $this->db->update('marketing_allowance', $data, ['id' => $id]);

                    // insert log
                    $marketing_log = [
                        'marketing_id' => sess('mkt'),
                        'summary' => 'marketing_allowance[' . $id . ']',
                        'tipe' => 'Update allowance ' . $status,
                        'aktifitas' => 'Update allowance [' . $query['kode'] . ']: ' . $status,
                        'date' => $date
                    ];
                    $this->db->insert('marketing_log', $marketing_log);
                }

                // End transaction
                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    $json['alert'] = 'Update allowance gagal';
                } else {
                    $json['success'] = true;
                    $json['alert'] = 'Update allowance berhasil';
                }
            } else {
                foreach ($_POST as $key => $value) {
                    $json['alert'][$key] = form_error($key);
                }
            }
            echo json_encode($json);
        }
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
								<span class="text-danger">' . $r->kode_sales . '</span>
								<br>
								' . $r->nama . '
								</div>';
            $sub_array[] =  '<div class="text-center">IDR ' . ($r->amount_bersih == NULL ? rupiah($r->amount_kotor) : rupiah($r->amount_bersih)) . '</div>';
            $sub_array[] =  '<div class="text-center">' . date_tampil($r->date_requested) . '</div>';
            $sub_array[] =  '<div class="text-center"><code>' . $r->status . '</code></div>';
            if ($r->status == 'New' || $r->status == 'Pending') {
                $sub_array[] =  '<div class="text-center">
                                <div class="btn-group">
									<button data-href="' . base_url('dashboard/allowance_approval/allowance_model/' . $r->id) . '" class="btn btn-info btn-sm modalEdit">Process <i class="fa fa-arrow-right"></i></button>
								</div></div>';
            } else {
                $sub_array[] =  '<div class="text-center">
                                <div class="btn-group">
									<button data-href="' . base_url('dashboard/allowance_approval/allowance_model/' . $r->id) . '" class="btn btn-primary btn-sm modalEdit">Detail <i class="fa fa-info-circle"></i></button>
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
