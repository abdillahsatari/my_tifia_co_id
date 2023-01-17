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
                        <p><strong>Formulir Nomor 107.PBK.02.2</strong></p>
                        <div class="col-lg-12">
                            <p style="text-align: right;">Lampiran 2 Peraturan Kepala Badan Pengawas<br> Perdagangan Berjangka Komoditi<br> Nomor: 5/BAPPEBTI/PER/V/2018 </p>
                        </div>
                        <hr>
                         <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>: <?= $nasabah->nama_lengkap; ?></td>
                                </tr>
                               <tr>
                                    <td>Tempat Lahir</td>
                                    <td>: <?= $nasabah->tempat_lahir; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>: <?= $nasabah->tgl_lahir; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= $nasabah->alamat_rumah; ?></td>
                                </tr>
                                <tr>
                                    <td>Kode Pos</td>
                                    <td>: <?= $nasabah->kode_pos; ?></td>
                                </tr>
                                <tr>
                                    <td>No Identitas</td>
                                    <td>: <?= $nasabah->no_identitas; ?></td>
                                </tr>
                               <tr>
                                    <td>No Akun Demo</td>
                                    <td>: <?= $acc_demo[0]->no_akun ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <br><br><br>
                        <!-- pernyataan -->
                       <p align="center">Dengan mengisi kolom "Ya" di bawah ini, saya menyatakan bahwa saya telah memiliki pengalaman yang mencukupi dalam melaksanakan transaksi Perdagangan Berjangka karena pernah bertransaksi pada Perusahaan Pialang Berjangka PT. Tifia Finansial Berjangka, dan telah memahami tentang tata cara bertransaksi Perdagangan Berjangka.</p>
                        <p align="center"> Demikian Pernyataan ini dibuat dengan sebenarnya dalam keadaan sadar, sehat jasmani dan rohani serta tanpa paksaan apapun dari pihak manapun</p>
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
