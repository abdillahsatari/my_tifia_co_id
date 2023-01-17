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
    <h3 align="center">DATA Acc Request</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
      <tr>
        <th>No</th>
    		<th>Nama Nasabah</th>
        <th>Email Nasabah</th>
    		<th>Nilai Tukar</th>
    		<th>Tipe Akun</th>
    		<th>Leverage</th>
    		<th>Tanggal Request</th>
    		<th>Status</th>
		  </tr>
      <?php foreach ($acc_request_data as $acc_request) { ?>
        <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $acc_request->nama_lengkap ?></td>
          <td><?php echo $acc_request->email ?></td>
		      <td><?php echo $acc_request->nama_currency ?></td>
		      <td><?php echo $acc_request->type ?></td>
		      <td><?php echo $acc_request->nama_leverage ?></td>
		      <td><?php echo $acc_request->date ?></td>
		      <td><?php echo $acc_request->status_request ?></td>	
        </tr>
      <?php } ?>
    </table>
</body>
<script type="text/javascript">
      window.print()
    </script>
</html>