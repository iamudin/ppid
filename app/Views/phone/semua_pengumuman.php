<div class="title_box dasar">
		<span>Pengumuman</span>
</div>
 <!-- s:hl -->

 <!-- e:hl -->
 
 <!-- s:list -->
 
 <div id="newsfeed-container" class="list_feed">
   <?php
$nom=$page+1;
foreach($semua->result_array() as $pengumuman)
{
		?>
<article>
 <a href="<?php echo base_url(); ?>mobile/detailpengumuman/<? echo $pengumuman['id_pengumuman'];?>/<? echo $pengumuman['permalink'];?>" class="list list_most">
  <div class="no"><?php echo $nom;?></div>
 <div class="text">
 <h2><? echo $pengumuman['judul_pengumuman'];?>	</h2>
 <span class="info"><? echo tgl_indo($pengumuman['tanggal']);?></span>
 </div>

 <div class="clearfix"></div>
 
 </a>
</article>
<?php $nom++; } ?>





 

 <div align="center" id="newsfeed-more-news" class="more_news more-trigger">
 <p align="center" class="halaman"><?php echo $paginator;?></p>
 </div>
 


 
 <div class="clearfix"></div>
</div> <!-- e:community -->
