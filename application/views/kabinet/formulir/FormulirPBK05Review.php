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
                            <p><strong>Formulir Nomor 107.PBK.05</strong></p>
                            <div class="col-lg-12">
                                <p style="text-align: right;">Lampiran 2 Peraturan Kepala Badan Pengawas<br> Perdagangan Berjangka Komoditi<br> Nomor: 5/BAPPEBTI/PER/V/2018 </p>
                            </div>
                            <hr>
                            <p align="center"><strong>
                                    PERJANJIAN PEMBERIAN AMANAT SECARA ELEKTRONIK ON-LINE<br>
                                    UNTUK TRANSAKSI KONTRAK DERIVATIF<br>
                                    DALAM SISTEM PERDAGANGAN ALTERNATIF
                            </p>

                            <p align="center">PERHATIAN!</p>
                            <p align="center">PERJANJIAN INI MERUPAKAN KONTRAK HUKUM HARAP DIBACA DENGAN SEKSAMA</p>
                            <hr>
                            <?php
                            // $tanggal = $nasabah->tanggal_buat_akun;
                            function tanggal_indo($tanggal, $cetak_hari = false)
                            {
                                $hari = array(
                                    1 =>    'Senin',
                                    'Selasa',
                                    'Rabu',
                                    'Kamis',
                                    'Jumat',
                                    'Sabtu',
                                    'Minggu'
                                );

                                $bulan = array(
                                    1 =>   'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember'
                                );
                                $split    = explode('-', $tanggal);
                                $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

                                if ($cetak_hari) {
                                    $num = date('N', strtotime($tanggal));
                                    return $hari[$num] . ', ' . $tgl_indo;
                                }
                                return $tgl_indo;
                            }
                            ?>
                            <p>Pada hari ini <?php echo tanggal_indo($nasabah->update_date, true); ?>, kami yang mengisi perjanjian di bawah ini:
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>: <?php echo $nasabah->nama_lengkap; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan/Jabatan</td>
                                        <td>: <?php echo $nasabah->pekerjaan; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: <?php echo $nasabah->alamat_rumah; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>Dalam hal ini bertindak untuk dan atas nama yang selanjutnya disebut <strong>Nasabah</strong></p>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><?= $nasabah->wakil_pialang ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pekerjaan/Jabatan</td>
                                        <td>:</td>
                                        <td>
                                            Wakil Pialang Berjangka
                                            <br>
                                            (Petugas Wakil Pialang yang ditunjuk Memverifikasi)
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>
                                            Equity Tower Lantai 11 Unit H
                                            Sudirman Central Business District Lot 9
                                            Jl. Jendral Sudirman Kav. 52-53, Jakarta
                                            Selatan 12190 - Indonesia
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p align="justify">
                                Dalam hal ini bertindak untuk dan atas nama <strong>PT. Tifia Finansial Berjangka</strong> yang selanjutnya disebut <strong>Pialang Berjangka</strong>
                                <br><br>
                                Nasabah dan Pialang Berjangka secara bersama-sama selanjutnya disebut Para Pihak<br>
                                Para Pihak sepakat untuk mengadakan Perjanjian Pemberian Amanat untuk melakukan transaksi penjualan maupun pembelian Kontrak Derivatif dalam Sistem Perdagangan Alternatif dengan ketentuan sebagai berikut:
                            </p>
                            <!-- perjanjian nasabah dan wakil pialang -->


                            <p align="justify">1. <strong>Margin dan Pembayaran Lainnya</strong>
                                <br>(1) Nasabah menempatkan sejumlah dana (Margin) ke Rekening Terpisah (Segregated Account) Pialang Berjangka sebagai Margin Awal dan wajib mempertahankannya sebagaimana ditetapkan.
                                <br>(2) Membayar biaya-biaya yang diperlukan untuk transaksi, yaitu biaya transaksi, pajak, komisi, dan biaya pelayanan, biaya bunga sesuai tingkat yang berlaku, dan biaya lainnya yang dapat dipertanggungjawabkan berkaitan dengan transaksi sesuai amanat Nasabah, maupun biaya rekening Nasabah.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">2. <strong>Pelaksanaan Transaksi</strong>
                                <br>(1) Setiap transaksi Nasabah dilaksanakan secara elektronik on-line oleh Nasabah yang bersangkutan;
                                <br>(2) Setiap amanat Nasabah yang diterima dapat langsung dilaksanakan sepanjang nilai Margin yang tersedia pada rekeningnya mencukupi dan eksekusinya dapat menimbulkan perbedaan waktu terhadap proses pelaksanaan transaksi tersebut. Nasabah harus mengetahui posisi Margin dan posisi terbuka sebelum memberikan amanat untuk transaksi berikutnya.
                                <br>(3) Setiap transaksi Nasabah secara bilateral dilawankan dengan Penyelenggara Sistem Perdagangan Alternatif PT USAHA FOREXINDO INDONESIA yang bekerjasama dengan Pialang Berjangka.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">3. <strong>Kewajiban Memelihara Margin</strong>
                                <br>(1) Nasabah wajib memelihara/memenuhi tingkat Margin yang harus tersedia di rekening pada Pialang Berjangka sesuai dengan jumlah yang telah ditetapkan baik diminta ataupun tidak oleh Pialang Berjangka.
                                <br>(2) Apabila jumlah Margin memerlukan penambahan maka Pialang Berjangka wajib Memberitahukan dan memintakan kepada Nasabah untuk menambah Margin segera.
                                <br>(3) Apabila jumlah Margin memerlukan tambahan (Call Margin) maka Nasabah wajib melakukan penyerahan Call Margin selambat-lambatnya sebelum dimulai hari perdagangan berikutnya. Kewajiban Nasabah sehubungan dengan penyerahan Call Margin tidak terbatas pada jumlah Margin awal.
                                <br>(4) Pialang Berjangka tidak berkewajiban melaksanakan amanat untuk melakukan transaksi yang baru dari Nasabah sebelumCall Margin dipenuhi.
                                <br>(5) Untuk memenuhi kewajiban Call Margin dan keuangan lainnya dari Nasabah, Pialang Berjangka dapat mencairkan dana Nasabah yang ada di Pialang Berjangka.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>

                            <p align="justify">4.<strong>Hak Pialang Berjangka Melikuidasi Posisi Nasabah</strong>
                                <br>Nasabah bertanggung jawab memantau/mengetahui posisi terbukanya secara terus menerus dan memenuhi kewajibannya. Apabila dalam jangka waktu tertentu dana pada rekening Nasabah kurang dari yang dipersyaratkan, Pialang Berjangka dapat menutup posisi terbuka Nasabah secara keseluruhan atau sebagian, membatasi transaksi, atau tindakan lain untuk melindungi diri dalam pemenuhan Margin tersebut dengan terlebih dahulu memberitahu atau tanpa memberitahu Nasabah dan Pialang Berjangka tidak bertanggungjawab atas kerugian yang timbul akibat tindakan tersebut.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">5. <strong>Penggantian Kerugian Tidak Adanya Penutupan Posisi</strong>
                                <br>Apabila Nasabah tidak mampu melakukan penutupan atas transaksi yang jatuh tempo, Pialang Berjangka dapat melakukan penutupan atas transaksi Nasabah yang terjadi. Nasabah wajib membayar biaya-biaya, termasuk biaya kerugian dan premi yang telah dibayarkan oleh Pialang Berjangka, dan apabila Nasabah lalai untuk membayar biaya-biaya tersebut, Pialang Berjangka berhak untuk mengambil pembayaran dari dana Nasabah.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">6. <strong>Pialang Berjangka Dapat Membatasi Posisi </strong>
                                <br>Nasabah mengakui hak Pialang Berjangka untuk membatasi posisi terbuka Kontrak dan Nasabah tidak melakukan transaksi melebihi batas yang telah ditetapkan tersebut.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">7. <strong>Tidak Ada Jaminan atas Informasi atau Rekomendasi</strong>
                                <br>Nasabah mengakui bahwa:
                                <br>(1) Informasi dan rekomendasi yang diberikan oleh Pialang Berjangka kepada Nasabah tidak selalu lengkap dan perlu diverifikasi.
                                <br>(2) Pialang Berjangka tidak menjamin bahwa informasi dan rekomendasi yang diberikan merupakan informasi yang akurat dan lengkap.
                                <br>(3) Informasi dan rekomendasi yang diberikan oleh Wakil Pialang Berjangka yang satu dengan yang lain mungkin berbeda karena perbedaan analisis fundamental atau teknikal. Nasabah menyadari bahwa ada kemungkinan Pialang Berjangka dan pihak terafiliasinya memiliki posisi di pasar dan memberikan rekomendasi tidak konsisten kepada Nasabah.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">8. <strong>Pembatasan Tanggung Jawab Pialang Berjangka</strong>
                                <br>(1) Pialang Berjangka tidak bertanggung jawab untuk memberikan penilaian kepada Nasabah mengenai iklim, pasar, keadaan politik dan ekonomi nasional dan internasional, nilai Kontrak Derivatif, kolateral, atau memberikan nasihat mengenai keadaan pasar. Pialang Berjangka hanya memberikan pelayanan untuk melakukan transaksi secara jujur serta memberikan laporan atas transaksi tersebut.
                                <br>(2) Perdagangan sewaktu-waktu dapat dihentikan oleh pihak yang memiliki otoritas (Bappebti/ Bursa Berjangka) tanpa pemberitahuan terlebih dahulu kepada Nasabah. Atas posisi terbuka yang masih dimiliki oleh Nasabah pada saat perdagangan tersebut dihentikan, maka akan diselesaikan (likuidasi) berdasarkan pada peraturan/ketentuan yang dikeluarkan dan ditetapkan oleh pihak otoritas tersebut, dan semua kerugian serta biaya yang timbul sebagai akibat dihentikannya transaksi oleh pihak otoritas perdagangan tersebut, menjadi beban dan tanggungjawab Nasabah sepenuhnya.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">9. <strong>Transaksi Harus Mematuhi Peraturan Yang Berlaku</strong>
                                <br>Semua transaksi dilakukan sendiri oleh Nasabah dan wajib mematuhi peraturan perundang- undangan di bidang Perdagangan Berjangka, kebiasaan dan interpretasi resmi yang ditetapkan oleh Bappebti atau Bursa Berjangka.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">10. <strong>Pialang Berjangka tidak Bertanggung jawab atas Kegagalan Komunikasi </strong>
                                <br>Pialang Berjangka tidak bertanggung jawab atas keterlambatan atau tidak tepat waktunya pengiriman amanat atau informasi lainnya yang disebabkan oleh kerusakan fasilitas komunikasi atau sebab lain diluar kontrol Pialang Berjangka.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">11. <strong>Konfirmasi</strong>
                                <br>(1) Konfirmasi dari Nasabah dapat berupa surat, telex, media lain, surat elektronik, secara tertulis ataupun rekaman suara.
                                <br>(2) Pialang Berjangka berkewajiban menyampaikan konfirmasi transaksi, laporan rekening, permintaan Call Margin, dan pemberitahuan lainnya kepada Nasabah secara akurat, benar dan secepatnya pada alamat (email) Nasabah sesuai dengan yang tertera dalam rekening Nasabah. Apabila dalam jangka waktu 2 x 24 jam setelah amanat jual atau beli disampaikan, tetapi Nasabah belum menerima konfirmasi melalui alamat email Nasabah dan/atau sistem transaksi, Nasabah segera memberitahukan hal tersebut kepada Pialang Berjangka melalui telepon dan disusul dengan pemberitahuan tertulis.
                                <br>(3) Jika dalam waktu 2 x 24 jam sejak tanggal penerimaan konfirmasi tersebut tidak ada sanggahan dari Nasabah maka konfirmasi Pialang Berjangka dianggap benar dan sah.
                                <br>(4) Kekeliruan atas konfirmasi yang diterbitkan Pialang Berjangka akan diperbaiki oleh Pialang Berjangka sesuai keadaan yang sebenarnya dan demi hukum konfirmasi yang lama batal.
                                <br>(5) Nasabah tidak bertanggung jawab atas transaksi yang dilaksanakan atas rekeningnya apabila konfirmasi tersebut tidak disampaikan secara benar dan akurat.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">12. <strong>Kebenaran Informasi Nasabah</strong>
                                <br>Nasabah wajib memberikan informasi yang benar dan akurat mengenai data Nasabah yang diminta oleh Pialang Berjangka dan akan memberitahukan paling lambat dalam waktu 3 (tiga) hari kerja setelah terjadi perubahan, termasuk perubahan kemampuan keuangannya untuk terus melaksanakan transaksi.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">13. <strong>Komisi Transaksi</strong>
                                <br>Nasabah mengetahui dan menyetujui bahwa Pialang Berjangka berhak untuk memungut komisi atas transaksi yang telah dilaksanakan, dalam jumlah sebagaimana akan ditetapkan dari waktu ke waktu oleh Pialang Berjangka. Perubahan beban (fees) dan biaya lainnya harus disetujui secara tertulis oleh Para Pihak.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">14. <strong>Pemberian Kuasa</strong>
                                <br>Nasabah memberikan kuasa kepada Pialang Berjangka untuk menghubungi bank, lembaga keuangan, Pialang Berjangka lain, atau institusi lain yang terkait untuk memperoleh keterangan atau verifikasi mengenai informasi yang diterima dari Nasabah. Nasabah mengerti bahwa penelitian mengenai data hutang pribadi dan bisnis dapat dilakukan oleh Pialang Berjangka apabila diperlukan.Nasabah diberikan kesempatan untuk memberitahukan secara tertulis dalam jangka waktu yang telah disepakati untuk melengkapi persyaratan yang diperlukan.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">15. <strong>Pemindahan Dana </strong>
                                <br>Pialang Berjangka dapat setiap saat mengalihkan dana dari satu rekening ke rekening lainnya berkaitan dengan kegiatan transaksi yang dilakukan Nasabah seperti pembayaran komisi, pembayaran biaya transaksi, kliring dan keterlambatan dalam memenuhi kewajibannya, tanpa terlebih dahulu memberitahukan kepada Nasabah. Transfer yang telah dilakukan akan segera diberitahukan secara tertulis kepada Nasabah.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">16. <strong>Pemberitahuan </strong>
                                <br>(1) Semua komunikasi, uang, surat berharga, dan kekayaan lainnya harus dikirimkan langsung ke alamat Nasabah seperti tertera dalam rekeningnya atau alamat lain yang ditetapkan/ diberitahukan secara tertulis oleh Nasabah.
                                <br>(2) Semua uang, harus disetor atau ditransfer langsung oleh Nasabah ke Rekening Terpisah (Segregated Account) Pialang Berjangka:
                            </p>
                            <!-- rekening terpisah -->
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><strong>PT. Tifia Finansial Berjangka</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>Equity Tower Lantai 11 Unit H <br>
                                            Sudirman Central Business District Lot 9 <br>
                                            Jl. Jendral Sudirman Kav. 52-53, Jakarta <br>
                                            Selatan 12190 - Indonesia</td>
                                    </tr>
                                    <tr>
                                        <td>Bank</td>
                                        <td>:</td>
                                        <td>Bank Central Asia (BCA) KCU Sudirman Jakarta Selatan</td>
                                    </tr>
                                    <tr>
                                        <td>Rekening Terpisah</td>
                                        <td>:</td>
                                        <td>0353-1186-73 (IDR)</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <p align="justify">dan dianggap sudah diterima oleh Pialang Berjangka apabila sudah ada tanda terima bukti setor atau transfer dari pegawai Pialang Berjangka.
                                <br>(3) Semua surat berharga, kekayaan lainnya, atau komunikasi harus dikirim kepada Pialang Berjangka:
                            </p>

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><strong>PT. Tifia Finansial Berjangka</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>Equity Tower Lantai 11 Unit H <br>
                                            Sudirman Central Business District Lot 9 <br>
                                            Jl. Jendral Sudirman Kav. 52-53, Jakarta <br>
                                            Selatan 12190 - Indonesia</td>
                                    </tr>
                                    <tr>
                                        <td>Telepon</td>
                                        <td>:</td>
                                        <td>021 - 5093 9080 </td>
                                    </tr>
                                    <tr>
                                        <td>Fax</td>
                                        <td>:</td>
                                        <td>021 - 5093 9090</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>support@tifia.co.id </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            <p align="jutify">dan dianggap sudah diterima oleh Pialang Berjangka apabila sudah ada tanda bukti penerimaan Dari pegawai Pialang Berjangka.</p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">17. <strong>Dokumen Pemberitahuan Adanya Risiko </strong>
                                <br>Nasabah mengakui menerima dan mengerti Dokumen Pemberitahuan Adanya Risiko.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">18. <strong>Jangka Waktu Perjanjian dan Pengakhiran</strong>
                                <br>(1) Perjanjian ini mulai berlaku terhitung sejak tanggal dilakukannya konfirmasi oleh Pialang Berjangka dengan diterimanya Bukti Konfirmasi Penerimaan Nasabah dari Pialang Berjangka oleh Nasabah.
                                <br>(2) Nasabah dapat mengakhiri Perjanjian ini hanya jika Nasabah sudah tidak lagi memiliki posisi terbuka dan tidak ada kewajiban Nasabah yang diemban oleh atau terhutang kepada Pialang Berjangka.
                                <br>(3) Pengakhiran tidak membebaskan salah satu Pihak dari tanggung jawab atau kewajiban yang terjadi sebelum pemberitahuan tersebut.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">19. <strong>Berakhirnya Perjanjian </strong>
                                <br>Perjanjian dapat berakhir dalam hal Nasabah:
                                <br>(1) dinyatakan pailit, memiliki hutang yang sangat besar, dalam proses peradilan, menjadi hilang ingatan, mengundurkan diri atau meninggal;
                                <br>(2) tidak dapat memenuhi atau mematuhi perjanjian ini dan/atau melakukan pelanggaranterhadapnya;
                                <br>(3) berkaitan dengan butir (1) dan (2) tersebut diatas, Pialang Berjangka dapat:
                            </p>
                            <ul>
                                <li>(i) meneruskan atau menutup posisi Nasabah tersebut setelah mempertimbangkannya secara cermat dan jujur ; dan</li>
                                <li>(ii) menolak transaksi dari Nasabah. </li>
                            </ul>
                            <p align="justify">(4) Pengakhiran Perjanjian sebagaimana dimaksud dengan angka (1) dan (2) tersebut di atas tidak melepaskan kewajiban dari Para Pihak yang berhubungan dengan penerimaan atau kewajiban pembayaran atau pertanggungjawaban kewajiban lainnya yang timbul dari Perjanjian.</p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">20. <strong><i>Force Majeur</i></strong>
                                <br>Tidak ada satupun pihak di dalam Perjanjian dapat diminta pertanggungjawabannya untuk suatu keterlambatan atau terhalangnya memenuhi kewajiban berdasarkan Perjanjian yang diakibatkan oleh suatu sebab yang berada di luar kemampuannya atau kekuasaannya (<i>force majeure</i>), sepanjang pemberitahuan tertulis mengenai sebab itu disampaikannya kepada pihak lain dalam Perjanjian dalam waktu tidak lebih dari 24 (dua puluh empat) jam sejak timbulnya sebab itu. Yang dimaksud dengan <i>force majeur</i> dalam Perjanjian adalah peristiwa kebakaran, bencana alam (seperti gempa bumi, banjir, angin topan, petir), pemogokan umum, huru hara, peperangan, perubahan terhadap peraturan perundang-undangan yang berlaku dan kondisi di bidang ekonomi, keuangan dan Perdagangan Berjangka, pembatasan yang dilakukan oleh otoritas Perdagangan Berjangka dan Bursa Berjangka serta terganggunya sistem perdagangan, kliring dan penyelesaian transaksi Kontrak Berjangka di mana transaksi dilaksanakan yang secara langsung mempengaruhi Pelaksanaan pekerjaan berdasarkanPerjanjian.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">21. <strong>Perubahan atas Isian dalam Perjanjian Pemberian Amanat</strong>
                                <br>Perubahan atas isian dalam Perjanjian ini hanya dapat dilakukan atas persetujuan Para Pihak, atau Pialang Berjangka telah memberitahukan secara tertulis perubahan yang diinginkan, dan Nasabah tetap memberikan perintah untuk transaksi dengan tanpa memberikan tanggapan secara tertulis atas usul perubahan tersebut. Tindakan Nasabah tersebut dianggap setuju atas usul perubahan tersebut.
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify">22. <strong>Penyelesaian Perselisihan </strong>
                                <br>(1) Semua perselisihan dan perbedaan pendapat yang timbul dalam pelaksanaan Perjanjian ini wajib diselesaikan terlebih dahulu secara musyawarah untuk mencapai mufakat antara Para Pihak.
                                <br>(2) Apabila perselisihan dan perbedaan pendapat yang timbul tidak dapat diselesaikan secara musyawarah untuk mencapai mufakat, Para Pihak wajib memanfaatkan sarana penyelesaian perselisihan yang tersedia di Bursa Berjangka.
                                <br>(3) Apabila perselisihan dan perbedaan pendapat yang timbul tidak dapat diselesaikan melalui cara sebagaimana dimaksud pada angka (1) dan angka (2), maka Para Pihak sepakat untuk Menyelesaikan perselisihan melalui: <strong><?= $nasabah->penyelesaian_perselisihan ?></strong>
                                <br>(4) Kantor atau kantor cabang Pialang Berjangka terdekat dengan domisili Nasabah tempat penyelesaian dalam hal terjadi perselisihan.
                            </p>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Daftar Kantor</td>
                                        <td>: PT. Tifia Finansial Berjangka </td>
                                    </tr>
                                    <tr>
                                        <td>Kantor yang dipilih</td>
                                        <td>: Jakarta</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <p align="justify"><strong>23. Bahasa </strong>
                                <br>Perjanjian ini dibuat dalam Bahasa Indonesia
                            </p>
                            <p align="right">Saya sudah membaca dan memahami</p>


                            <!-- end row -->
                            <br><br><br>
                            <!-- pernyataan -->
                            <p align="center"><strong>"Saya telah membaca, mengerti dan setuju terhadap semua ketentuan yang tercantum dalam perjanjian ini".</strong> </p>
                            <p align="center"> Dengan mengisi kolom "YA" di bawah, saya menyatakan bahwa saya telah menerima "PERJANJIAN PEMBERIAN AMANAT TRANSAKSI KONTRAK BERJANGKA" mengerti dan menyetujui isinya.</p>
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