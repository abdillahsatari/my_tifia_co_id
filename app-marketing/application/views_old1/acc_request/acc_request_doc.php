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
        <h2>Acc_request List</h2>
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
</html>