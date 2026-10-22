<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6>Struktur </h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			<div class="row">
					<?php
	    foreach($semua->result_array() as $g){
		?>
		<div class="col-lg-4 col-md-6 col-sm-6 col-12">
				<div class="des-cov">
					<div class="des-img">
						<a href=""><img src="<?php echo base_url(); ?>asset/pegawai/<? echo $g['gambar'];?>" alt=""></a>
					</div>
					<div class="des-para">
						<div class="dayt">
							<h6><a href=""><? echo $g['nama_pegawai'];?></a></h6>
							
						</div>
						<div class="dayt">
							<p><? echo $g['jabatan'];?></p>
							
						</div>
						
						
					</div>
				</div>
			</div>
			<?php } ?>
				</div>
				
				
			
			<!--Model box-->
			<br>

						
		</div>
	</section>
	<!-- team end-->