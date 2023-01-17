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
    <h3 align="center">DATA Deposit</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>No Akun</th>
		<th>Nama Nasabah</th>
		<th>Email Nasabah</th>
		<th>Total</th>
		<th>Type Deposit</th>
		<th>Status Deposit</th>
		<th>Tanggal Deposit</th>
		
            </tr><?php
            foreach ($deposit_data as $deposit)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $deposit->no_akun ?></td>
		      <td><?php echo $deposit->nama_lengkap ?></td>
		      <td><?php echo $deposit->email ?></td>
		      <td><?php echo $deposit->total ?></td>
		      <td><?php echo $deposit->type_deposit ?></td>
		      <td><?php echo $deposit->status_deposit ?></td>
		      <td><?php echo $deposit->tanggal_deposit ?></td>
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