<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akuntrading extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Acc_demo_model', 'Acc_trading_model', 'Acc_request_model', 'Nasabah_model', 'Log_model'));
        cekLogin();
    }

    public function index()
    {
        // $data['demo'] = $this->Acc_demo_model->get_by_id_nasabah($this->session->userdata('cd_id'));
        $data['demo'] = $this->Acc_request_model->get_by_id_nasabah_join_demo($this->session->userdata('cd_id'));

        // $data['real'] = $this->Acc_trading_model->get_by_id_nasabah($this->session->userdata('cd_id'));
        $data['real'] = $this->Acc_request_model->get_by_id_nasabah_join_real($this->session->userdata('cd_id'));

        $data['cekdemo'] = $this->Acc_demo_model->get_by_id_nasabah($this->session->userdata('cd_id'));

        $data['logtoday'] = $this->Log_model->get_by_nasabah_id($this->session->userdata('cd_id'));
        // $data['ceklastdemo'] = $this->Acc_request_model->get_last_request_demo($this->session->userdata('cd_id'));
        // $data['ceklastreal'] = $this->Acc_request_model->get_last_request_real($this->session->userdata('cd_id'));

        $data['akun_aktif'] = [
            'demo' => $this->db->query('SELECT no_akun FROM acc_demo WHERE nasabah_id="' . $this->session->userdata('cd_id') . '" AND status_aktif="Aktif" ORDER BY tanggal_buat_akun ASC')->result(),
            'real' => $this->db->query('SELECT no_akun FROM acc_trading WHERE nasabah_id="' . $this->session->userdata('cd_id') . '" AND status_aktif="Aktif" ORDER BY tanggal_buat_akun ASC')->result(),
        ];

        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('kabinet/auth-akuntrading', $data);
        $this->load->view('templates/footer');
    }

    public function test()
    {
        $this->load->helper('send_email_helper');
        $email['email'] = 'fasayayaqhsya@gmail.com';
        $email['subjek'] = 'test';
        $email['pesan'] = 'test';
        send_mailer($email);
    }

    public function getAccDetail()
    {
        $accid = $this->input->post('accid');
        $data = $this->Acc_trading_model->get_by_id_noakun_join($accid);
        // $data = $data['harga'];
        echo json_encode($data);
    }

    public function pilih_produk()
    {
        $lastStatReq = $this->Acc_request_model->get_last_request_real($this->session->userdata('cd_id'));
        if (!empty($lastStatReq)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                                      Tidak bisa request, Silahkan tunggu admin membuat akun trading dari request anda sebelumnya!
                                                    </div>');
            redirect('akuntrading');
        } else {
            $this->load->view('templates/header');
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('kabinet/auth-pilihproduk');
            $this->load->view('templates/footer');
        }
    }

    public function saveRequestDemo()
    {
        if ($this->input->is_ajax_request()) {
            $json = ['form_validation' => false, 'success' => false, 'alert' => array()];

            $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
            $this->form_validation->set_rules('leverage2', 'leverage', 'trim|required|numeric');
            $this->form_validation->set_rules('type2', 'jenis akun', 'trim|required|numeric');
            $this->form_validation->set_rules('deposit', 'deposit', 'trim|required|numeric');
            $this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

            if ($this->form_validation->run()) {
                $json['form_validation'] = TRUE;

                //0. memeriksa status request demo terakhir
                $lastStatDemo = $this->Acc_request_model->get_last_request_demo($this->session->userdata('cd_id'));
                if (!empty($lastStatDemo)) {
                    $json['alert'] = 'Tidak bisa request, Silahkan tunggu admin membuat akun demo dari request anda sebelumnya!';
                } else {

                    // Start database transaction
                    $this->db->trans_start();

                    //1. masukkan ke req akun
                    $dataReq = array(
                        'nasabah_id' => $this->session->userdata('cd_id'),
                        'acc_type_id' => $this->input->post('type2', TRUE),
                        'acc_leverage_id' => $this->input->post('leverage2', TRUE),
                        'acc_currency_id' => 2,
                        'deposit' => $this->input->post('deposit', TRUE),
                        'status_request' => 'Dikonfirmasi'
                    );
                    $request = $this->Acc_request_model->insert($dataReq);
                    //2. kirim email ke admin 
                  	//issue sendEmail
                    //$this->_sendEmail('Demo');
                    //3. masuk ke log nasabah
                    $dataLog = array(
                        'nasabah_id' => $this->session->userdata('cd_id'),
                        'acc_request_id' => $request,
                        'type' => 'Demo',
                        'read_status' => 'Y',
                        'aktifitas' => 'Merequest akun trading demo'
                    );
                    $this->Log_model->insert($dataLog);

                    // End transaction
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === FALSE) {
                        $json['alert'] = 'Request Akun Demo gagal';
                    } else {

                        // send whatsapp
                        $this->Rapiwha->send_fromAdmin('Notifikasi: Nasabah dengan akun ' . $this->session->userdata('nsb_email') . ' request buka akun demo. Mohon untuk segera melakukan approval.', 6);

                        // kirim email pemberitahuan ke Admin
                        $this->load->helper('send_email_helper');
                        $data_email['email'] = 'settlement@tifia.co.id';
                        $data_email['subjek'] = 'Permintaan buka akun demo';
                        $data_email['pesan'] = 'Dear admin, Nasabah dengan akun ' . $this->session->userdata('nsb_email') . ' request buka akun demo. Mohon untuk segera melakukan approval.';
                        send_mailer($data_email);

                        $json['success'] = true;
                        $json['alert'] = 'Request Akun Demo Berhasil, mohon untuk menunggu approval admin';
                        $json['href'] = base_url() . 'kabinet';
                    }
                }
            } else {
                foreach ($_POST as $key => $value) {
                    $json['alert'][$key] = form_error($key);
                }
            }
            echo json_encode($json);
        }
    }

    public function saveRequestReal()
    {
        if ($this->input->is_ajax_request()) {
            $json = ['form_validation' => false, 'success' => false, 'alert' => array()];

            $this->form_validation->set_rules('leverage', 'leverage', 'trim|required|numeric');
            $this->form_validation->set_rules('type', 'jenis akun', 'trim|required|numeric');
            $this->form_validation->set_error_delimiters('<div class="invalid-feedback-show">', '</div>');

            if ($this->form_validation->run()) {
                $json['form_validation'] = TRUE;

                // Start database transaction
                $this->db->trans_start();

                //0. memeriksa status nasabah
                // $statusNasabah = $this->Nasabah_model->get_by_id($this->session->userdata('cd_id'));

                // cek apakah sudah memiliki akun demo atau belum
                $cek_sudah_demo = $this->db->query('SELECT * FROM acc_demo WHERE nasabah_id=' . $this->session->userdata('cd_id'))->num_rows();
                if ($cek_sudah_demo > 0) {

                    //1. masukkan ke req akun
                    $status = 'Dikonfirmasi';
                    // if ($statusNasabah->status == 'Aktif') {
                    //     $status = 'Disetujui';
                    // } elseif ($statusNasabah->status == 'Register') {
                    //     $status = 'Dikonfirmasi';
                    // } elseif ($statusNasabah->status == 'Approved') {
                    //     $status = 'Konfirmasi';
                    // }

                    //1. masukkan ke req akun
                    $dataReq = array(
                        'nasabah_id' => $this->session->userdata('cd_id'),
                        'acc_leverage_id' => $this->input->post('leverage', TRUE),
                        'acc_type_id' => $this->input->post('type', TRUE),
                        'acc_currency_id' => 2,
                        'status_request' => $status
                    );
                    $request = $this->Acc_request_model->insert($dataReq);
                    //2. kirim email ke admin
                  	//issue sendEmail
                    //$this->_sendEmail('Real');
                    //3. masuk ke log nasabah
                    $dataLog = array(
                        'nasabah_id' => $this->session->userdata('cd_id'),
                        'acc_request_id' => $request,
                        'type' => 'Request Akun Real',
                        'read_status' => 'Y',
                        'aktifitas' => 'Merequest Akun Trading Real'
                    );
                    $this->Log_model->insert($dataLog);

                    // End transaction
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === FALSE) {
                        $json['alert'] = 'Request akun perdagangan gagal';
                    } else {

                        // send whatsapp
                        $this->Rapiwha->send_fromAdmin('Notifikasi: Nasabah dengan akun ' . $this->session->userdata('nsb_email') . ' request buka akun real. Mohon untuk segera melakukan approval.', 6);

                        // kirim email pemberitahuan ke Admin
                        $this->load->helper('send_email_helper');
                        $data_email['email'] = 'settlement@tifia.co.id';
                        $data_email['subjek'] = 'Permintaan buka akun demo';
                        $data_email['pesan'] = 'Dear admin, Nasabah dengan akun ' . $this->session->userdata('nsb_email') . ' request buka akun real. Mohon untuk segera melakukan approval.';
                        send_mailer($data_email);

                        $json['success'] = true;
                        $json['alert'] = 'Request akun perdagangan berhasil, mohon untuk menunggu approval admin';
                        $json['href'] = base_url() . 'kabinet';
                    }
                } else {
                    $json['alert'] = 'Mohon untuk membuat Akun Demo terlebih dahulu';
                }
            } else {
                foreach ($_POST as $key => $value) {
                    $json['alert'][$key] = form_error($key);
                }
            }
            echo json_encode($json);
        }
    }

    public function complete_register()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('registercomplete/save'),

            'nama_lengkap' => set_value('nama_lengkap'),
            'tempat_lahir' => set_value('tempat_lahir'),
            'tgl_lahir' => set_value('tgl_lahir'),
            'alamat_rumah' => set_value('alamat_rumah'),
            'kode_pos' => set_value('kode_pos'),
            'no_identitas' => set_value('no_identitas'),
            'pengalaman_investasi' => set_value('pengalaman_investasi'),
            'tujuan_pembukaan_rek' => set_value('tujuan_pembukaan_rek'),
            'no_npwp' => set_value('no_npwp'),
            'status_kawin' => set_value('status_kawin'),
            'nama_pasangan' => set_value('nama_pasangan'),
            'nama_ibu' => set_value('nama_ibu'),
            'kewarganegaraan' => set_value('kewarganegaraan'),
            'status_rumah' => set_value('status_rumah'),
            'gender' => set_value('gender'),
            'no_tlp' => set_value('no_tlp'),
            'no_faksimili' => set_value('no_faksimili'),
            'keluarga_bapepti' => set_value('keluarga_bapepti'),
            'status_pailit' => set_value('status_pailit'),

            'nama_rekan' => set_value('nama_rekan'),
            'telepon_rekan' => set_value('telepon_rekan'),
            'hubungan_rekan' => set_value('hubungan_rekan'),
            'alamat_rekan' => set_value('alamat_rekan'),
            'kode_pos_rekan' => set_value('kode_pos_rekan'),

            'pekerjaan' => set_value('pekerjaan'),
            'nama_perusahaan' => set_value('nama_perusahaan'),
            'bidang_usaha' => set_value('bidang_usaha'),
            'jabatan' => set_value('jabatan'),
            'lama_kerja' => set_value('lama_kerja'),
            'kantor_sebelumnya' => set_value('kantor_sebelumnya'),
            'alamat_kantor' => set_value('alamat_kantor'),
            'kode_pos_kantor' => set_value('kode_pos_kantor'),
            'telepon_kantor' => set_value('telepon_kantor'),
            'faksimili_kantor' => set_value('faksimili_kantor'),

            'pendapatan_pertahun' => set_value('pendapatan_pertahun'),
            'lokasi_rumah' => set_value('lokasi_rumah'),
            'njob' => set_value('njob'),
            'deposit_bank' => set_value('deposit_bank'),
            'jumlah_kekayaan' => set_value('jumlah_kekayaan'),
            'kekayaan_lainnya' => set_value('kekayaan_lainnya'),

            'nama_bank' => set_value('nama_bank'),
            'cabang' => set_value('cabang'),
            'telepon_bank' => set_value('telepon_bank'),
            'no_rekening' => set_value('no_rekening'),
            'kode_bank' => set_value('kode_bank'),
            'atas_nama' => set_value('atas_nama'),
            'jenis_rekening' => set_value('jenis_rekening'),

            'nama_bank2' => set_value('nama_bank2'),
            'cabang2' => set_value('cabang2'),
            'telepon_bank2' => set_value('telepon_bank2'),
            'no_rekening2' => set_value('no_rekening2'),
            'kode_bank2' => set_value('kode_bank2'),
            'atas_nama2' => set_value('atas_nama2'),
            'jenis_rekening2' => set_value('jenis_rekening2'),

            'pict_identitas' => set_value('pict_identitas'),
            'foto_terkini' => set_value('foto_terkini'),
            'dokumen_tambahan' => set_value('dokumen_tambahan'),
        );

        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');

        $nsbh = $this->db->query('SELECT tipe, status FROM nasabah WHERE nasabah_id="' . $this->session->userdata('cd_id') . '"')->row_array();
        // cek apakah sudah isi agreement atau belum
        if ($nsbh['status'] == 'Register') {

            // cek tipe agreement
            if ($nsbh['tipe'] == 'SPA') {
                $this->load->view('kabinet/auth-registercomplete-spa', $data);
            } elseif ($nsbh['tipe'] == 'Multilateral') {
                $this->load->view('kabinet/auth-registercomplete-multi', $data);
            }
        } else {
            $this->load->view('kabinet/auth-registercomplete_selesai');
        }
        $this->load->view('templates/footer');
    }

    private function _sendEmail($type)
    {
        if ($type == 'Demo') {
            $subject = 'Permohonan Pembuatan Akun Demo';
        } elseif ($type == 'Real') {
            $subject = 'Permohonan Pembuatan Akun Real';
        }

        if ($this->session->userdata('nsb_nama') == NULL) {
            $nama = $this->session->userdata('nsb_email');
        } else {
            $nama = $this->session->userdata('nsb_nama');
        }

        // Load helper email dan konfigurasinya
        $this->load->helper('send_email_helper');
        $email['email'] = 'settlement@tifia.co.id';
        $email['subjek'] = $subject;
        $email['pesan'] = 'Dear admin, Nasabah atas nama ' . $nama . ' (' . $this->session->userdata('nsb_email') . ') Melakukan ' . $subject . '. Mohon untuk segera ditindak lanjuti, terimakasih.';
        $msg = send_mailer($email);

        // Tampilkan pesan sukses atau error
        if ($msg['is_sent'] == TRUE) {
            return true;
        } else {
            echo $msg['error'];
            die();
        }
    }

    public function modal_bukaAkunTrading()
    {
        // cek apakah agreement sudah diisi
        $statusNasabah = $this->Nasabah_model->get_by_id($this->session->userdata('cd_id'));
        if ($statusNasabah->status == 'Approved' || $statusNasabah->status == 'Active') {

            // cek apakah ada akun trading yang belum di approve
            $jumlah_akun_pending = $this->db->query('
                                        SELECT acc_request_id, status_request 
                                        FROM acc_request 
                                        WHERE nasabah_id="' . $this->session->userdata('cd_id') . '" 
                                            AND status_request="Dikonfirmasi"
                                            AND
                                            (SELECT jenis FROM acc_type WHERE acc_type.acc_type_id=acc_request.acc_type_id) != "Demo"
                                    ')->num_rows();

            $output = '';
            if ($jumlah_akun_pending == 0) {

                // get account type
                $acc_type = $this->Acc_trading_model->get_acc_type();
                $select_acc_type = '';
                foreach ($acc_type as $r) {
                    $select_acc_type .= '<option value="' . $r->acc_type_id . '">' . $r->type . '</option>';
                }

                // get account leverage
                $acc_leverage = $this->Acc_trading_model->get_acc_leverage();
                $select_acc_leverage = '';
                foreach ($acc_leverage as $r) {
                    $select_acc_leverage .= '<option value="' . $r->acc_leverage_id . '">' . $r->nama_leverage . '</option>';
                }

                $output = '
                <form action="' . base_url() . 'akuntrading/saveRequestReal" id="form_buatAkunReal" method="POST">

                    <div class="form-group">
                        <label for="type">Jenis akun</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">-- Pilih --</option>
                            ' . $select_acc_type . '
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="leverage">Leverage</label>
                        <select name="leverage" id="leverage" class="form-control">
                            <option value="">-- Pilih --</option>
                            ' . $select_acc_leverage . '
                        </select>
                    </div>

                    <div class="text-center">
                        <button id="submit" type="submit" class="btn btn-primary mt-3">Buat Akun Perdagangan</button>
                    </div>

                </form>
            ';
            } else {
                $output = '
                <div class="text-center">
                    <i class="fa fa-times-circle fa-3x mb-4 text-danger"></i>
                    <h5>
                        Maaf, anda masih memiliki akun yang belum dikonfirmasi/disetujui
                    </h5>
                </div>
                ';
            }
        } elseif ($statusNasabah->status == 'Complete' || $statusNasabah->status == 'Checking') {
            $output = '
                <div class="text-center">
                    <i class="fa fa-times-circle fa-3x mb-4 text-danger"></i>
                    <h5>
                        Mohon untuk menunggu sampai Data anda selesai diperiksa oleh Tim kami.
                    </h5>
                </div>
                ';
        } else {
            $output = '
                <div class="text-center">
                    <i class="fa fa-times-circle fa-3x mb-4 text-danger"></i>
                    <h5>
                        Mohon untuk melakukan Pengisian Aplikasi Pendaftaran Nasabah
                    </h5>
                    <div class="m--space-30 m--margin-top-20 text-center">
                        <a class="btn btn-outline-primary btn-sm m-btn m-btn m-btn--icon m-btn--pill" href="registercomplete">
                            <span>
                                <i class="fa fa-paper-plane"></i>
                                <span>Aplikasi Pendaftaran Nasabah</span>
                            </span>
                        </a>
                    </div>
                </div>
                ';
        }
        echo $output;
    }

    function get_summary_akun()
    {
        if ($this->input->is_ajax_request()) {
            $json = ['success' => false, 'data' => []];

            $no_akun = $this->input->post('no_akun');
            $jenis = $this->input->post('jenis');

            // quer

            // cek apakah no_akun exist
            if (1 == 1) {
                $json['success'] = true;
                $json['data'] = [
                    'saldo' => 0,
                    'prf' => 0 // Profitabilitas
                ];
            } else {
                $json['data'] = [
                    'saldo' => 0,
                    'prf' => 0 // Profitabilitas
                ];
            }
            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }
}
