<div class="title_box dasar">
		<span>Video</span>
</div>
 <!-- s:hl -->

 <!-- e:hl -->
 
 <!-- s:list -->
 
 <div id="newsfeed-container" class="list_feed">
   <?php
foreach($semua->result_array() as $b)
{
	?> 
<article>
 <a href="<?php echo base_url(); ?>mobile/detailvideo/<? echo $b['id_video'];?>/<? echo $b['permalink'];?>" class="list">
  <div class="ratio4_3 box_img">
 <div class="img_con">
 <img src="<?php echo base_url(); ?>asset/banner/<? echo $b['gambar'];?>" alt="<? echo $b['judul_video'];?>" title="<? echo $b['judul_video'];?>" class=""> </div>
 </div>
 <div class="text">
 <h2><? echo $b['judul_video'];?></h2>
 <span class="info"> <?php echo tgl_indo($b['tanggal']); ?></span>
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
