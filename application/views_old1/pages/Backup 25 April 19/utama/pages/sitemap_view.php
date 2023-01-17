<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
 <url>
 <loc><?php echo base_url();?></loc>
 <priority>1.0</priority>
 </url>

<!-- Sitemap Blog Syamsagroup -->
<?php foreach($contentblog as $key => $value) { ?>
 <url>
 <loc><?php echo base_url()."blog/detail/" .$value->judul; ?></loc><br>
 <priority>0.5</priority>
 </url>
 <?php } ?> 


</urlset>