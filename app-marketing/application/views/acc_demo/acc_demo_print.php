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
    <h3 align="center">DATA Acc Demo</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
      <tr>
        <th>No</th>
    		<th>No Akun</th>
    		<th>Nama Nasabah</th>
    		<th>Email Nasabah</th>
    		<th>Tipe Akun</th>
    		<th>Tanggal Buat Akun</th>
    		<th>Status Aktif</th>
		  </tr>
      <?php foreach ($acc_demo_data as $acc_demo) { ?>
        <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $acc_demo->no_akun ?></td>
		      <td><?php echo $acc_demo->nama_lengkap ?></td>
		      <td><?php echo $acc_demo->email ?></td>
		      <td><?php echo $acc_demo->type ?></td>
		      <td><?php echo $acc_demo->tanggal_buat_akun ?></td>
		      <td><?php echo $acc_demo->status_aktif ?></td>
        </tr>
      <?php } ?>
    </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>