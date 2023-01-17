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
    <h3 align="center">DATA Withdraw</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>No. Withdraw</th>
    <th>Nama Nasabah</th>
        <th>Email Nasabah</th>
    <th>No Akun</th>
    <th>Total</th>
    <th>Status Withdraw</th>
    <th>Tanggal Withdraw</th>
    
            </tr><?php
            foreach ($withdraw_data as $withdraw)
            {
                ?>
                <tr>
          <td><?php echo ++$start ?></td>
          <td><?php echo $withdraw->withdraw_id ?></td>
          <td><?php echo $withdraw->nama_lengkap ?></td>
          <td><?php echo $withdraw->email ?></td>
          <td><?php echo $withdraw->no_akun ?></td>
          <td><?php echo number_format($withdraw->total) ?></td>
          <td><?php echo $withdraw->status_withdraw ?></td>
          <td><?php echo $withdraw->tanggal_withdraw ?></td>
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