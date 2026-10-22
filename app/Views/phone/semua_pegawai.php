<div class="title_box dasar">
		<span>Kepegawaian</span>
</div>
 <!-- s:hl -->

 <!-- e:hl -->
 
 <!-- s:list -->
 
 <div id="newsfeed-container" class="list_feed">
   <?php

foreach($semua->result_array() as $g)
{
		?>
<article>
 <a href="#" class="list">

 <div class="text">
 <h2><? echo $g['nama_pegawai'];?></h2>
 <span class="info"> <? echo $g['jabatan'];?></span>
 </div>
  <div class="ratio4_3 box_img">
 <div class="img_con">
 <img src="<?php echo base_url(); ?>asset/pegawai/<? echo $g['gambar'];?>" alt="<? echo $g['nama_pegawai'];?>" title="<? echo $g['nama_pegawai'];?>" class=""> </div>
 </div>
 <div class="clearfix"></div>
 
 </a>
</article>
<?php  } ?>





 

 <div align="center" id="newsfeed-more-news" class="more_news more-trigger">
 <p align="center" class="halaman"><?php echo $paginator;?></p>
 </div>
 


 
 <div class="clearfix"></div>
</div> <!-- e:community -->
