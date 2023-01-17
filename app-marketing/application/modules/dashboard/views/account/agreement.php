<!-- END: Subheader -->
<div class="m-subheader">


    <?= $this->session->flashdata('message') ?>


    <div class="m-portlet m-portlet--tab">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h2 class="m-portlet__head-text">
                        Pengisian Nota Kesepakatan Kerjasama Kegiatan Pemasaran
                    </h2>
                </div>
            </div>
        </div>

        
        <div class="m-wizard m-wizard--2 m-wizard--success">

            <div class="m-wizard__head m-portlet__padding-x">



                <!--begin: Form Wizard Progress -->

                <!-- <div class="m-wizard__progress">

                    <div class="progress">

                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>

                    </div>

                </div> -->



                <!--end: Form Wizard Progress -->



                <!--begin: Form Wizard Nav -->

                <div class="m-wizard__nav">

                    <div class="m-wizard__steps">

                        <div class="m-wizard__step m-wizard__step--current" id="step_1">

                            <a href="#" class="m-wizard__step-number">
                                <span><i class="fa fa-info-circle"></i></span>
                            </a>

                            <div class="m-wizard__step-info">
                                <div class="m-wizard__step-desc">
                                    Personal Information
                                </div>
                            </div>

                        </div>


                        <div class="m-wizard__step" id="step_2">

                            <a href="#" class="m-wizard__step-number">
                                <span><i class="fa fa-info-circle"></i></span>
                            </a>

                            <div class="m-wizard__step-info">
                                <div class="m-wizard__step-desc">
                                    Agreement & Rule
                                </div>
                            </div>

                        </div>


                        <div class="m-wizard__step" id="step_3">

                            <a href="#" class="m-wizard__step-number">
                                <span><i class="fa fa-info-circle"></i></span>
                            </a>

                            <div class="m-wizard__step-info">
                                <div class="m-wizard__step-desc">
                                    Bank Information
                                </div>
                            </div>

                        </div>


                        <div class="m-wizard__step" id="step_4">

                            <a href="#" class="m-wizard__step-number">
                                <span><i class="fa fa-info-circle"></i></span>
                            </a>

                            <div class="m-wizard__step-info">
                                <div class="m-wizard__step-desc">
                                    Document Upload
                                </div>
                            </div>

                        </div>


                    </div>

                </div>


            </div>

            <hr>

            <div class="m-wizard__form">

                <div class="m-wizard__form-step m-wizard__form-step--current" id="page_1">

                    <div class="m-portlet__body">

                        <form action="<?= base_url() ?>dashboard/account/editProfile_action" method="POST" class="form" data-current_page="1">

                            <p align="center" class="mb-5"><strong>PERSONAL INFORMATION</strong><br /></p>

                            <input type="hidden" name="id" id="id" value="<?= $data['id'] ?>">
                            <input type="hidden" name="kode" id="kode" value="<?= $data['kode'] ?>">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="date">Nomor</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="kode" value="<?= $data['kode'] ?>" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="nama">Nama*</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="nama" id="nama" nama type="text" value="<?= $data['nama'] ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="email">E-mail*</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="email" id="email" type="email" value="<?= $data['email'] ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="no_hp">No. HP*</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="no_hp" id="no_hp" type="text" value="<?= $data['no_hp'] ?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="tempat_lahir">Tempat/tanggal Lahir</label>
                                <div class="col-sm-5">
                                    <input class="form-control" name="tempat_lahir" id="tempat_lahir" type="text" value="<?= $data['tempat_lahir'] ?>">
                                </div>
                                <div class="col-sm-5">
                                    <div class="input-group date">

                                        <input type="text" data-date-format="yyyy-mm-dd" class="form-control m-input datepicker" name="tanggal_lahir" id="m_datepicker_3" value="<?= $data['tanggal_lahir'] ?>" />
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="jk">Jenis Kelamin*</label>
                                <div class="col-sm-10">
                                    <select name="jk" id="jk" class="form-control">
                                        <option value="L" <?= ($data['jenis_kelamin'] == 'L' ? 'selected' : '') ?>>Pria</option>
                                        <option value="P" <?= ($data['jenis_kelamin'] == 'P' ? 'selected' : '') ?>>Wanita</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="status">Status*</label>
                                <div class="col-sm-10">
                                    <select name="status" id="status" class="form-control">
                                        <option value="Lajang" <?= ($data['status'] == 'Lajang' ? 'selected' : '') ?>>Lajang</option>
                                        <option value="Menikah" <?= ($data['status'] == 'Menikah' ? 'selected' : '') ?>>Menikah</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="pendidikan">Pendidikan*</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="pendidikan" id="pendidikan" type="text" value="<?= $data['pendidikan'] ?>">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="alamat">Alamat*</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="alamat" id="alamat" type="text" value="<?= $data['alamat'] ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Provinsi*</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="provinsi" id="provinsi">
                                        <option value="">-- Pilih Provinsi --</option>
                                        <?php
                                        $provinsi = $this->db->get("wil_provinsi")->result();
                                        foreach ($provinsi as $prov) : ?>
                                            <option value="<?= $prov->id ?>" <?= ($data['id_provinsi'] == $prov->id ? 'selected' : '') ?>><?= $prov->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kabupaten / kota*</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kabupaten" id="kabupaten">
                                        <?= tampilkan_wilayah("wil_kabupaten", ["province_id" => $data['id_provinsi']], $data['id_kabupaten']) ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kecamatan*</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kecamatan" id="kecamatan">
                                        <?= tampilkan_wilayah("wil_kecamatan", ["regency_id" => $data['id_kabupaten']], $data['id_kecamatan']) ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kelurahan*</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kelurahan" id="kelurahan">
                                        <?= tampilkan_wilayah("wil_kelurahan", ["district_id" => $data['id_kecamatan']], $data['id_kelurahan']) ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg text-center mt-5">

                                <button class="btn btn-primary" type="submit" id="submit_1">Simpan dan Lanjutkan <i class="fa fa-arrow-right"></i></button>

                            </div><br>

                        </form>

                    </div>

                </div>

                <div class="m-wizard__form-step" id="page_2">

                    <div class="m-portlet__body">

                        <form action="<?= base_url() ?>dashboard/account/agreement_action" method="POST" class="form" data-current_page="2">

                            <p align="center"><strong>AGREEMENT & RULES</strong><br /></p>

                            <!-- <hr> -->

                            <p align="center">
                                antara<br>
                                WARGIANTO<br>
                                <i>Wakil Pialang Berjangka PT Teknologi Finansial Berjangka</i><br>
                                dan<br>
                                <?= strtoupper($data['nama']) ?><br>
                                <i><?= strtoupper($data['role']) ?></i>
                            </p>

                            <div class="row">

                                <div class="col-md-12">
                                    <p align="justify">Kedua belah pihak sepakat untuk membuat Nota Kesepakatan Kerjasama Kegiatan Pemasaran dengan rincian sebagai berikut:</p>
                                </div>

                                <div class="col-md-1">

                                    <p align="right"><strong>I.</strong></p>

                                </div>

                                <div class="col-md-11">

                                    <p align="justify">
                                        <strong>Jangka Waktu</strong><br>
                                        Kerjasama Kegiatan Pemasaran berlangsung selama 3 (tiga) bulan mulai dari Nota Kesepakatan disetujui oleh MITRA.<br>
                                        Setelah 3 bulan, Nota Kesepakatan ini dapat:
                                    </p>
                                    <ol type="a">
                                        <li>Diakhiri jika kinerja MITRA dinilai berada di bawah standar Management, dengan pemberitahuan secara tertulis 1 hari sebelumnya. </li>
                                        <li>Diperpanjang secara otomatis selama 3 (tiga) bulan berikutnya atas pertimbangan dari Management.</li>
                                    </ol>

                                    <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>

                                </div>



                                <div class="col-md-1">

                                    <p align="right"><strong>II.</strong></p>

                                </div>

                                <div class="col-md-11">

                                    <p align="justify">
                                        <strong>Dasar, Tujuan dan Keterikatan kedua Belah Pihak</strong>
                                    </p>
                                    <ol type="a">
                                        <li>Kerjasama ini diselenggarakan atas dasar kebutuhan dan manfaat dari kedua belah pihak secara timbal balik atas dasar sama derajat dan saling menghormati sesuai dan dalam batas kedudukan dan kewenangan masing-masing sesuai dengan peraturan perundang-undangan yang berlaku.</li>
                                        <li>Nota Kesepakatan ini mengatur Kerjasama kedua belah pihak dalam melakukan Kegiatan Pemasaran melalui media sosial, iklan, internet online, maupun konvensional dalam mencari calon nasabah yang memenuhi persyaratan untuk ikut serta dalam Perdagangan Berjangka, kemudian memperkenalkan calon nasabah kepada Wakil Pialang Berjangka PT Teknologi Finansial Berjangka.</li>
                                        <li>Nota Kesepakatan ini bukan Kontrak Kerja sehingga tidak ada hubungan perusahaan-karyawan antara kedua belah pihak.</li>
                                    </ol>

                                    <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>

                                </div>



                                <div class="col-md-1">

                                    <p align="right"><strong>III.</strong></p>

                                </div>

                                <div class="col-md-11">

                                    <p align="justify"><strong>Tanggung Jawab MITRA</strong></p>

                                    <ol type="1">
                                        <li>MITRA bertanggung jawab atas semua aktifitas yang dilakukannya dengan menggunakan nama Perusahaan dan/atau atribut lain yang berhubungan dengan Perusahaan.</li>
                                        <li>Berpakaian kerja formal (Formal Business attire) sewaktu hadir di perusahaan.</li>
                                        <li>Mematuhi segala peraturan dan tata tertib yang ditentukan perusahaan.</li>
                                        <li>MITRA wajib memasukkan daftar calon nasabah pada sistem pelaporan yang ditetapkan sejumlah yang disepakati per bulan.</li>
                                        <li>MITRA wajib memberikan laporan atas aktifitas harian yang dilakukan (contacting, appointment, follow up calon nasabah) pada sistem pelaporan yang ditetapkan.</li>
                                        <li>MITRA wajib mematuhi semua peraturan perundangan (Compliance Law) seperti yang telah ditentukan oleh BAPPEBTI selaku otoritas Perdagangan Berjangka.</li>
                                        <li>MITRA wajib untuk :
                                            <ol type="a">
                                                <li>Mengetahui dan memahami Prinsip Know Your Customer</li>
                                                <li>Memastikan bahwa nasabah memahami Risk Disclosure</li>
                                            </ol>
                                        </li>
                                        <li>MITRA dilarang untuk :
                                            <ol type="a">
                                                <li>Menjanjikan dan atau menjamin Keuntungan dalam Perdagangan Berjangka kepada Nasabah dan Calon Nasabah.</li>
                                                <li>Menawarkan Skema Fixed Income/Fixed Return.</li>
                                                <li>Menginstruksikan Nasabah dan calon Nasabah untuk mentransfer dana ke rekening selain Bank Account Segregated Perusahaan seperti yang tercantum dalam Perjanjian</li>
                                                <li>Menerbitkan Client Statement untuk nasabah atas nama Perusahaan</li>
                                            </ol>
                                        </li>
                                    </ol>

                                    <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>

                                </div>



                                <div class="col-md-1">

                                    <p align="right"><strong>IV.</strong></p>

                                </div>

                                <div class="col-md-11">

                                    <p align="justify"><strong>Target</strong> <br></p>
                                    <ol type="a">
                                        <li>Net Margin In atau jumlah transaksi seperti tertera dalam Lampiran, atau</li>
                                        <li>Daftar calon nasabah dan laporan aktifitas harían seperti tertera dalam Lampiran.</li>
                                    </ol>

                                    <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>

                                </div>



                                <div class="col-md-1">

                                    <p align="right"><strong>V.</strong></p>

                                </div>

                                <div class="col-md-11">

                                    <p align="justify"><strong>Kompensasi</strong></p>

                                    <ol type="a">
                                        <li>Kepada MITRA akan diberikan kompensasi berupa Tunjangan bulanan, komisi atas transaksi yang dilakukan oleh Nasabah yang direkrut olehnya dan bonus seperti tertera dalam Lampiran.</li>
                                        <li>Tunjangan, Komisi dan bonus dibayarkan paling lambat pada Hari Kerja ke-5 bulan berikutnya.</li>
                                    </ol>

                                    <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>

                                </div>



                                <div class="col-md-1">

                                    <p align="right"><strong>VI.</strong></p>

                                </div>

                                <div class="col-md-11">

                                    <p align="justify"><strong>Berakhirnya Nota Kesepakatan sebelum jangka waktu</strong></p>

                                    <ol type="1">
                                        <li>Nota Kesepakatan akan berakhir dengan sendirinya jika MITRA mengundurkan diri dengan menyampaikan Surat Pengunduran Diri, meninggal dunia, atau menderita cacat tetap total.</li>
                                        <li>Nota Kesepakatan juga dapat diakhiri sebelum jangka waktunya dengan pemberitahuan tertulis jika MITRA:
                                            <ol type="a">
                                                <li>Tidak jujur, menyalahgunakan wewenang dan tanggung jawab yang diberikan.</li>
                                                <li>Melanggar ketentuan yang ditetapkan oleh perusahaan ataupun pemerintah.</li>
                                                <li>Melakukan tindak pidana, kekerasan, minum-minuman keras, asusila dan tindakan lain yang melanggar hukum.</li>
                                            </ol>
                                        </li>
                                    </ol>

                                    </ol>

                                    <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>

                                </div>



                                <div class="col-md-1">

                                    <p align="right"><strong>VII.</strong></p>

                                </div>

                                <div class="col-md-11">

                                    <p align="justify"><strong>Tanggal Effektif </strong><br>
                                        Nota kesepakatan ini berlaku efektif setelah disetujui oleh kedua belah pihak.
                                        Dengan memberikan persetujuan atas Nota Kesepakatan ini, Kedua belah pihak menyatakan menerima atas isi yang ada di dalamnya.
                                    </p>
                                    <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>

                                </div>

                                <div class="col-md-12">

                                    <p align="right"><strong>Check all</strong><label class="m-checkbox m-checkbox--square"><input class="check_all" type="checkbox" id="" name="check_all" value="1"> <span></span></label></p>

                                </div>

                            </div><!--  end-row -->

                            <!-- end point-point pemberitahuan adanya resiko -->

                            <br><br>

                            <p align="center">
                                <strong>PERNYATAAN MENERIMA<br>NOTA KESEPAKATAN KERJASAMA KEGIATAN PEMASARAN</strong>
                            </p>

                            <p align="center">Dengan mengisi kolom “YA” di bawah ini, saya menyatakan bahwa telah menerima </p>

                            <p align="center"><strong>NOTA KESEPAKATAN<br>KERJASAMA KEGIATAN PEMASARAN</strong></p>

                            <p align="center">Mengerti dan juga menyetujui isinya</p>



                            <p align="center" class="text-danger font-weight-bold">Pernyataan menerima / tidak </p>

                            <div class="col-lg text-center">

                                <div class="m-radio-inline">

                                    <label class="m-radio text-danger font-weight-bold">

                                        <input type="radio" name="accept" id="radio-yes" class="radioo" value="1" required> Ya

                                        <span></span>

                                    </label>

                                    <label class="m-radio text-danger font-weight-bold">

                                        <input type="radio" name="accept" id="radio-no" class="radioo" value="0"> Tidak

                                        <span></span>

                                    </label>

                                </div>

                                <p align="center" class="text-danger font-weight-bold">Menerima pada tanggal <?= date_tampil(new_date()) ?></p>

                                <button class="btn btn-primary btn-next" id="submit_2" style="display: none;">Simpan dan Lanjutkan <i class="fa fa-arrow-right"></i></button>

                            </div><br>

                        </form>


                    </div>

                </div>

                <div class="m-wizard__form-step" id="page_3">

                    <div class="m-portlet__body">

                        <form action="<?= base_url() ?>dashboard/account/editBank_action" method="POST" id="form" class="form" data-current_page="3">

                            <p align="center" class="mb-5"><strong>BANK INFORMATION</strong><br /></p>

                            <input type="hidden" name="id" id="id" value="<?= $data['id'] ?>">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="rekening_nama">Nama pemilik rekening*</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="rekening_nama" id="rekening_nama" type="text" value="<?= $data['rekening_nama'] ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="rekening_bank">Bank*</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="rekening_bank" id="rekening_bank" type="text" value="<?= $data['rekening_bank'] ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="rekening_nomor">Nomor rekening*</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="rekening_nomor" id="rekening_nomor" type="text" value="<?= $data['rekening_nomor'] ?>">
                                </div>
                            </div>


                            <div class="col-lg text-center mt-5">

                                <button class="btn btn-primary" type="submit" id="submit_3">Simpan dan Lanjutkan <i class="fa fa-arrow-right"></i></button>

                            </div><br>

                        </form>


                    </div>

                </div>

                <div class="m-wizard__form-step" id="page_4">

                    <div class="m-portlet__body">

                        <form action="<?= base_url() ?>dashboard/account/editBank_action" method="POST"  class="form" data-current_page="4">

                            <p align="center" class="mb-5"><strong>DOCUMENT UPLOAD</strong><br /></p>

                            <div class="form-group row up_file_foto">
                                <label class="col-sm-4" for="file_foto">Foto diri terbaru* <small>Max. 1MB (png/jpg/jpeg)</small> </label>
                                <div class="col-sm-4">
                                    <input name="file_foto" id="file_foto" type="file" accept="image/x-png,image/jpg,image/jpeg" class="file_up" data-field="file_foto">
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    if ($data['file_foto'] != '') {
                                    ?>
                                        <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_foto'] ?>">Lihat file</a>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="text-danger text-left">Belum ada file</span>
                                    <?php
                                    } ?>
                                </div>
                            </div>

                            <div class="form-group row up_file_ktp">
                                <label class="col-sm-4" for="file_ktp">Foto KTP* <small>Max. 1MB (png/jpg/jpeg)</small> </label>
                                <div class="col-sm-4">
                                    <input name="file_ktp" id="file_ktp" type="file" accept="image/x-png,image/jpg,image/jpeg" class="file_up" data-field="file_ktp">
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    if ($data['file_ktp'] != '') {
                                    ?>
                                        <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_ktp'] ?>">Lihat file</a>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="text-danger text-left">Belum ada file</span>
                                    <?php
                                    } ?>
                                </div>
                            </div>

                            <div class="form-group row up_file_cv">
                                <label class="col-sm-4" for="file_cv">CV* <small>Max. 2MB (pdf/word)</small> </label>
                                <div class="col-sm-4">
                                    <input name="file_cv" id="file_cv" type="file" class="file_up" data-field="file_cv">
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    if ($data['file_cv'] != '') {
                                    ?>
                                        <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_cv'] ?>">Lihat file</a>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="text-danger text-left">Belum ada file</span>
                                    <?php
                                    } ?>
                                </div>
                            </div>

                            <div class="form-group row up_file_ijazah">
                                <label class="col-sm-4" for="file_ijazah">Ijazah <small>Max. 1MB (png/jpg/jpeg)</small> </label>
                                <div class="col-sm-4">
                                    <input name="file_ijazah" id="file_ijazah" type="file" accept="image/x-png,image/jpg,image/jpeg" class="file_up" data-field="file_ijazah">
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    if ($data['file_ijazah'] != '') {
                                    ?>
                                        <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_ijazah'] ?>">Lihat file</a>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="text-danger text-left">Belum ada file</span>
                                    <?php
                                    } ?>
                                </div>
                            </div>

                            <div class="form-group row up_file_sertifikat_1">
                                <label class="col-sm-4" for="file_sertifikat_1">Sertifikat <small>Max. 1MB (png/jpg/jpeg)</small> </label>
                                <div class="col-sm-4">
                                    <input name="file_sertifikat_1" id="file_sertifikat_1" type="file" accept="image/x-png,image/jpg,image/jpeg" class="file_up" data-field="file_sertifikat_1">
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    if ($data['file_sertifikat_1'] != '') {
                                    ?>
                                        <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_sertifikat_1'] ?>">Lihat file</a>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="text-danger text-left">Belum ada file</span>
                                    <?php
                                    } ?>
                                </div>
                            </div>

                            <div class="form-group row up_file_sertifikat_2">
                                <label class="col-sm-4" for="file_sertifikat_2">Sertifikat <small>Max. 1MB (png/jpg/jpeg)</small> </label>
                                <div class="col-sm-4">
                                    <input name="file_sertifikat_2" id="file_sertifikat_2" type="file" accept="image/x-png,image/jpg,image/jpeg" class="file_up" data-field="file_sertifikat_2">
                                </div>
                                <div class="col-sm-4">
                                    <?php
                                    if ($data['file_sertifikat_2'] != '') {
                                    ?>
                                        <a href="#" class="text-success text-left lihat_file" data-href="<?= $data['file_sertifikat_2'] ?>">Lihat file</a>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="text-danger text-left">Belum ada file</span>
                                    <?php
                                    } ?>
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary" id="submit_4">Selesai <i class="fa fa-check"></i></button>
                                <br>
                            </div>

                        </form>


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<script src="<?= base_url() ?>assets/wilayah-administratif.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // form
        $(document).on('submit', '.form', function(e) {
            e.preventDefault();

            var me = $(this);

            current_page = me.data('current_page');
            next_page = current_page + 1;

            $("#submit_" + current_page).prop('disabled', true).html('<i class="fas fa-circle-notch fa-spin"></i>');
            $.ajax({
                url: me.attr('action'),
                type: 'post',
                data: new FormData(this),
                contentType: false,
                cache: false,
                dataType: 'JSON',
                processData: false,
                success: function(json) {
                    if (json.form_validation == true) {

                        if (json.success == true) {

                            $.toast({
                                heading: 'Success',
                                text: json.alert,
                                position: 'top-right',
                                textAlign: 'left',
                                hideAfter: 2500,
                                icon: 'success',
                                afterHidden: function() {
                                    // check if found
                                    if ($('#page_' + next_page).length){
                                        // ke page berikutnya
                                        $("#step_" + next_page).addClass('m-wizard__step--current');
                                        $("#page_" + current_page).removeClass('m-wizard__form-step--current');
                                        $("#page_" + next_page).addClass('m-wizard__form-step--current');
                                        
                                    } else {
                                        // selesai
                                        
                                        // window.location.href = json.href;
                                    }
                                }
                            });
                        } else {
                            $("#submit_" + current_page).prop('disabled', false).html('Simpan dan Lanjutkan <i class="fa fa-arrow-right"></i>');
                            $.toast({
                                heading: 'Error',
                                text: json.alert,
                                position: 'top-right',
                                textAlign: 'left',
                                hideAfter: 5000,
                                icon: 'error'
                            });
                        }

                    } else {
                        $("#submit_" + current_page).prop('disabled', false).html('Simpan dan Lanjutkan <i class="fa fa-arrow-right"></i>');
                        $.each(json.alert, function(key, value) {
                            var element = $('#' + key);
                            $(element)
                                .closest('.form-group')
                                .find('.invalid-feedback-show').remove();
                            $(element).after(value);
                        });
                    }
                }
            });

        });

        $(document).on("click", ".lihat_file", function(e) {
            e.preventDefault();

            window.open('<?= base_url('uploads/marketing/') ?>' + $(this).data("href"), '_blank');
        });


        $("#file_foto, #file_ktp, #file_cv, #file_ijazah, #file_sertifikat_1, #file_sertifikat_2").change(function() {

            var field = $(this).data("field");
            // alert(field + " has been selected." + $('#id').val());

            // ambil gambar
            var file_data = $(this).prop("files")[0];

            // buat dan isi form
            var form_data = new FormData();
            form_data.append(field, file_data);
            form_data.append("field", field);
            form_data.append("marketing_id", $('#id').val());

            $.ajax({
                url: "<?= base_url('dashboard/account/upload_files') ?>",
                type: 'post',
                data: form_data,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                processData: false,
                success: function(json) {
                    if (json.success == true) {
                        $.toast({
                            heading: 'Success',
                            text: json.alert,
                            position: 'top-right',
                            textAlign: 'left',
                            hideAfter: 2500,
                            icon: 'success',
                            afterHidden: function() { 
                                $(".up_" + field).hide();
                            }
                        });

                    } else {
                        $.toast({
                            heading: 'Error',
                            text: json.alert,
                            position: 'top-right',
                            textAlign: 'left',
                            hideAfter: 5000,
                            icon: 'error'
                        });
                    }

                }
            });

        });

        $(document).on("click", "#submit_4", function(e) {
            e.preventDefault();

            $.toast({
                heading: 'Success',
                text: 'Data saved. You can change your data in My Account.',
                position: 'top-right',
                textAlign: 'left',
                hideAfter: 2500,
                icon: 'success',
                afterHidden: function() { 
                    window.open('<?= base_url('dashboard') ?>');
                }
            });

        });

        $(".check_all").change(function() {
            if (this.checked) {
                $('.cb_page_2').prop('checked', true);
            } else {
                $('.cb_page_2').prop('checked', false);
            }
        });

        $('.radioo').click(function() {
            if ($('#radio-yes').is(':checked')) {

                var a = $("input[type='checkbox'].cb_page_2");
                if(a.length == a.filter(":checked").length){
                    $('#submit_2').show();
                } else {
                    $('#submit_2').hide();
                    $('.radioo').prop('checked', false);
                    alert('Tandai semua checkbox terlebih dahulu');
                }

            } else {
                $('.radioo').prop('checked', false);
                $('#submit_2').hide();
            }
        });

    });
</script>