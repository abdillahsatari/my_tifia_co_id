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
                        <!-- Bukti Konfirmasi -->
                        <p align="center">LAMPIRAN</p>                               
                        <p align="center">KETENTUAN DALAM PERATURAN KEPALA BADAN PENGAWAS PERDAGANGAN BERJANGKA KOMODITI NOMOR 5/BAPPEBTI/PER/V/2018</p>
                        <p align="center">TENTANG</p>
                        <p align="center">PERUBAHAN ATAS PERATURAN KEPALA BADAN PENGAWAS PERDAGANGAN BERJANGKA KOMODITI NOMOR 99/BAPPEBTI/PER/11/2012 TENTANG PENERIMAAN NASABAH SECARA ELEKTRONIK ON-LINE DI BIDANG PERDAGANGAN BERJANGKA KOMODITI</p>
                        <p align="center"><strong>BUKTI KONFIRMASI PENERIMAAN NASABAH</strong></p>     
                        <p align="center"><strong>PT. Tifia FINANSIAL BERJANGKA</strong></p>
                        <hr>
                       <p>Saya yang bertandatangan dibawah ini: 
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td>: Aan Rosana</td>
                                            </tr>
                                           <tr>
                                                <td>Pekerjaan/Jabatan</td>
                                                <td>: Wakil Pialang</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>:  International Financial Centre Tower 2 Lantai 19 Jl. Jend. Sudirman, Kav. 22-23, Setiabudi - Jakarta Selatan</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                        <p>Dalam hal ini bertindak untuk dan atas nama <strong>PT. Tifia Finansial Berjangka</strong></p>
                                        <br><br>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td>: </td>
                                                <td><?= $user->nama_lengkap ?></td>
                                            </tr>
                                           <tr>
                                                <td>Pekerjaan/Jabatan</td>
                                                <td>: </td>
                                                <td><?= $user->pekerjaan ?>/<?= $user->jabatan ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>: </td>
                                                <td><?= $user->alamat_rumah ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p>
                                    <br>
                                    <p align="justify">Bahwa Bapak/Ibu <?= $user->nama_lengkap ?> telah resmi menjadi Nasabah PT. Tifia Finansial Berjangka sejak tanggal <?= date("d F Y", strtotime($user->tanggal_buat_akun)) ?> dengan nomor account <?= $noacc ?> berdasarkan Perjanjian Pemberian Amanat yang Bapak/Ibu <?= $user->nama_lengkap ?> telah isi dan setujui berdasarkan ketentuan Peraturan Kepala Bappebti Nomor 99/BAPPEBTI/PER/11/2012 tentang Penerimaan Nasabah Secara Elektronik On-Line Di Bidang Perdagangan Berjangka Komoditi sebagaimana telah diubah dengan Peraturan Kepala Bappebti Nomor 5/BAPPEBTI/PER/V/2018, serta telah mengisi dan menyetujui dokumen sebagai berikut:</p>
                                    <br>
                                    <p align="left">1) Pernyataan Telah Melakukan Simulasi Perdagangan Berjangka;</p>
                                    <p align="left">2) Pernyataan Telah Berpengalaman Dalam Melaksanakan Transaksi Perdagangan Berjangka;</p>
                                    <p align="left">3) Profil Nasabah dan aplikasi pembukaan rekening;</p>
                                    <p align="left">4) Dokumen Pemberitahuan Adanya Risiko;</p>
                                    <p align="left">5) Perjanjian Pemberian Amanat;</p>
                                    <p align="left">6) Peraturan Perdagangan (trading rules);dan</p>
                                    <p align="left">7) Pernyataan Dari Nasabah Untuk Tidak Menyerahkan Kode Akses Transaksi Nasabah (Personal Access Password)Ke Pihak Lain.</p>
                                    <br>
                                    <p>Dengan <strong>membaca, mengisi dan menyetujui dokumen</strong> sebagaimana dimaksud di atas, dengan demikian Bapak/Ibu <?= $user->nama_lengkap ?> telah:</p>

                                    <p align="left">1. Memahami dan mengerti resiko-resiko yang ada, termasuk kerugian atas seluruh dana yang disetor;</p>
                                    <p align="left">2. Memahami kewajiban dan hak selaku Nasabah Pialang Berjangka;</p>
                                    <p align="left">3. Memahami dan Mengerti mekanisme dan cara Perdagangan Berjangka;</p>
                                    <p align="left">4. Memahami untuk tidak membuat perjanjian dalam bentuk apapun baik secara lisan maupun tertulis dengan pegawai Pialang Berjangka atau pihak yang memiliki kepentingan dengan Pialang Berjangka diluar Perjanjian Perdagangan Berjangka dan peraturan perdagangan (trading rules) antara Nasabah dengan PT. Tifia Finansial Berjangka </p>
                                    <p align="left">5. Memahami untuk bertanggungjawab sepenuhnya dan tidak menyerahkan nama pengguna (user id) dan kode akses transaksi Nasabah (Personal Access Password), ke pihak lain, terutama kepada pegawai Pialang Berjangka atau pihak yang memiliki kepentingan dengan Pialang Berjangka;</p>
                                    <p align="left">6. Melakukan simulasi atau mengerti mekanisme transaksi Perdagangan Berjangka;</p>
                                    <p align="left">7. Memahami mengenai peraturan perdagangan (trading rules) antara Nasabah dengan PT. Tifia Finansial Berjangka;</p>
                                    <p align="left">8. Memahami tentang mekanisme penggunaan Rekening Terpisah (segregated account), termasuk penyetoran da penarikan dana, yakni akun keluar masuk dana wajib sama dengan akun yang didaftarkan dalam aplikasi pembukaan rekening, dan pelakasanaannya wajib dilakukan melalui pindah buku/ transfer, serta prosedur penarikan dana; dan </p>
                                    <p align="left">9. Memahami dana yang dipergunakan dalam bertransaksi adalah dana milik pribadi, bukan dari dan/atau milik pihak lain, atau berasal dari pencucian uang.</p>
                                    <p align="justify">Data yang kami terima dari Bapak/Ibu <?= $user->nama_lengkap ?> akan kami rekam dan catat, dan sepenuhnya menjadi milik PT. Tifia Finansial Berjangka. Kami bertanggung jawab untuk menjaga kerahasiaan data dan informasi Bapak/Ibu <?= $user->nama_lengkap ?> esuai dengan Peraturan Perundang-Undangan.</p>
                                    <table class="table" border="1">
                                        <tbody>
                                            <tr>
                                                <td>Verifikator</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Mengetahui</td>
                                            </tr>
                                             <tr>
                                                <td>Wakil Pialang</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>Direktur Utama PT. Tifia Finansial Berjangka,</td>
                                            </tr>   
                                              <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>  
                                            <tr>
                                                <td><strong>(AAN ROSANA)</strong></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><strong>(JUNAIDI ROPARULIAN SIMANJUNTAK)</strong></td>
                                            </tr>    
                                        </tbody>
                                    </table>
                                        
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
