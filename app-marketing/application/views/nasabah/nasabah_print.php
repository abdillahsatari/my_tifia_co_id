<!DOCTYPE html>
<html>
<head>
    <title>Tittle</title>
    <style type="text/css" media="print">
    @page {
        margin: 0;  /* this affects the margin in the printer settings */
    }
      table{
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
      }
      table th{
          -webkit-print-color-adjust:exact;
        border: 1px solid;

                padding-top: 11px;
    padding-bottom: 11px;
    background-color: #a29bfe;
      }
   table td{
        border: 1px solid;

   }
        </style>
</head>
<body>
    <h3 align="center">DATA Nasabah</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Lengkap</th>
		<th>Gender</th>
		<th>No Hp</th>
		<th>Email</th>
		<th>Password</th>
		<th>Tempat Lahir</th>
		<th>Tgl Lahir</th>
		<th>Alamat Rumah</th>
		<th>Kode Pos</th>
		<th>Jenis Identitas</th>
		<th>No Identitas</th>
		<th>Status Kawin</th>
		<th>Nama Pasangan</th>
		<th>Nama Ibu</th>
		<th>No Tlp</th>
		<th>No Faksimili</th>
		<th>No Npwp</th>
		<th>Alamat Surat Menyurat</th>
		<th>Status Rumah</th>
		<th>Pengalaman Investasi</th>
		<th>Kewarganegaraan</th>
		<th>Tujuan Pembukaan Rek</th>
		<th>Keluarga Bapepti</th>
		<th>Status Pailit</th>
		<th>Nama Rekan</th>
		<th>Telepon Rekan</th>
		<th>Hubungan Rekan</th>
		<th>Alamat Rekan</th>
		<th>Kode Pos Rekan</th>
		<th>Pekerjaan</th>
		<th>Nama Perusahaan</th>
		<th>Bidang Usaha</th>
		<th>Jabatan</th>
		<th>Lama Kerja</th>
		<th>Alamat Kantor</th>
		<th>Kode Pos Kantor</th>
		<th>Telepon Kantor</th>
		<th>Faksimili Kantor</th>
		<th>Kantor Sebelumnya</th>
		<th>Pendapatan Pertahun</th>
		<th>Lokasi Rumah</th>
		<th>Njob</th>
		<th>Deposit Bank</th>
		<th>Jumlah Kekayaan</th>
		<th>Kekayaan Lainnya</th>
		<th>Pict Identitas</th>
		<th>Foto Terkini</th>
		<th>Jenis Dokumen Tambahan</th>
		<th>Dokumen Tambahan</th>
		<th>Perusahaan Simulasi</th>
		<th>Penyelesaian Perselisihan</th>
		<th>Daftar Kantor</th>
		<th>Status</th>
		<th>Status Verify</th>
		<th>Is Active</th>
		<th>Komentar</th>
		<th>Nasabah Role Id</th>
		<th>Created Date</th>
		<th>User Id</th>
		<th>Update Date</th>
		<th>Update User Id</th>
		
            </tr><?php
            foreach ($nasabah_data as $nasabah)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $nasabah->nama_lengkap ?></td>
		      <td><?php echo $nasabah->gender ?></td>
		      <td><?php echo $nasabah->no_hp ?></td>
		      <td><?php echo $nasabah->email ?></td>
		      <td><?php echo $nasabah->password ?></td>
		      <td><?php echo $nasabah->tempat_lahir ?></td>
		      <td><?php echo $nasabah->tgl_lahir ?></td>
		      <td><?php echo $nasabah->alamat_rumah ?></td>
		      <td><?php echo $nasabah->kode_pos ?></td>
		      <td><?php echo $nasabah->jenis_identitas ?></td>
		      <td><?php echo $nasabah->no_identitas ?></td>
		      <td><?php echo $nasabah->status_kawin ?></td>
		      <td><?php echo $nasabah->nama_pasangan ?></td>
		      <td><?php echo $nasabah->nama_ibu ?></td>
		      <td><?php echo $nasabah->no_tlp ?></td>
		      <td><?php echo $nasabah->no_faksimili ?></td>
		      <td><?php echo $nasabah->no_npwp ?></td>
		      <td><?php echo $nasabah->alamat_surat_menyurat ?></td>
		      <td><?php echo $nasabah->status_rumah ?></td>
		      <td><?php echo $nasabah->pengalaman_investasi ?></td>
		      <td><?php echo $nasabah->kewarganegaraan ?></td>
		      <td><?php echo $nasabah->tujuan_pembukaan_rek ?></td>
		      <td><?php echo $nasabah->keluarga_bapepti ?></td>
		      <td><?php echo $nasabah->status_pailit ?></td>
		      <td><?php echo $nasabah->nama_rekan ?></td>
		      <td><?php echo $nasabah->telepon_rekan ?></td>
		      <td><?php echo $nasabah->hubungan_rekan ?></td>
		      <td><?php echo $nasabah->alamat_rekan ?></td>
		      <td><?php echo $nasabah->kode_pos_rekan ?></td>
		      <td><?php echo $nasabah->pekerjaan ?></td>
		      <td><?php echo $nasabah->nama_perusahaan ?></td>
		      <td><?php echo $nasabah->bidang_usaha ?></td>
		      <td><?php echo $nasabah->jabatan ?></td>
		      <td><?php echo $nasabah->lama_kerja ?></td>
		      <td><?php echo $nasabah->alamat_kantor ?></td>
		      <td><?php echo $nasabah->kode_pos_kantor ?></td>
		      <td><?php echo $nasabah->telepon_kantor ?></td>
		      <td><?php echo $nasabah->faksimili_kantor ?></td>
		      <td><?php echo $nasabah->kantor_sebelumnya ?></td>
		      <td><?php echo $nasabah->pendapatan_pertahun ?></td>
		      <td><?php echo $nasabah->lokasi_rumah ?></td>
		      <td><?php echo $nasabah->njob ?></td>
		      <td><?php echo $nasabah->deposit_bank ?></td>
		      <td><?php echo $nasabah->jumlah_kekayaan ?></td>
		      <td><?php echo $nasabah->kekayaan_lainnya ?></td>
		      <td><?php echo $nasabah->pict_identitas ?></td>
		      <td><?php echo $nasabah->foto_terkini ?></td>
		      <td><?php echo $nasabah->jenis_dokumen_tambahan ?></td>
		      <td><?php echo $nasabah->dokumen_tambahan ?></td>
		      <td><?php echo $nasabah->perusahaan_simulasi ?></td>
		      <td><?php echo $nasabah->penyelesaian_perselisihan ?></td>
		      <td><?php echo $nasabah->daftar_kantor ?></td>
		      <td><?php echo $nasabah->status ?></td>
		      <td><?php echo $nasabah->status_verify ?></td>
		      <td><?php echo $nasabah->is_active ?></td>
		      <td><?php echo $nasabah->komentar ?></td>
		      <td><?php echo $nasabah->nasabah_role_id ?></td>
		      <td><?php echo $nasabah->created_date ?></td>
		      <td><?php echo $nasabah->user_id ?></td>
		      <td><?php echo $nasabah->update_date ?></td>
		      <td><?php echo $nasabah->update_user_id ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>