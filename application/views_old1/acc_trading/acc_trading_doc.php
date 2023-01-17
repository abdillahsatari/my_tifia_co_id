<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Acc_trading List</h2>
        <table class="word-table" style="margin-bottom: 10px">
      <tr>
          <th>No</th>
          <th>No Akun</th>
      		<th>Nama Nasabah</th>
      		<th>Email Nasabah</th>
      		<th>Tipe Akun</th>
      		<th>Nilai Tukar</th>
          <th>Leverage</th>
      		<th>Komisi</th>
      		<th>Tanggal Buat Akun</th>
      		<th>Status Aktif</th>
      </tr>
      <?php foreach ($acc_trading_data as $acc_trading) { ?>
        <tr>
		      <td><?php echo ++$start ?></td>
          <td><?php echo $acc_trading->no_akun ?></td>
          <td><?php echo $acc_trading->nama_lengkap ?></td>
          <td><?php echo $acc_trading->email ?></td>
          <td><?php echo $acc_trading->type ?></td>
          <td><?php echo $acc_trading->nama_currency ?></td>
          <td><?php echo $acc_trading->nama_leverage ?></td>
		      <td><?php echo $acc_trading->komisi ?></td>
		      <td><?php echo $acc_trading->tanggal_buat_akun ?></td>
		      <td><?php echo $acc_trading->status_aktif ?></td>
        </tr>
      <?php } ?>
    </table>
    </body>
</html>