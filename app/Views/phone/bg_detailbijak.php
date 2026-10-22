
<!--S:DETAIL-->


<div class="detail">
 	<?php
	foreach($semua->result_array() as $head){
		?>
	<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
		<div class="date"></div>
		<h1 class="jdl">Bijak ber-Media Sosial</h1>
		<div class="clearfix"></div>
	</div>
	<!--E:JUDUL ARTICLE-->
   
		<!--S:ISI ARTICLE-->
	<div class="text_detail detail_area" id="detikdetailtext">
    
<img width="100%"  src="<?php echo base_url(); ?>asset/bijak/<? echo $head['foto_besar'];?>" >
	
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
<!--E:ISI ARTICLE-->
<div class="detail_area">
		<!--S:SHARE BOX-->
	


<div class="share-bot-new">
    <strong>Sebarkan Informasi:</strong><br><br>
    <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>
        <div class="clearfix"></div>
</div>
	<!--E:SHARE BOX-->
	
	
</div>
	
			
		
		
</div>