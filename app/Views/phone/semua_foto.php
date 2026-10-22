<div class="title_box dasar">
		<span>Galeri Foto</span>
</div>
 <!-- s:hl -->

 <!-- e:hl -->
 
 <!-- s:list -->
 
 <div id="newsfeed-container" class="list_feed">
   <?php
	foreach($semua->result_array() as $head){
		?>
<article>
 <a href="<?php echo base_url(); ?>mobile/detailfoto/<? echo $head['id_album'];?>/<? echo $head['permalink'];?>" class="list">
  <div class="ratio4_3 box_img">
 <div class="img_con">
 <img src="<?php echo base_url(); ?>asset/galeri/original/<? echo $head['foto_besar'];?>" alt="<? echo $head['nama_album'];?>" title="<? echo $head['nama_album'];?>" class=""> </div>
 </div>
 <div class="text">
 <h2><? echo $head['nama_album'];?></h2>
 <span class="info"> <?php echo tgl_indo($head['tanggal_album']); ?></span>
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
