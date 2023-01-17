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
    <h3 align="center">DATA Acc Trading</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
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
  <script type="text/javascript">
    window.print()
  </script>
</html>