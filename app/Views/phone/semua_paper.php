
<!--S:DETAIL-->


<div class="detail">
 	<?php
	foreach($semua->result_array() as $head){
		?>
	<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
		<div class="date"></div>
		<h1 class="jdl"><? echo $head['judul_paper'];?></h1>
		<div class="clearfix"></div>
	</div>
	<!--E:JUDUL ARTICLE-->
   
		<!--S:ISI ARTICLE-->
	<div class="text_detail detail_area" id="detikdetailtext">
    
			<object data="<?php echo base_url(); ?>asset/banner/<? echo $head['kop_bawah'];?>#page=2" type="application/pdf" width="100%" height="500">
   
</object>
                 <p><b>Example fallback content</b>: This browser does not support PDFs. Please download the PDF to view it: <a target="_BLANK" href="<?php echo base_url(); ?>asset/banner/<? echo $head['kop_bawah'];?>">Download</a>.</p>
               </div>
		
						                	                		               

</article>
          <?php } ?>      
<!--E:ISI ARTICLE-->

<div class="detail_area" align="center">
		<!--S:SHARE BOX-->
	



   <?php echo $paginator;?>
        <div class="clearfix"></div>

	<!--E:SHARE BOX-->
	
	
</div>
	</div>

	
			
		
		
</div>