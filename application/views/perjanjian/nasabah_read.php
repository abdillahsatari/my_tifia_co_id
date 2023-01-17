<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Nasabah Detail</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-box-tool" onclick="location.reload()" title="Collapse">
              <i class="fa fa-refresh"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
	        	<table class="table">
				    <tr><td>Nama Lengkap</td><td><?php echo $nama_lengkap; ?></td></tr>
				    <tr><td>Gender</td><td><?php echo $gender; ?></td></tr>
				    <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
				    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
				    <tr><td>Tempat Lahir</td><td><?php echo $tempat_lahir; ?></td></tr>
				    <tr><td>Tgl Lahir</td><td><?php echo $tgl_lahir; ?></td></tr>
				    <tr><td>Alamat Rumah</td><td><?php echo $alamat_rumah; ?></td></tr>
				    <tr><td>Kode Pos</td><td><?php echo $kode_pos; ?></td></tr>
				    <tr><td>Jenis Identitas</td><td><?php echo $jenis_identitas; ?></td></tr>
				    <tr><td>No Identitas</td><td><?php echo $no_identitas; ?></td></tr>
				    <tr><td>Status Kawin</td><td><?php echo $status_kawin; ?></td></tr>
				    <tr><td>Nama Pasangan</td><td><?php echo $nama_pasangan; ?></td></tr>
				    <tr><td>Nama Ibu</td><td><?php echo $nama_ibu; ?></td></tr>
				    <tr><td>No Tlp</td><td><?php echo $no_tlp; ?></td></tr>
				    <tr><td>No Faksimili</td><td><?php echo $no_faksimili; ?></td></tr>
				    <tr><td>No Npwp</td><td><?php echo $no_npwp; ?></td></tr>
				    <tr><td>Alamat Surat Menyurat</td><td><?php echo $alamat_surat_menyurat; ?></td></tr>
				    <tr><td>Status Rumah</td><td><?php echo $status_rumah; ?></td></tr>
				    <tr><td>Pengalaman Investasi</td><td><?php echo $pengalaman_investasi; ?></td></tr>
				    <tr><td>Kewarganegaraan</td><td><?php echo $kewarganegaraan; ?></td></tr>
				    <tr><td>Tujuan Pembukaan Rek</td><td><?php echo $tujuan_pembukaan_rek; ?></td></tr>
				    <tr><td>Keluarga Bapepti</td><td><?php echo $keluarga_bapepti; ?></td></tr>
				    <tr><td>Status Pailit</td><td><?php echo $status_pailit; ?></td></tr>
				    <tr><td>Nama Rekan</td><td><?php echo $nama_rekan; ?></td></tr>
				    <tr><td>Telepon Rekan</td><td><?php echo $telepon_rekan; ?></td></tr>
				    <tr><td>Hubungan Rekan</td><td><?php echo $hubungan_rekan; ?></td></tr>
				    <tr><td>Alamat Rekan</td><td><?php echo $alamat_rekan; ?></td></tr>
				    <tr><td>Kode Pos Rekan</td><td><?php echo $kode_pos_rekan; ?></td></tr>
				    <tr><td>Pekerjaan</td><td><?php echo $pekerjaan; ?></td></tr>
				    <tr><td>Nama Perusahaan</td><td><?php echo $nama_perusahaan; ?></td></tr>
				    <tr><td>Bidang Usaha</td><td><?php echo $bidang_usaha; ?></td></tr>
				    <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
				    <tr><td>Lama Kerja</td><td><?php echo $lama_kerja; ?></td></tr>
				    <tr><td>Alamat Kantor</td><td><?php echo $alamat_kantor; ?></td></tr>
				    <tr><td>Kode Pos Kantor</td><td><?php echo $kode_pos_kantor; ?></td></tr>
				    <tr><td>Telepon Kantor</td><td><?php echo $telepon_kantor; ?></td></tr>
				    <tr><td>Faksimili Kantor</td><td><?php echo $faksimili_kantor; ?></td></tr>
				    <tr><td>Kantor Sebelumnya</td><td><?php echo $kantor_sebelumnya; ?></td></tr>
				    <tr><td>Pendapatan Pertahun</td><td><?php echo $pendapatan_pertahun; ?></td></tr>
				    <tr><td>Lokasi Rumah</td><td><?php echo $lokasi_rumah; ?></td></tr>
				    <tr><td>Njob</td><td><?php echo $njob; ?></td></tr>
				    <tr><td>Deposit Bank</td><td><?php echo $deposit_bank; ?></td></tr>
				    <tr><td>Jumlah Kekayaan</td><td><?php echo $jumlah_kekayaan; ?></td></tr>
				    <tr><td>Kekayaan Lainnya</td><td><?php echo $kekayaan_lainnya; ?></td></tr>
				    <tr><td>Pict Identitas</td><td><img width="50%" src="<?= base_url() ?>uploads/photo/<?php echo $pict_identitas; ?>"></td></tr>
				    <tr><td>Foto Terkini</td><td><img width="50%" src="<?= base_url() ?>uploads/photo/<?php echo $foto_terkini; ?>"></td></tr>
				    <tr><td>Foto NPWP</td><td><img width="50%" src="<?= base_url() ?>uploads/photo/<?php echo $foto_npwp; ?>"></td></tr>
				    <tr><td>Scan/foto rekening koran/rekening telpon/buku tabungan</td><td><img width="50%" src="<?= base_url() ?>uploads/photo/<?php echo $foto_buku_tabungan; ?>"></td></tr>
				    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
				  <tr><td><a  class="btn bg-purple" href="javascript:window.history.go(-1);" >Kembali</a></td></tr>
				</table>
            </div>
        </div>
    </div>
</div>