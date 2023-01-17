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
    <h3 align="center">DATA Bank</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
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
<script type="text/javascript">
      window.print()
    </script>
</html>