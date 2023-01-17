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
        <h2>Deposit List</h2>
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
</html>