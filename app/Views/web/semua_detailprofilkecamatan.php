
<!-- Content -->
<div id="blog-single-atas" align="center" style="margin-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <div class="section-content box-sort-in p-b0 button-example">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	<a href="<?php echo base_url(); ?>web/link/profil-pejabat" class="icon-cell">
                                       <div class="flight-cover">
							<i class="fas fa-building"></i>
							
						</div>
						<p>Pejabat Pimpinan Tinggi Pratama</p></a>
                                    </div>

                                     <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                     	<a href="<?php echo base_url(); ?>web/link/profil-dprd" class="icon-cell">
                                       <div class="flight-cover">
							<i class="fas fa-building"></i>
							
						</div>
						<p>Pimpinan dan Anggota DPRD</p></a>
                                    </div>

                                     <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                 <a href="<?php echo base_url(); ?>web/link/profil-sekda" class="icon-cell">      <div class="flight-cover">
							<i class="fas fa-building"></i>
							
						</div>
						<p>Sekretariat Daerah</p></a>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	  <a href="<?php echo base_url(); ?>web/link/profil-sekwan" class="icon-cell">
                                       <div class="flight-cover">
							<i class="fas fa-building"></i>
							
						</div>
						<p>Sekretariat DPRD</p></a>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	<a href="<?php echo base_url(); ?>web/link/profil-dinas">
                                        <div class="flight-cover">
							<i class="fas fa-building"></i>
							
						</div>
						<p>Dinas/Badan </p></a>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	<a href="<?php echo base_url(); ?>web/link/profil-kecamatan">
                                       <div class="flight-cover">
							<i class="fas fa-building"></i>
							
						</div>
						<p>Kecamatan</p></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	<!-- team end-->
	<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">PROFIL</h6>
			<h2><?php echo $bread;?></h2>
			<div class="dlab-separator-outer ">
<div class="dlab-separator bg-warning style-skew"></div></div>
		</div>
		<div class="content-box">
			
			<h5>Camat</h5>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-lg-4  col-md-6 col-sm-6 col-12"></div>
				
			<?php
	foreach($kadis->result_array() as $bi){
		//$isi=$head['nama_album'];
		?>
				<div class="col-lg-4  col-md-6 col-sm-6 col-12">
					<div class="team-opa">
						<div class="coa-app">
							<a href="<?php echo base_url(); ?>web/detailpejabat/<? echo $bi['id_profil'];?>">
							<img src="<?php echo base_url(); ?>asset/profil/<? echo $bi['foto'];?>" alt="">
							</a>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="col-lg-4  col-md-6 col-sm-6 col-12"></div>
			</div><br><br>
			<div class="content-box">
			
			<h5>Sekretaris</h5>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
			<div class="row">
				<div class="slider-des2 owl-carousel owl-theme">
				 <?php
	foreach($sekre->result_array() as $bi){
		//$isi=$head['nama_album'];
		?>
				<div class="des-cov">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailpejabat/<? echo $bi['id_profil'];?>"><img src="<?php echo base_url(); ?>asset/profil/<? echo $bi['foto'];?>" alt=""></a>
					</div>
					
				</div>
			<?php } ?>
				
				
				
			</div>
			
			</div>
			

		
			<br><br>
			<div class="content-box">
			
			<h5>Kepala Sub Bagian</h5>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
				<div class="row">
				<div class="slider-des2 owl-carousel owl-theme">
				 <?php
	foreach($kasubag->result_array() as $bi){
		//$isi=$head['nama_album'];
		?>
				<div class="des-cov">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailpejabat/<? echo $bi['id_profil'];?>"><img src="<?php echo base_url(); ?>asset/profil/<? echo $bi['foto'];?>" alt=""></a>
					</div>
					
				</div>
			<?php } ?>
				
				
				
			</div>
			
			</div>
			

			<br><br>
			<div class="content-box">
			
			<h5>Kepala Seksi</h5>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
				<div class="row">
				<div class="slider-des2 owl-carousel owl-theme">
				 <?php
	foreach($seksi->result_array() as $bi){
		//$isi=$head['nama_album'];
		?>
				<div class="des-cov">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailpejabat/<? echo $bi['id_profil'];?>"><img src="<?php echo base_url(); ?>asset/profil/<? echo $bi['foto'];?>" alt=""></a>
					</div>
					
				</div>
			<?php } ?>
				
				
				
			</div>
			
			</div>

			<br><br>
			<div class="content-box">
			
			<h5>Staf PNS</h5>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
				<div class="row">
				<div class="slider-des2 owl-carousel owl-theme">
				 <?php
	foreach($pns->result_array() as $bi){
		//$isi=$head['nama_album'];
		?>
				<div class="des-cov">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailpejabat/<? echo $bi['id_profil'];?>"><img src="<?php echo base_url(); ?>asset/profil/<? echo $bi['foto'];?>" alt=""></a>
					</div>
					
				</div>
			<?php } ?>
				
				
				
			</div>
			
			</div>

			<br><br>
			<div class="content-box">
			
			<h5>Staf Honorer</h5>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
				<div class="row">
				<div class="slider-des2 owl-carousel owl-theme">
				 <?php
	foreach($honorer->result_array() as $bi){
		//$isi=$head['nama_album'];
		?>
				<div class="des-cov">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailpejabat/<? echo $bi['id_profil'];?>"><img src="<?php echo base_url(); ?>asset/profil/<? echo $bi['foto'];?>" alt=""></a>
					</div>
					
				</div>
			<?php } ?>
				
				
				
			</div>
			
			</div>
			

			

			
		
						  
		</div>
	</section>
	<!-- team end-->

	