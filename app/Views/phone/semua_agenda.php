<div class="title_box dasar">
		<span>Agenda Kegiatan</span>
</div>
 <!-- s:hl -->

 <!-- e:hl -->
 
 <!-- s:list -->
 
 <div id="newsfeed-container" class="list_feed">
   <?php
$nom=$page+1;
foreach($semua->result_array() as $bi)
{
		?>
<article>
 <a href="<?php echo base_url(); ?>mobile/detailagenda/<? echo $bi['id_agenda'];?>/<? echo $bi['permalink'];?>" class="list list_most">
  <div class="no"><?php echo $nom;?></div>
 <div class="text">
 <h2><? echo $bi['tema_agenda'];?>	</h2>
 <span class="info"><? echo tgl_indo($bi['tgl_mulai']);?></span>
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
