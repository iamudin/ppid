
<!--S:DETAIL-->


<div class="detail">
   <?php
foreach($semua->result_array() as $b)
{
	$file = str_replace('media/file/','',$b['file']);
	?>
	<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
		<div class="date"></div>
		<h1 class="jdl"><?php echo $b['download'];?></h1>
		<div class="clearfix"></div>
	</div>
	<!--E:JUDUL ARTICLE-->
   
		<!--S:ISI ARTICLE-->
	<div class="text_detail detail_area" id="detikdetailtext">
			  <object data="<?php echo base_url(); ?>media/file/<? echo $file;?>#page=2" type="application/pdf" width="100%" height="1000">
   <p><b>Example fallback content</b>: This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo base_url(); ?>media/file/<? echo $file;?>">Download</a>.</p>
</object>
               </div>
		
						                	                		               

</article>
                <? } ?> 
<!--E:ISI ARTICLE-->
<div class="detail_area">
		<!--S:SHARE BOX-->
	


<div align="center" id="newsfeed-more-news" class="more_news more-trigger">
 <p align="center" class="halaman"><?php echo $paginator;?></p>
 </div>
	<!--E:SHARE BOX-->
	
	
</div>
	</div>

	
			
		
		
</div>