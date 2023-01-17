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
                            <p align="center"><u><strong>Nota Kesepakatan<br>Kerjasama Kegiatan Pemasaran</strong></u></p>

                            <p align="center">
                                antara<br>
                                WARGIANTO<br>
                                <i>Wakil Pialang Berjangka PT Tifia Finansial Berjangka</i><br>
                                dan<br>
                                <?= strtoupper($user['nama']) ?><br>
                                <i><?= strtoupper($user['role']) ?></i>
                            </p>

                            <div class="row">

                                <div class="col-md-12">
                                    <p align="justify">Kedua belah pihak sepakat untuk membuat Nota Kesepakatan Kerjasama Kegiatan Pemasaran dengan rincian sebagai berikut:</p>
                                </div>

                                <div>
                                    <ol type="I">

                                        <li style="font-weight:bold">
                                            <span style="font-weight:normal">
                                                <strong>Jangka Waktu</strong><br>
                                                <p align="justify">
                                                    Kerjasama Kegiatan Pemasaran berlangsung selama 3 (tiga) bulan mulai dari Nota Kesepakatan disetujui oleh MITRA.<br>
                                                    Setelah 3 bulan, Nota Kesepakatan ini dapat:
                                                </p>
                                                <ol type="a" align="justify">
                                                    <li>Diakhiri jika kinerja MITRA dinilai berada di bawah standar Management, dengan pemberitahuan secara tertulis 1 hari sebelumnya. </li>
                                                    <li>Diperpanjang secara otomatis selama 3 (tiga) bulan berikutnya atas pertimbangan dari Management.</li>
                                                </ol>

                                                <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>
                                            </span>
                                        </li>

                                        <li style="font-weight:bold">
                                            <span style="font-weight:normal">
                                                <strong>Dasar, Tujuan dan Keterikatan kedua Belah Pihak</strong>
                                                <p align="justify">
                                                </p>
                                                <ol type="a">
                                                    <li>Kerjasama ini diselenggarakan atas dasar kebutuhan dan manfaat dari kedua belah pihak secara timbal balik atas dasar sama derajat dan saling menghormati sesuai dan dalam batas kedudukan dan kewenangan masing-masing sesuai dengan peraturan perundang-undangan yang berlaku.</li>
                                                    <li>Nota Kesepakatan ini mengatur Kerjasama kedua belah pihak dalam melakukan Kegiatan Pemasaran melalui media sosial, iklan, internet online, maupun konvensional dalam mencari calon nasabah yang memenuhi persyaratan untuk ikut serta dalam Perdagangan Berjangka, kemudian memperkenalkan calon nasabah kepada Wakil Pialang Berjangka PT Tifia Finansial Berjangka.</li>
                                                    <li>Nota Kesepakatan ini bukan Kontrak Kerja sehingga tidak ada hubungan perusahaan-karyawan antara kedua belah pihak.</li>
                                                </ol>

                                                <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>
                                            </span>
                                        </li>

                                        <li style="font-weight:bold">

                                            <strong>Tanggung Jawab MITRA</strong>
                                            <span style="font-weight:normal">
                                                <p align="justify">
                                                </p>

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
                                            </span>
                                        </li>

                                        <li style="font-weight:bold">
                                            <span style="font-weight:normal">
                                                <strong>Target</strong> <br>
                                                <p align="justify">
                                                </p>
                                                <ol type="a">
                                                    <li>Net Margin In atau jumlah transaksi seperti tertera dalam Lampiran, atau</li>
                                                    <li>Daftar calon nasabah dan laporan aktifitas harían seperti tertera dalam Lampiran.</li>
                                                </ol>

                                                <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>
                                            </span>
                                        </li>

                                        <li style="font-weight:bold">
                                            <strong>Kompensasi</strong>
                                            <span style="font-weight:normal">
                                                <p align="justify">
                                                </p>

                                                <ol type="a">
                                                    <li>Kepada MITRA akan diberikan kompensasi berupa Tunjangan bulanan, komisi atas transaksi yang dilakukan oleh Nasabah yang direkrut olehnya dan bonus seperti tertera dalam Lampiran.</li>
                                                    <li>Tunjangan, Komisi dan bonus dibayarkan paling lambat pada Hari Kerja ke-5 bulan berikutnya.</li>
                                                </ol>

                                                <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>
                                            </span>
                                        </li>

                                        <li style="font-weight:bold">
                                            <span style="font-weight:normal">
                                                <strong>Berakhirnya Nota Kesepakatan sebelum jangka waktu</strong>
                                                <p align="justify">
                                                </p>

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

                                                <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>
                                            </span>
                                        </li>

                                        <li style="font-weight:bold">
                                            <span style="font-weight:normal">
                                                <strong>Tanggal Effektif </strong><br>
                                                <p align="justify">
                                                    Nota kesepakatan ini berlaku efektif setelah disetujui oleh kedua belah pihak.
                                                    Dengan memberikan persetujuan atas Nota Kesepakatan ini, Kedua belah pihak menyatakan menerima atas isi yang ada di dalamnya.
                                                </p>
                                                <p align="right"><strong>Saya sudah membaca dan memahami</strong><label class="m-checkbox m-checkbox--square"><input type="checkbox" name="cb_page_2" class="cb_page_2" value="1"> <span></span></label></p>
                                            </span>
                                        </li>

                                    </ol>
                                </div>



                            </div><!--  end-row -->

                            <br><br><br><br><br>
                            <!-- pernyataan -->
                            <p align="center"><strong>PERNYATAAN MENERIMA<br>NOTA KESEPAKATAN KERJASAMA KEGIATAN PEMASARAN</strong>
                            <p align="center">
                                Dengan mencentang kolom "YA" di bawah ini, saya menyatakan bahwa saya telah menerima<br>
                                Nota Kesepakatan Kerjasama Kegiatan Pemasaran ini,<br>
                                mengerti dan juga penyetujui isinya.
                            </p>

                            <p align="center">Pernyataan menerima / tidak </p>
                            <div class="col-lg" align="center">
                                <div class="m-radio-inline">
                                    <label class="m-radio">
                                        <input type="radio"> Ya
                                        <span></span>
                                    </label>
                                </div>
                            </div><br>
                            <p align="center">
                                Diterima oleh <?= ucwords($user['nama']) ?>
                                <br>
                                Pada Tanggal <?= date("d F Y", strtotime($user['date_perjanjian'])) ?>
                            </p>


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