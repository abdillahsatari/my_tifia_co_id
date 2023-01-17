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
    <h3 align="center">DATA Nasabah Pesan</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
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
<script type="text/javascript">
      window.print()
    </script>
</html>