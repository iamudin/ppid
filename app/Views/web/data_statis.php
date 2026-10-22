
	<!--  blog-single-content start-->
	<section id="blog-single-main-detail" class="detail">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-12 col-12">
					
						 <?php
foreach($detail->result_array() as $b)
{
    $title=$b['title'];
    ?>
						  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
  <li class="breadcrumb-item active" style="text-transform: capitalize;"><?php echo strtolower($kategori);?></li>
</ol>
						<div class="blog-single-dd-hed">
							<h4><a href="#!"><?php echo $b['title'];?></a></h4><br>
							<div id="isiku"><?php
echo $b['content'];
?></div>
						</div>
						
						
						
						<div class="inner-tahesxx">
							<hr>
							<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d66391c5fea9f001288d5bf&product=inline-share-buttons' async='async'></script>

<div class="sharethis-inline-share-buttons"></div> 
							
						</div>
						
						
						<div class="lave-cooment">
							
						</div>

						 <?php } ?>
				
				</div>
				