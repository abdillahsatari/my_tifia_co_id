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
        <h2>Marketing List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Ktp</th>
		<th>Tlp</th>
		<th>Email</th>
		<th>Facebook</th>
		<th>Pengalaman</th>
		<th>Info</th>
		
            </tr><?php
            foreach ($marketing_data as $marketing)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $marketing->nama ?></td>
		      <td><?php echo $marketing->alamat ?></td>
		      <td><?php echo $marketing->ktp ?></td>
		      <td><?php echo $marketing->tlp ?></td>
		      <td><?php echo $marketing->email ?></td>
		      <td><?php echo $marketing->facebook ?></td>
		      <td><?php echo $marketing->pengalaman ?></td>
		      <td><?php echo $marketing->info ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>