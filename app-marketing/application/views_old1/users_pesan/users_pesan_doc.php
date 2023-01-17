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
        <h2>Users_pesan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
        <th>Email</th>
		<th>Subject</th>
		<th>Isi</th>
		<th>Tanggal</th>
		<th>User</th>
		
            </tr><?php
            foreach ($users_pesan_data as $users_pesan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $users_pesan->nama_lengkap ?></td>
              <td><?php echo $users_pesan->emailnasabah ?></td>
		      <td><?php echo $users_pesan->subject ?></td>
		      <td><?php echo $users_pesan->isi ?></td>
		      <td><?php echo $users_pesan->date ?></td>
		      <td><?php echo $users_pesan->username ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>