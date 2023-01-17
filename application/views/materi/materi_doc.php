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
        <h2>Materi List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Materi Kategori Id</th>
		<th>Gambar Id</th>
		<th>Judul</th>
		<th>Isi</th>
		<th>Date</th>
		
            </tr><?php
            foreach ($materi_data as $materi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $materi->materi_kategori_id ?></td>
		      <td><?php echo $materi->gambar_id ?></td>
		      <td><?php echo $materi->judul ?></td>
		      <td><?php echo $materi->isi ?></td>
		      <td><?php echo $materi->date ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>