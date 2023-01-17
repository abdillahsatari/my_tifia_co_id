 <!-- BEGIN: Subheader -->
   <!--  <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">Dashboard</h3>
            </div>
           
        </div>
    </div> -->

<!-- END: Subheader -->
<div class="m-subheader ">
  
    <div class="row ui-sortable" id="m_sortable_portlets">
        <div class="col-lg">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                            
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                        <!-- isi FormulirPBK02.2 -->
                        <p><strong>Formulir Nomor 107.PBK.03</strong></p>
                        <div class="col-lg-12">
                            <p style="text-align: right;">Lampiran 2 Peraturan Kepala Badan Pengawas<br> Perdagangan Berjangka Komoditi<br> Nomor: 5/BAPPEBTI/PER/V/2018 </p>
                        </div>
                        <hr>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-md-6">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Nama Lengkap</td>
                                                <td>: <?php echo $user->nama_lengkap; ?></td>
                                            </tr>
                                           <tr>
                                                <td>Tempat Lahir</td>
                                                <td>: <?php echo $user->tempat_lahir; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td>: <?php echo $user->tgl_lahir; ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Identitias</td>
                                                <td>: <?php echo $user->no_identitas; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Pengalaman Investasi</td>
                                                <td>: Ya</td>
                                            </tr>
                                            <tr>
                                                <td>Tujuan Pembukaan Rekening</td>
                                                <td>: <?php echo $user->tujuan_pembukaan_rek; ?></td>
                                            </tr>
                                           <tr>
                                                <td>NPWP</td>
                                                <td>: <?php echo $user->no_npwp; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>: <?php echo $user->gender; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status Perkawainan</td>
                                                <td>: <?php echo $user->status_kawin; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Suami/Istri</td>
                                                <td>: <?php echo $user->nama_pasangan; ?></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <hr>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Nama Ibu Kandung</td>
                                                <td>:  <?php echo $user->nama_ibu; ?></td>
                                            </tr>
                                           <tr>
                                                <td>Alamat Rumah</td>
                                                <td>: <?php echo $user->alamat_rumah; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kewarganegaraan</td>
                                                <td>: <?php echo $user->kewarganegaraan; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kode Pos</td>
                                                <td>: <?php echo $user->kode_pos; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Status Kepemilikan Rumah</td>
                                                <td>:<?php echo $user->status_rumah; ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Tlp Handphone</td>
                                                <td>: <?php echo $user->no_hp; ?></td>
                                            </tr>
                                           <tr>
                                                <td>No Faksimili</td>
                                                <td>: <?php echo $user->no_faksimili; ?></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                        <hr>    
                         <div class="row">
                            <div class="col-lg-12">
                                <div class="col-md-6">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Apakah Anda Memiliki anggota keluarga yang bekerja di BAPPEBTI/Bursa Berjangka/Kliring Berjangka?</td>
                                                <td>:  <?php echo $user->keluarga_bapepti; ?></td>
                                            </tr>
                                           <tr>
                                                <td>Apakah Anda dinyatakan pailit oleh pengadilan?</td>
                                                <td>: Tidak</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <hr>    
                                    <p><strong>PIHAK YANG DIHUBUNGI DALAM KEADAAN DARURAT</strong></p>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td>: <?php echo $user->nama_rekan; ?></td>
                                            </tr>
                                           <tr>
                                                <td>No Telepon</td>
                                                <td>: <?php echo $user->telepon_rekan; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Hubungan</td>
                                                <td>: <?php echo $user->hubungan_rekan; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>: <?php echo $user->alamat_rekan; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kode Pos</td>
                                                <td>: <?php echo $user->kode_pos_rekan; ?></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <hr>  
                                    <p> <strong>DATA PEKERJAAN</strong></p>  
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Pekerjaan </td>
                                                <td>: <?php echo $user->pekerjaan; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Perusahaan</td>
                                                <td>: <?php echo $user->nama_perusahaan; ?></td>
                                            </tr>
                                           <tr>
                                                <td>Bidang Usaha</td>
                                                <td>: <?php echo $user->bidang_usaha; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jabatan</td>
                                                <td>: <?php echo $user->jabatan; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Lama Kerja</td>
                                                <td>: <?php echo $user->lama_kerja; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kantor Sebelumnya</td>
                                                <td>: <?php echo $user->kantor_sebelumnya; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Kantor</td>
                                                <td>: <?php echo $user->alamat_kantor; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kode Pos</td>
                                                <td>:  <?php echo $user->kode_pos_kantor; ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Telp Kantor</td>
                                                <td>:  <?php echo $user->telepon_kantor; ?></td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                    <hr>
                                    <p><strong>DAFTAR KEKAYAAN</strong></p>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Penghasilan Per Tahun </td>
                                                <td>: <?php echo $user->pendapatan_pertahun; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Lokasi Rumah</td>
                                                <td>: <?php echo $user->lokasi_rumah; ?></td>
                                            </tr>
                                           <tr>
                                                <td>Nilai NJOP</td>
                                                <td>: <?php echo $user->njob; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Deposit Bank</td>
                                                <td>: <?php echo $user->deposit_bank; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah </td>
                                                <td>: <?php echo $user->jumlah_kekayaan; ?></td>
                                            </tr>
                                            <tr>
                                                <td>lainnya</td>
                                                <td>: <?php echo $user->kekayaan_lainnya; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <p><strong>REKENING BANK NASABAH UNTUK PENYETORAN DAN PENARIKAN MARGIN (IDR)</strong></p>
                                    <table class="table">

                                        <tbody>
                                            <tr>
                                                <td>Nama Bank </td>
                                                <td>: <?php echo $bank_idr[0]->nama_bank; ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Rekening </td>
                                                <td>: <?php echo $bank_idr[0]->no_rekening; ?></td>
                                            </tr>
                                           <tr>
                                                <td>Cabang </td>
                                                <td>: <?php echo $bank_idr[0]->cabang; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Swift Code</td>
                                                <td>: <?php echo $bank_idr[0]->kode_bank; ?></td>
                                            </tr>
                                            <tr>
                                                <td>No Tlp</td>
                                                <td>: <?php echo $bank_idr[0]->telepon_bank; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Atas Nama</td>
                                                <td>: <?php echo $bank_idr[0]->atas_nama; ?></td>
                                            </tr>
                                             <tr>
                                                <td>Jenis Rekening</td>
                                                <td>: <?php echo $bank_idr[0]->jenis_rekening; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                  
                                    <hr>
                                    <p><strong>LAMPIRAN DOKUMEN</strong></p>
                                     <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Photo Terkni </td>
                                                <td><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" class="img-thumbnail"></td>
                                            </tr>
                                            <tr>
                                                <td>KTP/SIM/Passport </td>
                                                <td><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" class="img-thumbnail"></td>
                                            </tr>
                                           <tr>
                                                <td>Cover depan buku tabungan yang terdapat nama dan NPWP </td>
                                                <td><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" class="img-thumbnail"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                               
                            </div>
                        </div>
                        
                        <br><br><br>
                        <!-- pernyataan -->
                       <p align="center">Dengan mengisi kolom "Ya" di bawah ini, saya menyatakan bahwa semua informasi dan semua dokumen yang saya lampirkan dalam APLIKASI PEMBUKAAN REKENING TRANSAKSI SECARA ELEKTRONIK ON-LINE adalah benar dan tepat. Saya akan bertanggung jawab penuh apabila dikemudian hari terjadi sesuatu hal sehubungan dengan ketidakbenaran data yang saya berikan.</p>
                        <p align="center">Pernyataan menerima / tidak </p>
                            <div class="col-lg" align="center">
                                <div class="m-radio-inline">
                                    <label class="m-radio">
                                        <input type="radio"> Ya
                                        <span></span>
                                    </label>
                                </div>
                            </div><br>
                        <p align="center">Menerima pada Tanggal <?= date("d F Y", strtotime($user->tanggal_buat_akun)) ?></p>
                        <!-- isi FormulirPBK02.2 -->
                        </div>
                       
                    </div>

                    <!--end::Section-->
                </div>  
                <!--  -->

                <!--  -->
            </div>
            <!--end::Portlet-->

        </div>
    </div>
</div>        
<!-- end:: Body -->
