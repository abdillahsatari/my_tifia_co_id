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
    <h3 align="center">DATA Marketing</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
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
<script type="text/javascript">
      window.print()
    </script>
</html>