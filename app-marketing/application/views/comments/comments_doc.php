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
        <h2>Comments List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Comments</th>
		<th>Blog Id</th>
		<th>Fullname</th>
		<th>Email</th>
		<th>Content Comment</th>
		<th>Created At</th>
		<th>Status</th>
		
            </tr><?php
            foreach ($comments_data as $comments)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $comments->id_comments ?></td>
		      <td><?php echo $comments->blog_id ?></td>
		      <td><?php echo $comments->fullname ?></td>
		      <td><?php echo $comments->email ?></td>
		      <td><?php echo $comments->content_comment ?></td>
		      <td><?php echo $comments->created_at ?></td>
		      <td><?php echo $comments->status ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>