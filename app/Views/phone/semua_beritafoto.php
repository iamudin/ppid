<div class="title_box dasar">
		<span>Berita Foto</span>
</div>
 <!-- s:hl -->

 <!-- e:hl -->
 
 <!-- s:list -->
 
 <div id="newsfeed-container" class="list_feed">
   	<?php
foreach($semua->result_array() as $bi)
{
?>
<article>
 <a href="<?php echo base_url(); ?>mobile/detailberitafoto/<? echo $bi['id_beritafoto'];?>/<? echo $bi['permalink'];?>" class="list">
  <div class="ratio4_3 box_img">
 <div class="img_con">
 <img src="<?php echo base_url(); ?>asset/banner/<? echo $bi['gambar'];?>" alt="<? echo $bi['judul_beritafoto'];?>" title="<? echo $bi['judul_beritafoto'];?>" class=""> </div>
 </div>
 <div class="text">
 <h2><? echo $bi['judul_beritafoto'];?></h2>
 <span class="info"> <?php echo tgl_indo($bi['tanggal']); ?></span>
 </div>

 <div class="clearfix"></div>
 
 </a>
</article>
<?php } ?>





 

 <div align="center" id="newsfeed-more-news" class="more_news more-trigger">
 <p align="center" class="halaman"><?php echo $paginator;?></p>
 </div>
 


 
 <div class="clearfix"></div>
</div> <!-- e:community -->
