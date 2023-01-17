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
        <h2>Bank List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nasabah Id</th>
		<th>Nama Bank</th>
		<th>No Rekening</th>
		<th>Cabang</th>
		<th>Jenis Rekening</th>
		<th>Telepon Bank</th>
		<th>Kode Bank</th>
		<th>Atas Nama</th>
		<th>Currency</th>
		<th>Created Date</th>
		<th>Update Date</th>
		<th>Status Bank</th>
		
            </tr><?php
            foreach ($bank_data as $bank)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $bank->nasabah_id ?></td>
		      <td><?php echo $bank->nama_bank ?></td>
		      <td><?php echo $bank->no_rekening ?></td>
		      <td><?php echo $bank->cabang ?></td>
		      <td><?php echo $bank->jenis_rekening ?></td>
		      <td><?php echo $bank->telepon_bank ?></td>
		      <td><?php echo $bank->kode_bank ?></td>
		      <td><?php echo $bank->atas_nama ?></td>
		      <td><?php echo $bank->currency ?></td>
		      <td><?php echo $bank->created_date ?></td>
		      <td><?php echo $bank->update_date ?></td>
		      <td><?php echo $bank->status_bank ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>