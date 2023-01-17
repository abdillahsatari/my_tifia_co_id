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
    <h3 align="center">DATA Acc Currency</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Currency</th>
		<th>Deposit Rate</th>
		<th>Withdraw Rate</th>
		<th>Status Currency</th>
		<th>Tgl Update Cdeposit</th>
		<th>Tgl Update Cwithdraw</th>
		
            </tr><?php
            foreach ($acc_currency_data as $acc_currency)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $acc_currency->nama_currency ?></td>
		      <td><?php echo $acc_currency->deposit_rate ?></td>
		      <td><?php echo $acc_currency->withdraw_rate ?></td>
		      <td><?php echo $acc_currency->status_currency ?></td>
		      <td><?php echo $acc_currency->tgl_update_cdeposit ?></td>
		      <td><?php echo $acc_currency->tgl_update_cwithdraw ?></td>	
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