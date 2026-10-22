<div class="title_box dasar">
		<span><?php echo $mm;?></span>
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
 <a href="<?php echo base_url(); ?>mobile/detailcoretan/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>" class="list">
  <div class="ratio4_3 box_img">
 <div class="img_con">
 <img src="<?php echo base_url(); ?>asset/berita/large/<? echo $bi['gambar'];?>" alt="<? echo $bi['judul_berita'];?>" title="<? echo $bi['judul_berita'];?>" class=""> </div>
 </div>
 <div class="text">
  <span class="post-category <? echo $bi['permalink'];?>">
				<? echo $bi['title'];?>				</span>
 <span class="sub"><? echo $bi['anak'];?></span>
 <h2><? echo $bi['judul_berita'];?>	</h2>
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
