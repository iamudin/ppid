<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Video Informasi</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
					<div class="row">
				 <?php
$no=1;
foreach($semua->result_array() as $bi)
{
?><div class="col-lg-4 col-md-6 col-sm-6 col-12">
				<div class="des-cov2 bg-white" style="text-align: center;margin-bottom: 20px;">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailvideo/<? echo $bi['id_video'];?>/<? echo $bi['permalink'];?>"><img src="<?php echo base_url(); ?>asset/banner/<? echo $bi['gambar'];?>" alt=""></a>
					</div>
					<div class="des-para">
						<div class="dayt">
							<p><a href="<?php echo base_url(); ?>web/detailvideo/<? echo $bi['id_video'];?>/<? echo $bi['permalink'];?>"><? echo $bi['judul_video'];?>	</a></p>
							
						</div>
						
						
					</div>
				</div></div>
			<?php } ?>
					
					</div>
				
			
			<!--Model box-->
			
 <!-- pagination start -->
					<div class="blog-pagination d-flex justify-content-center text-center">
						<div class="wrapper blog-wrapper">
							<?php echo $paginator;?>
						</div>
					</div>
		     	<!-- pagination end -->
						
		</div>
	</section>
	<!-- team end-->