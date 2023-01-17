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
    <h3 align="center">DATA Contact</h3>
    <h4>Tanggal Cetak : <?= date("d/M/Y");?> </h4>
    <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Address</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Date Of Birth</th>
		
            </tr><?php
            foreach ($contact_data as $contact)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $contact->id ?></td>
		      <td><?php echo $contact->first_name ?></td>
		      <td><?php echo $contact->last_name ?></td>
		      <td><?php echo $contact->address ?></td>
		      <td><?php echo $contact->email ?></td>
		      <td><?php echo $contact->phone ?></td>
		      <td><?php echo $contact->date_of_birth ?></td>	
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