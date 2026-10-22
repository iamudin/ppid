
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
   <p><b>Browser anda tidak mendukung PDFs.</b> Silahkan download terlebih dahulu untuk melihat PDF ini: <a href="<?php echo base_url(); ?>media/file/<? echo $file;?>">Klik disini</a>.</p>
</object>
               </div>
		
						                	                		               

</article>
                <? } ?> 
<!--E:ISI ARTICLE-->
<div class="detail_area">
		<!--S:SHARE BOX-->
	


<center><div class="share-bot-new">
    <strong>Sebarkan Informasi:</strong><br><br>
    <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>
        <div class="clearfix"></div>
</div></center>
	<!--E:SHARE BOX-->
	
	
</div>
	</div>

	
			
		
		
</div>