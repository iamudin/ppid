
<!--S:DETAIL-->


<div class="detail">
 	<?php
	foreach($semua->result_array() as $head){
		?>
	<article>
	<!--S:JUDUL ARTICLE-->

	<!--E:JUDUL ARTICLE-->
   
		<!--S:ISI ARTICLE-->
	<div class="text_detail detail_area" id="detikdetailtext">
    
		<?php
	foreach($semua->result_array() as $head){
		?>
     <div class="clearfix"></div>
    
         
 <a href="<?php echo base_url(); ?>mobile/link/pantun" target="_blank">
<img width="100%"  src="<?php echo base_url(); ?>Pantun.jpg" >
 </a>                    
          
        
                <div class="quote"><i class="fa fa-quote-left fa-4x"></i></div>
			
                    <p class="bubble"><?php echo $head['isi'];?></p>
			  <h6>&mdash; <? echo $head['judul'];?></h6>
        

       
     
      <?php } ?>
               
               </div>
		
						                	                		               

</article>
          <?php } ?>      
<!--E:ISI ARTICLE-->

<div class="detail_area" align="center">
		<!--S:SHARE BOX-->
	<div class="share-bot-new">
    <strong>Sebarkan Informasi:</strong><br><br>
    <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>
        <div class="clearfix"></div>
</div>
	<!--E:SHARE BOX-->

<div class="clearfix"></div>

   <?php echo $paginator;?>
        <div class="clearfix"></div>

	<!--E:SHARE BOX-->
	
	
</div>
	</div>

	
			
		
		
</div>