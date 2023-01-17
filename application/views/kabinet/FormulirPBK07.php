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
                        <!-- isi FormulirPBK01 -->
                        <p><strong>Formulir Nomor 107.PBK.07</strong></p>
                        <div class="col-lg-12">
                            <p style="text-align: right;">Lampiran 2 Peraturan Kepala Badan Pengawas<br> Perdagangan Berjangka Komoditi<br> Nomor: 5/BAPPEBTI/PER/V/2018 </p>
                        </div>
                        <hr>
                        <p align="center"> <strong>PERNYATAAN BERTANGGUNG JAWAB ATAS</strong> </p> 
                        <p align="center"> <strong>KODE AKSES TRANSAKSI NASABAH (Personal Access Password)</strong> </p>
                        <hr>
                        <p>Yang mengisi formulir dibawah ini :</p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>: <?php echo $nasabah->nama_lengkap; ?></td>
                                </tr>
                               <tr>
                                    <td>Tempat/Tanggal Lahir</td>
                                    <td>: <?php echo $nasabah->tempat_lahir; ?> / <?php echo  date("d F Y", strtotime($nasabah->tgl_lahir)) ?> </td>
                                </tr>
                                <tr>
                                    <td>Alamat Rumah</td>
                                    <td>: <?php echo $nasabah->alamat_rumah; ?></td>
                                </tr>
                                <tr>
                                    <td>Kode Pos</td>
                                    <td>: <?php echo $nasabah->kode_pos; ?></td>
                                </tr>
                                <tr>
                                    <td>No Identitias</td>
                                    <td>: <?php echo $nasabah->no_identitas; ?></td>
                                </tr>
                            </tbody>
                        </table>
                                        
                        <br><br><br>
                            <!-- pernyataan -->
                            <p align="center"> Dengan mengisi kolom "YA" di bawah ini, saya menyatakan bahwa saya bertanggungjawab sepenuhnya terhadap kode akses transaksi Nasabah (Personal Access Password) dan tidak menyerahkan kode akses transaksi Nasabah (Personal Access Password) ke pihak lain, terutama kepada pegawai Pialang Berjangka atau pihak yang memiliki kepentingan dengan Pialang Berjangka.</p>
                            <p align="center">Pernyataan menerima / tidak </p>
                            <div class="col-lg" align="center">
                                <div class="m-radio-inline">
                                    <label class="m-radio">
                                        <input type="radio"> Ya
                                        <span></span>
                                    </label>
                                </div>
                            </div><br>
                            <p align="center">Menerima pada Tanggal <?= date("d F Y", strtotime($nasabah->update_date)) ?></p>

                        <!-- isi FormulirPBK01 -->
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
