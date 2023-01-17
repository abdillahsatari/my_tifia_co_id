<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akuntrading extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Acc_leverage_model', 'Acc_request_model', 'Acc_demo_model', 'Acc_trading_model', 'Nasabah_model', 'Log_model'));
        $this->load->library('api/Services/AccountsServices');
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
        $email['email']     = 'developer@tfx.co.id';
        $email['subjek']    = 'email testing';
        $email['pesan']     = 'Email testing from kabinet nasabah';
        $status             = send_mailer($email);

        var_dump($status);

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

                /**
                 *
                 *  Create New Account in Meta
                 *
                 **/

                $nasabah        = $this->Nasabah_model->getdata('nasabah_id', $this->session->userdata("cd_id"))->row_array();
                $masterPwd	    = random_string('alnum', 7);
                $investorPwd    = random_string('alnum', 7);
                $phonePwd       = random_string('alnum', 7);
                $leverageId     = $this->input->post('leverage2', TRUE);
                $dataLeverage   = $this->Acc_leverage_model->get_by_id($leverageId);
                $body = array("group"                   => "demoForex_TFX",
                                "enable"                => true,
                                "enableChangePassword"  => true,
                                "enableReadOnly"        => true,
                                "enableOtp"             => true,
                                "password"              => $masterPwd,
                                "passwordInvestor"      => $investorPwd,
                                "passwordPhone"         => $phonePwd,
                                "name"                  => $nasabah["nama_lengkap"],
                                "country"               => $nasabah["kewarganegaraan"],
                                "city"                  => $nasabah["lokasi_rumah"],
                                "state"                 => $nasabah["kewarganegaraan"],
                                "address"               => $nasabah["alamat_rumah"],
                                "phone"                 => $nasabah["no_hp"] ?: $nasabah["no_tlp"],
                                "email"                 => $nasabah["email"],
                                "leverage"              => $dataLeverage->leverage);

                $endpoint   = $this->endpoints->sogeeapi_demo(Accounts::POST_ACCOUNT);
                $restPA     = $this->restclient->requestPost($endpoint, $body);

                if ($restPA["code"] == 201){

                    /**
                     *
                     * Add Balance to inserted Account
                     *
                     * */

                    $accountNumber  = json_decode($restPA["response"], true)["login"];
                    $body           = array("value"     => $this->input->post('deposit', TRUE),
                                            "comment"   => "Deposit");

                    $endpoint = $this->endpoints->sogeeapi_demo(Accounts::POST_DEPOSIT, $accountNumber);
                    $restPD = $this->restclient->requestPost($endpoint, $body);

                    if ($restPD["code"] == 201){

                        /**
                         *
                         *  Insert into Kabinet
                         *
                         **/

                        // Start database transaction
                        $this->db->trans_start();

                        //1. insert data into acc_request
                        $dataReqDemo = array('nasabah_id'       => $this->session->userdata('cd_id'),
                                            'acc_type_id'       => $this->input->post('type2', TRUE),
                                            'acc_leverage_id'   => $this->input->post('leverage2', TRUE),
                                            'acc_currency_id'   => 2,
                                            'user_id'           => 6,
                                            'deposit'           => intval($this->input->post('deposit', TRUE)),
                                            'status_request'    => 'Aktif');

                        $accRequestId       = $this->Acc_request_model->insert($dataReqDemo);
                        $dataRequestDemo    = $this->Acc_request_model->get_by_id_join(intval($accRequestId));

                        //2. insert data into acc_demo
                        $dataAccDemo = array('acc_request_id'       => intval($accRequestId),
                            'acc_currency_id'       => $dataRequestDemo->acc_currency_id,
                            'acc_leverage_id'       => $dataRequestDemo->acc_leverage_id,
                            'nasabah_id'            => $dataRequestDemo->nasabah_id,
                            'acc_type_id'           => $dataRequestDemo->acc_type_id,
                            'deposit'               => $dataRequestDemo->deposit,
                            'no_akun'               => $accountNumber,
                            'password_trade'        => $masterPwd,
                            'password_investor'     => $investorPwd,
                            'ip'                    => 'TeknologiBerjangka-Demo',
                            'tanggal_buat_akun'     => date('Y-m-d h:i:s'),
                            'status_aktif'          => 'Aktif',
                            'user_id'               => 6);

                        $this->Acc_demo_model->insert($dataAccDemo);

                        // End transaction
                        $this->db->trans_complete();

                        if ($this->db->trans_status() === FALSE) {

                            /**
                             *
                             * Return Failed response
                             *
                             **/

                            $json['success'] = FALSE;
                            $json['alert']   = 'Request Akun Demo Gagal. Terjadi Kesalahan saat membuat akun.';
                            $json['data']    = array("Soegee"       => $restPD["response"],
                                "CI DB"         => $this->db->error(),
                                "transtatus"    => $this->db->trans_status());

                        } else {

                            /**
                             *
                             * Send Notif to Nasabah (email)
                             *
                             **/

                            $isi_email = ['nama'                => $dataRequestDemo->nama_lengkap,
                                'type'              => $dataRequestDemo->type,
                                'nama_currency'     => $dataRequestDemo->nama_currency,
                                'Leverage'          => $dataRequestDemo->nama_leverage,
                                'email'             => $dataRequestDemo->email,
                                'no_akun'           => $accountNumber,
                                'password_trade'    => $masterPwd,
                                'ip'                => $dataAccDemo['ip']];

                            $this->load->helper('send_email_helper');
                            $data_email['email'] = $dataRequestDemo->email;
                            $data_email['pesan'] = $this->getEmailBody($isi_email);
                            $data_email['subjek'] = 'Akun Demo yang anda request telah dikonfirmasi';
                            send_mailer($data_email);

                            //3. masuk ke log nasabah
                            $dataLog = array('nasabah_id'       => $this->session->userdata('cd_id'),
                                            'acc_request_id'    => $accRequestId,
                                            'type'              => 'Demo',
                                            'read_status'       => 'Y',
                                            'aktifitas'         => 'Membuat akun trading demo');

                            $this->Log_model->insert($dataLog);

                            /**
                             *
                             * Send Notif to Admin (email & w.a)
                             *
                             **/

                            // send whatsapp
                            $this->Rapiwha->send_fromAdmin('Notifikasi: Nasabah dengan akun ' . $this->session->userdata('nsb_email') . 'Membuka akun demo Baru.', 6);

                            // kirim email pemberitahuan ke Admin
                            $this->load->helper('send_email_helper');
                            $data_email['email'] = 'settlement@tifia.co.id';
                            $data_email['subjek'] = 'Pembukaan Akun Demo';
                            $data_email['pesan'] = 'Dear admin, Nasabah dengan akun ' . $this->session->userdata('nsb_email') . 'Membuat Akun Demo Baru.';
                            send_mailer($data_email);

                            /**
                             *
                             * Return Success response
                             *
                             **/

                            $json['success'] = TRUE;
                            $json['alert']   = 'Request Akun Demo Berhasil.';
                            $json['href']    = base_url() . 'kabinet';
                            $json['data']    = $restPD["response"];
                        }
                    } else {

                        /**
                         *
                         * Return Failed response
                         *
                         **/

                        $json['success'] = FALSE;
                        $json['alert']   = 'Request Akun Demo Gagal. Gagal menyimpan deposit. Silahkan coba lagi.';
                        $json['data']    = $restPD["response"];
                    }

                } else {

                    /**
                     *
                     * Return Failed response
                     *
                     **/

                    $json['success'] = FALSE;
                    $json['alert']   = 'Request Akun Demo Gagal';
                    $json['data']    = $restPA["response"];
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

                    /**
                     *
                     *  Create New Account in Meta
                     *
                     **/

                    $groups         = NULL;
                    $nasabah        = $this->Nasabah_model->getdata('nasabah_id', $this->session->userdata("cd_id"))->row_array();
                    $masterPwd	    = random_string('alnum', 7);
                    $investorPwd    = random_string('alnum', 7);
                    $phonePwd       = random_string('alnum', 7);
                    $leverageId     = $this->input->post('leverage', TRUE);
                    $dataLeverage   = $this->Acc_leverage_model->get_by_id($leverageId);

                    /*
                     *
                     * GROUPS
                     * In Developement mode:
                     * use "Test_Live_TFX"
                     *
                     * */
                     
                    //  $groups = "Test_Live_TFX"; //testing

                    switch ($this->input->post('type', TRUE)){
                        case "2":
                            $groups = "8600"; //ECN-GOLD
                            break;
                        case "3":
                            $groups = "8500"; //ECN-SILVER
                            break;
                        case "4":
                            $groups = "8700"; //ECN-PLATINUM
                            break;
                    }

                    $loginId        = $this->accountsservices->GenerateTradingLoginId($groups);

                    $body = array("login"                   => $loginId,
                                    "group"                 => "Test_Live_TFX",
                                    "enable"                => true,
                                    "enableChangePassword"  => true,
                                    "enableReadOnly"        => true,
                                    "enableOtp"             => true,
                                    "password"              => $masterPwd,
                                    "passwordInvestor"      => $investorPwd,
                                    "passwordPhone"         => $phonePwd,
                                    "name"                  => $this->session->userdata("nsb_nama"),
                                    "country"               => $nasabah["kewarganegaraan"],
                                    "city"                  => $nasabah["lokasi_rumah"],
                                    "state"                 => $nasabah["kewarganegaraan"],
                                    "address"               => $nasabah["alamat_rumah"],
                                    "phone"                 => $nasabah["no_hp"] ?: $nasabah["no_tlp"],
                                    "email"                 => $this->session->userdata("nsb_email"),
                                    "leverage"              => $dataLeverage->leverage);

                    $endpoint   = $this->endpoints->sogeeapi_real(Accounts::POST_ACCOUNT);
                    $restPA     = $this->restclient->requestPost($endpoint, $body);
                    $accountNumber  = json_decode($restPA["response"], true)["login"];

                    if ($restPA["code"] == 201){

                        /**
                         *
                         *  Insert into Kabinet
                         *
                         **/

                        //1. insert data into acc_request
                        $dataReqReal = array('nasabah_id'       => $this->session->userdata('cd_id'),
                                            'acc_leverage_id'   => $this->input->post('leverage', TRUE),
                                            'acc_type_id'       => $this->input->post('type', TRUE),
                                            'acc_currency_id'   => 2,
                                            'user_id'           => 6,
                                            'status_request'    => "Aktif");

                        $accRequestId       = $this->Acc_request_model->insert($dataReqReal);
                        $dataRequestReal    = $this->Acc_request_model->get_by_id_join(intval($accRequestId));

                        //2. insert data into acc_trading
                        $dataAccTrading = array('acc_request_id'       => intval($accRequestId),
                                                'acc_currency_id'       => $dataRequestReal->acc_currency_id,
                                                'acc_leverage_id'       => $dataRequestReal->acc_leverage_id,
                                                'nasabah_id'            => $dataRequestReal->nasabah_id,
                                                'acc_type_id'           => $dataRequestReal->acc_type_id,
                                                'no_akun'               => $accountNumber,
                                                'password_trade'        => $masterPwd,
                                                'password_investor'     => $investorPwd,
                                                'ip'                    => 'TeknologiBerjangka-Real',
                                                'tanggal_buat_akun'     => date('Y-m-d h:i:s'),
                                                'status_aktif'          => 'Aktif',
                                                'user_id'               => 6);

                        $this->Acc_trading_model->insert($dataAccTrading);

                        // End transaction
                        $this->db->trans_complete();

                        if ($this->db->trans_status() === FALSE) {

                            /**
                             *
                             * Return Failed response
                             *
                             **/

                            $json['success'] = FALSE;
                            $json['alert']   = 'Request akun perdagangan gagal';
                            $json['data']    = array("Soegee"       => $restPA["response"],
                                                    "CI DB"         => $this->db->error(),
                                                    "transtatus"    => $this->db->trans_status());
                        } else {

                            /**
                             *
                             * Send Notif to Nasabah (email)
                             *
                             **/

                            $isi_email = ['nama'                => $dataRequestReal->nama_lengkap,
                                            'type'              => $dataRequestReal->type,
                                            'nama_currency'     => $dataRequestReal->nama_currency,
                                            'Leverage'          => $dataRequestReal->nama_leverage,
                                            'email'             => $dataRequestReal->email,
                                            'no_akun'           => $accountNumber,
                                            'password_trade'    => $masterPwd,
                                            'ip'                => $dataAccTrading['ip']];

                            $this->load->helper('send_email_helper');
                            $data_email['email'] = $dataRequestReal->email;
                            $data_email['pesan'] = $this->getEmailBody($isi_email);
                            $data_email['subjek'] = 'Akun Demo yang anda request telah dikonfirmasi';
                            send_mailer($data_email);

                            //3. masuk ke log nasabah
                            $dataLog = array('nasabah_id'       => $this->session->userdata('cd_id'),
                                            'acc_request_id'    => $accRequestId,
                                            'type'              => 'Akun Trading Real',
                                            'read_status'       => 'Y',
                                            'aktifitas'         => 'Membuat Akun Trading Real');

                            $this->Log_model->insert($dataLog);


                            /**
                             *
                             * Send Notif to Admin (email & w.a)
                             *
                             **/

                            // send whatsapp
                            $this->Rapiwha->send_fromAdmin('Notifikasi: Nasabah dengan akun ' . $this->session->userdata('nsb_email') . 'Membuat Akun Trading Baru.', 6);

                            // kirim email pemberitahuan ke Admin
                            $this->load->helper('send_email_helper');
                            $data_email['email'] = 'settlement@tifia.co.id';
                            $data_email['subjek'] = 'Pembukaan Akun Real';
                            $data_email['pesan'] = 'Dear admin, Nasabah dengan akun ' . $this->session->userdata('nsb_email') . 'Membuat Akun Trading Baru.';
                            send_mailer($data_email);

                            /**
                             *
                             * Return Success response
                             *
                             **/

                            $json['success']    = true;
                            $json['alert']      = 'Request akun perdagangan berhasil.';
                            $json['href']       = base_url() . 'kabinet';
                            $json['data']       = $restPA["response"];
                        }

                    } else {

                        /**
                         *
                         * Return Failed response
                         *
                         **/

                        $json['success'] = FALSE;
                        $json['alert']   = 'Request Akun Demo Gagal. Silahkan Coba Lagi.';
                        $json['data']    = $restPA["response"];
                    }
                } else {

                    /**
                     *
                     * Return Failed response
                     *
                     **/

                    $json['success'] = FALSE;
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

            $endpoint = "";
            $no_akun = $this->input->post('no_akun');
            $jenis = $this->input->post('jenis');

            // cek apakah no_akun exist
            if ($no_akun) {
                if ($jenis == "demo"){
                    $endpoint = $this->endpoints->sogeeapi_demo(Accounts::GET_SINGLE_RECORD, $no_akun);
                } else {
                    $endpoint = $this->endpoints->sogeeapi_real(Accounts::GET_SINGLE_RECORD, $no_akun);
                }
                $rest = $this->restclient->requestGet($endpoint);

                if ($rest["code"] == 200){
                    $json['status'] = TRUE;
                } else {
                    $json['status'] = FALSE;
                }

                $json['data'] = ['response' => $rest["response"],
                                'prf' => 0 // Profitabilitas
                                ];
            } else {
                $json['status'] = FALSE;
            }

            header('Content-Type: application/json');
            echo json_encode($json);
        }
    }

    private function getEmailBody($data)
    {
        $msg = $this->load->view('template_email/email_account_real', ['user' => $data], true);

        return $msg;
    }
}
