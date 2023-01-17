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
        <h2>Acc_currency List</h2>
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
</html>