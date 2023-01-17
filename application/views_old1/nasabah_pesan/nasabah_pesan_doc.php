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
        <h2>Nasabah_pesan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>No Pesan</th>
    <th>Nama</th>
    <th>Email</th>
        <th>Tujuan</th>
        <th>Subject</th>
        <th>Isi</th>
        <th>Status</th>
        <th>Tanggal</th>
        
            </tr><?php
            foreach ($nasabah_pesan_data as $nasabah_pesan)
            {
                ?>
                <tr>
              <td><?php echo ++$start ?></td>
              <td><?php echo $nasabah_pesan->nasabah_pesan_id ?></td>
          <td><?php echo $nasabah_pesan->nama_lengkap ?></td>
          <td><?php echo $nasabah_pesan->email ?></td>
              <td><?php echo $nasabah_pesan->tujuan ?></td>
              <td><?php echo $nasabah_pesan->subject ?></td>
              <td><?php echo $nasabah_pesan->isi ?></td>
              <td><?php echo $nasabah_pesan->status ?></td>
              <td><?php echo $nasabah_pesan->create_date ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>