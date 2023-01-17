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
    <h3 align="center">DATA Users Pesan</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
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
<script type="text/javascript">
      window.print()
    </script>
</html>