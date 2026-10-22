<div class="title_box dasar">
		<span><? echo $bread;?></span>
</div>
 <!-- s:hl -->

 <!-- e:hl -->
 
 <!-- s:list -->
 
 <div id="newsfeed-container" class="list_feed">
   <?php
$nom=1;
 foreach($semua->result_array() as $bi){
	    $file = str_replace('media/file/','',$bi['file']);
		?>
<article>
 <a href="<?php echo base_url(); ?>mobile/tampilstatistik/<? echo $bi['id_statistik'];?>" class="list list_most">
  <div class="no"><?php echo $nom;?></div>
 <div class="text">
 <h2><? echo $bi['judul'];?>	</h2>
 <span class="info"><? echo tgl_indo($bi['tanggal']);?></span>
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
