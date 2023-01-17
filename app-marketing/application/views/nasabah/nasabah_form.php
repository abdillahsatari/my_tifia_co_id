<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Update Nasabah</h3>
            </div>

            <form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
                <div class="box-body">

                    <div class="form-group">
                        <label for="varchar">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
                        <input type="hidden" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                    </div>
                    <?php if ($button == 'Create') { ?>
                        <div class="form-group">
                            <label for="varchar">Email <?php echo form_error('email') ?></label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="enum">Gender <?php echo form_error('gender') ?></label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="">==PILIH GENDER==</option>
                            <option value="L" <?php if ($gender == 'L') {
                                                    echo "selected";
                                                } ?>>Laki-laki</option>
                            <option value="P" <?php if ($gender == 'P') {
                                                    echo "selected";
                                                } ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Tempat Lahir <?php echo form_error('tempat_lahir') ?></label>
                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo $tempat_lahir; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="date">Tgl Lahir <?php echo form_error('tgl_lahir') ?></label>
                        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tgl Lahir" value="<?php echo $tgl_lahir; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="alamat_rumah">Alamat Rumah <?php echo form_error('alamat_rumah') ?></label>
                        <textarea class="form-control" rows="3" name="alamat_rumah" id="alamat_rumah" placeholder="Alamat Rumah"><?php echo $alamat_rumah; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="char">Kode Pos <?php echo form_error('kode_pos') ?></label>
                        <input type="text" class="form-control" name="kode_pos" id="kode_pos" placeholder="Kode Pos" value="<?php echo $kode_pos; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kewarganegaraan <?php echo form_error('kewarganegaraan') ?></label>
                        <input type="text" class="form-control" name="kewarganegaraan" id="kewarganegaraan" placeholder="Kewarganegaraan" value="<?php echo $kewarganegaraan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">No Npwp <?php echo form_error('no_npwp') ?></label>
                        <input type="text" class="form-control" name="no_npwp" id="no_npwp" placeholder="No Npwp" value="<?php echo $no_npwp; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">No Hp <?php echo form_error('no_hp') ?></label>
                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Hp" value="<?php echo $no_hp; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">No Tlp <?php echo form_error('no_tlp') ?></label>
                        <input type="text" class="form-control" name="no_tlp" id="no_tlp" placeholder="No Tlp" value="<?php echo $no_tlp; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">No Faksimili <?php echo form_error('no_faksimili') ?></label>
                        <input type="text" class="form-control" name="no_faksimili" id="no_faksimili" placeholder="No Faksimili" value="<?php echo $no_faksimili; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="enum">Pengalaman Investasi <?php echo form_error('pengalaman_investasi') ?></label>
                        <select class="form-control" name="pengalaman_investasi" id="pengalaman_investasi">
                            <option value="">==PILIH Pengalaman Investasi==</option>
                            <option value="Ya" <?php if ($pengalaman_investasi == 'Ya') {
                                                    echo "selected";
                                                } ?>>Ya</option>
                            <option value="Tidak" <?php if ($pengalaman_investasi == 'Tidak') {
                                                        echo "selected";
                                                    } ?>>Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Status Kepimilikan Rumah <?php echo form_error('status_rumah') ?></label>
                        <input type="text" class="form-control" name="status_rumah" id="status_rumah" placeholder="Status Rumah" value="<?php echo $status_rumah; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Tujuan Pembukaan Rekening <?php echo form_error('tujuan_pembukaan_rek') ?></label>
                        <input type="text" class="form-control" name="tujuan_pembukaan_rek" id="tujuan_pembukaan_rek" placeholder="Tujuan Pembukaan Rek" value="<?php echo $tujuan_pembukaan_rek; ?>" />
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="enum">Keluarga Bapepti <?php echo form_error('keluarga_bapepti') ?></label>
                        <select class="form-control" name="keluarga_bapepti" id="keluarga_bapepti">
                            <option value="">==PILIH STATUS Keluarga Bapepti==</option>
                            <option value="Tidak" <?php if ($keluarga_bapepti == 'Tidak') {
                                                        echo "selected";
                                                    } ?>>Tidak</option>
                            <option value="Ya" <?php if ($keluarga_bapepti == 'Ya') {
                                                    echo "selected";
                                                } ?>>Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="enum">Status Pailit <?php echo form_error('status_pailit') ?></label>
                        <select class="form-control" name="status_pailit" id="status_pailit">
                            <option value="">==PILIH Status Pailit==</option>
                            <option value="Tidak" <?php if ($status_pailit == 'Tidak') {
                                                        echo "selected";
                                                    } ?>>Tidak</option>
                            <option value="Ya" <?php if ($status_pailit == 'Ya') {
                                                    echo "selected";
                                                } ?>>Ya</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="varchar">Nama Rekan <?php echo form_error('nama_rekan') ?></label>
                        <input type="text" class="form-control" name="nama_rekan" id="nama_rekan" placeholder="Nama Rekan" value="<?php echo $nama_rekan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Telepon Rekan <?php echo form_error('telepon_rekan') ?></label>
                        <input type="text" class="form-control" name="telepon_rekan" id="telepon_rekan" placeholder="Telepon Rekan" value="<?php echo $telepon_rekan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Hubungan Rekan <?php echo form_error('hubungan_rekan') ?></label>
                        <input type="text" class="form-control" name="hubungan_rekan" id="hubungan_rekan" placeholder="Hubungan Rekan" value="<?php echo $hubungan_rekan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="alamat_rekan">Alamat Rekan <?php echo form_error('alamat_rekan') ?></label>
                        <textarea class="form-control" rows="3" name="alamat_rekan" id="alamat_rekan" placeholder="Alamat Rekan"><?php echo $alamat_rekan; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kode Pos Rekan <?php echo form_error('kode_pos_rekan') ?></label>
                        <input type="text" class="form-control" name="kode_pos_rekan" id="kode_pos_rekan" placeholder="Kode Pos Rekan" value="<?php echo $kode_pos_rekan; ?>" />
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="varchar">Pekerjaan <?php echo form_error('pekerjaan') ?></label>
                        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?php echo $pekerjaan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Perusahaan <?php echo form_error('nama_perusahaan') ?></label>
                        <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" placeholder="Nama Perusahaan" value="<?php echo $nama_perusahaan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Bidang Usaha <?php echo form_error('bidang_usaha') ?></label>
                        <input type="text" class="form-control" name="bidang_usaha" id="bidang_usaha" placeholder="Bidang Usaha" value="<?php echo $bidang_usaha; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Jabatan <?php echo form_error('jabatan') ?></label>
                        <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Lama Kerja <?php echo form_error('lama_kerja') ?></label>
                        <input type="text" class="form-control" name="lama_kerja" id="lama_kerja" placeholder="Lama Kerja" value="<?php echo $lama_kerja; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="alamat_kantor">Alamat Kantor <?php echo form_error('alamat_kantor') ?></label>
                        <textarea class="form-control" rows="3" name="alamat_kantor" id="alamat_kantor" placeholder="Alamat Kantor"><?php echo $alamat_kantor; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kode Pos Kantor <?php echo form_error('kode_pos_kantor') ?></label>
                        <input type="text" class="form-control" name="kode_pos_kantor" id="kode_pos_kantor" placeholder="Kode Pos Kantor" value="<?php echo $kode_pos_kantor; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Telepon Kantor <?php echo form_error('telepon_kantor') ?></label>
                        <input type="text" class="form-control" name="telepon_kantor" id="telepon_kantor" placeholder="Telepon Kantor" value="<?php echo $telepon_kantor; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Faksimili Kantor <?php echo form_error('faksimili_kantor') ?></label>
                        <input type="text" class="form-control" name="faksimili_kantor" id="faksimili_kantor" placeholder="Faksimili Kantor" value="<?php echo $faksimili_kantor; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kantor Sebelumnya <?php echo form_error('kantor_sebelumnya') ?></label>
                        <input type="text" class="form-control" name="kantor_sebelumnya" id="kantor_sebelumnya" placeholder="Kantor Sebelumnya" value="<?php echo $kantor_sebelumnya; ?>" />
                    </div>

                    <hr>
                    <h4>Data Pialang</h4>
                    <div class="form-group">
                        <label for="varchar">Penyelesaian perselisihan <?php echo form_error('penyelesaian_perselisihan') ?></label>
                        <textarea type="text" class="form-control" name="penyelesaian_perselisihan" id="penyelesaian_perselisihan" placeholder="Penyelesaian perselisihan"><?php echo $penyelesaian_perselisihan; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Wakil Pialang <?php echo form_error('wakil_pialang') ?></label>
                        <input type="text" class="form-control" name="wakil_pialang" id="wakil_pialang" placeholder="Wakil Pialang" value="<?php echo $wakil_pialang; ?>" />
                    </div>

                    <hr>

                    <h4>Data</h4>
                    <div class="form-group">
                        <label for="enum">Status Kawin <?php echo form_error('status_kawin') ?></label>
                        <select class="form-control" name="status_kawin" id="status_kawin">
                            <option value="">==PILIH STATUS KAWIN==</option>
                            <option value="Janda/Duda" <?php if ($status_kawin == 'Janda/Duda') {
                                                            echo "selected";
                                                        } ?>>Janda/Duda</option>
                            <option value="Lajang" <?php if ($status_kawin == 'Lajang') {
                                                        echo "selected";
                                                    } ?>>Lajang</option>
                            <option value="Menikah" <?php if ($status_kawin == 'Menikah') {
                                                        echo "selected";
                                                    } ?>>Menikah</option>
                        </select>
                    </div>
                    <div class="form-group" id="pasangan">
                        <label for="varchar">Nama Pasangan <?php echo form_error('nama_pasangan') ?></label>
                        <input type="text" class="form-control" name="nama_pasangan" id="nama_pasangan" placeholder="Nama Pasangan" value="<?php echo $nama_pasangan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Nama Ibu <?php echo form_error('nama_ibu') ?></label>
                        <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" placeholder="Nama Ibu" value="<?php echo $nama_ibu; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="enum">Jenis Identitas <?php echo form_error('jenis_identitas') ?></label>
                        <select class="form-control" name="jenis_identitas" id="jenis_identitas">
                            <option value="">==PILIH JENIS IDENTITAS==</option>
                            <option value="KTP" <?php if ($jenis_identitas == 'KTP') {
                                                    echo "selected";
                                                } ?>>KTP</option>
                            <option value="SIM" <?php if ($jenis_identitas == 'SIM') {
                                                    echo "selected";
                                                } ?>>SIM</option>
                            <option value="PASSPORT" <?php if ($jenis_identitas == 'PASSPORT') {
                                                            echo "selected";
                                                        } ?>>PASSPORT</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">No Identitas <?php echo form_error('no_identitas') ?></label>
                        <input type="text" class="form-control" name="no_identitas" id="no_identitas" placeholder="No Identitas" value="<?php echo $no_identitas; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="enum">Pendapatan Pertahun <?php echo form_error('pendapatan_pertahun') ?></label>
                        <select class="form-control" name="pendapatan_pertahun" id="pendapatan_pertahun">
                            <option value="">==PILIH Pendapatan Pertahun==</option>
                            <option value="100-250" <?php if ($pendapatan_pertahun == '100-250') {
                                                        echo "selected";
                                                    } ?>>100.000.000-250.000.000</option>
                            <option value="250-500" <?php if ($pendapatan_pertahun == '250-500') {
                                                        echo "selected";
                                                    } ?>>250.000.000-500.000.000</option>
                            <option value="diatas 500" <?php if ($pendapatan_pertahun == 'diatas 500') {
                                                            echo "selected";
                                                        } ?>>Diatas 500.000.000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Lokasi Rumah <?php echo form_error('lokasi_rumah') ?></label>
                        <input type="text" class="form-control" name="lokasi_rumah" id="lokasi_rumah" placeholder="Lokasi Rumah" value="<?php echo $lokasi_rumah; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Njob <?php echo form_error('njob') ?></label>
                        <input type="text" class="form-control" name="njob" id="njob" placeholder="Njob" value="<?php echo $njob; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Deposit Bank <?php echo form_error('deposit_bank') ?></label>
                        <input type="text" class="form-control" name="deposit_bank" id="deposit_bank" placeholder="Deposit Bank" value="<?php echo $deposit_bank; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Jumlah Kekayaan <?php echo form_error('jumlah_kekayaan') ?></label>
                        <input type="text" class="form-control" name="jumlah_kekayaan" id="jumlah_kekayaan" placeholder="Jumlah Kekayaan" value="<?php echo $jumlah_kekayaan; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kekayaan Lainnya <?php echo form_error('kekayaan_lainnya') ?></label>
                        <input type="text" class="form-control" name="kekayaan_lainnya" id="kekayaan_lainnya" placeholder="Kekayaan Lainnya" value="<?php echo $kekayaan_lainnya; ?>" />
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="varchar">Nama Bank</label>
                        <div class="form-control" readonly><?php echo $nama_bank; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">No Rekening <?php echo form_error('no_rekening') ?></label>
                        <div class="form-control" readonly><?php echo $no_rekening; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Cabang <?php echo form_error('cabang') ?></label>
                        <div class="form-control" readonly><?php echo $cabang; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Jenis Rekening <?php echo form_error('jenis_rekening') ?></label>
                        <div class="form-control" readonly><?php echo $jenis_rekening; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Telepon Bank <?php echo form_error('telepon_bank') ?></label>
                        <div class="form-control" readonly><?php echo $telepon_bank; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kode Bank <?php echo form_error('kode_bank') ?></label>
                        <div class="form-control" readonly><?php echo $kode_bank; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Atas Nama <?php echo form_error('atas_nama') ?></label>
                        <div class="form-control" readonly><?php echo $atas_nama; ?></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="varchar">Nama Bank (USD) <?php echo form_error('nama_bank2') ?></label>
                        <div class="form-control" readonly><?php echo $nama_bank2; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">No Rekening (USD) <?php echo form_error('no_rekening2') ?></label>
                        <div class="form-control" readonly><?php echo $no_rekening2; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Cabang (USD) <?php echo form_error('cabang2') ?></label>
                        <div class="form-control" readonly><?php echo $cabang2; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Jenis Rekening (USD) <?php echo form_error('jenis_rekening2') ?></label>
                        <div class="form-control" readonly><?php echo $jenis_rekening2; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Telepon Bank (USD) <?php echo form_error('telepon_bank2') ?></label>
                        <div class="form-control" readonly><?php echo $telepon_bank2; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Kode Bank (USD) <?php echo form_error('kode_bank2') ?></label>
                        <div class="form-control" readonly><?php echo $kode_bank2; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="varchar">Atas Nama (USD) <?php echo form_error('atas_nama2') ?></label>
                        <div class="form-control" readonly><?php echo $atas_nama2; ?></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="dokumen_tambahan">Foto NPWP <?php echo form_error('foto_npwp') ?></label>
                        <p>
                            <img src="<?= base_url() ?>uploads/photo/<?= $foto_npwp ?>" width='50%'>
                            <input type="file" class="form-control" name="foto_npwp" id="foto_npwp">
                    </div>
                    <div class="form-group">
                        <label for="foto_terkini">Foto Terkini <?php echo form_error('foto_terkini') ?></label>
                        <p>
                            <img width="50%" src="<?= base_url() ?>uploads/photo/<?= $foto_terkini ?>">
                            <input type="file" class="form-control" name="foto_terkini" id="foto_terkini">
                    </div>
                    <div class="form-group">
                        <label for="pict_identitas">Pict Identitas <?php echo form_error('pict_identitas') ?></label>
                        <p>
                            <img src="<?= base_url() ?>uploads/photo/<?= $pict_identitas ?>" width='50%'>
                            <input type="file" class="form-control" name="pict_identitas" id="pict_identitas">
                    </div>
                    <div class="form-group">
                        <label for="dokumen_tambahan">Scan/foto rekening koran/rekening telpon/buku tabungan <?php echo form_error('foto_buku_tabungan') ?></label>
                        <p>
                            <img src="<?= base_url() ?>uploads/photo/<?= $foto_buku_tabungan ?>" width='50%'>
                            <input type="file" class="form-control" name="foto_buku_tabungan" id="foto_buku_tabungan">
                    </div>


                    <?php if ($status !== "Approved") { ?>
                        <?php if ($button != 'Create') { ?>
                            <div class="form-group">
                                <label for="enum">Status <?php echo form_error('status') ?></label>
                                <select class="form-control" name="status" id="status">
                                    <option value="">==PILIH STATUS==</option>
                                    <option value="Register" disabled <?= ($status == 'Register' ? "selected" : '') ?>>Register</option>
                                    <option value="Complete" <?= ($status == 'Complete' ? "selected" : '') ?>>Complete</option>
                                    <option value="Checking" <?= ($status == 'Checking' ? "selected" : '') ?>>Checking</option>
                                    <option value="Approved" <?= ($status == 'Approved' ? "selected" : '') ?>>Approved</option>
                                    <option value="Active" disabled <?= ($status == 'Active' ? "selected" : '') ?>>Actived</option>
                                </select>
                            </div>
                            <div class="form-group" id="komen" style="display: none">
                                <label for="komentar">Komentar <?php echo form_error('komentar') ?></label>
                                <textarea class="form-control" rows="3" name="komentar" id="komentar" placeholder="Komentar"><?php echo $komentar; ?></textarea>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="form-group">
                            <label for="varchar">Status</label>
                            <div class="form-control" readonly><?php echo $status; ?></div>
                        </div>
                    <?php } ?> <br>


                    <input type="hidden" name="nasabah_id" value="<?php echo $nasabah_id; ?>" />
                    <?php if ($status != "Approved") { ?>
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <?php } ?>

                    <!-- <a href="<?php echo site_url('adminarea/nasabah') ?>" class="btn btn-default">Cancel</a> -->
                    <a class="btn btn-default" href="javascript:window.history.go(-1);">Kembali</a>
                    <button class="btn btn-danger pull-right" type="button" id="btn-hapus-nasabah" data-id="<?= $nasabah_id ?>">Hapus nasabah &nbsp;<i class="fa fa-trash-o"></i></button>

                </div>
            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        $(document).on('click', '#btn-hapus-nasabah', function(e) {
            // e.preventDefault();

            const nasabah_id = $(this).data('id');
            if (nasabah_id != '') {

                var prompt = alertify.confirm('Apakah anda yakin akan menghapus nasabah secara permanen?',
                    'Apakah anda yakin akan menghapus nasabah secara permanen?').set('labels', {
                    ok: 'Ya, saya yakin',
                    cancel: 'Batal'
                }).set('onok', function(closeEvent) {
                    window.location.href = '<?= base_url('adminarea/nasabah/delete/') ?>' + nasabah_id;

                });
            }

        });




    });
</script>