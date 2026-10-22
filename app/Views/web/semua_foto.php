<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Galeri Kegiatan</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
					<div class="row">
			  <?php
	foreach($semua->result_array() as $head){
		
		$isi=$head['nama_album'];
		?><div class="col-lg-4 col-md-6 col-sm-6 col-12">
				<div class="des-cov2 bg-white" style="text-align: center;margin-bottom: 20px;">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailfoto/<? echo $head['id_album'];?>/<? echo $head['permalink'];?>"><img src="<?php echo base_url(); ?>asset/galeri/original/<? echo $head['foto_besar'];?>" alt=""></a>
					</div>
					<div class="des-para">
						<div class="dayt">
							<p><a href="<?php echo base_url(); ?>web/detailvideo/<? echo $bi['id_video'];?>/<? echo $bi['permalink'];?>"><? echo $isi;?>	</a></p>
							
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