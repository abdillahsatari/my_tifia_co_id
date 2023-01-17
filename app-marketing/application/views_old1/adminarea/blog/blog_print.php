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
    <h3 align="center">DATA Blog</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Blog Kategori Id</th>
		<th>Gambar</th>
		<th>Judul</th>
		<th>Content</th>
		<th>Status</th>
		<th>Date</th>
		
            </tr><?php
            foreach ($blog_data as $blog)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $blog->blog_kategori_id ?></td>
		      <td><?php echo $blog->gambar ?></td>
		      <td><?php echo $blog->judul ?></td>
		      <td><?php echo $blog->content ?></td>
		      <td><?php echo $blog->status ?></td>
		      <td><?php echo $blog->date ?></td>	
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