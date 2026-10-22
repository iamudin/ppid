
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
			<h2>DINAS/BADAN</h2>
			<div class="dlab-separator-outer ">
<div class="dlab-separator bg-warning style-skew"></div></div>
		</div>
		

		<div class="container">
			
					<div class="row">
						 <div class="col-lg-4 col-md-6 col-sm-6 col-12"></div>
		 <?php
	foreach($utama->result_array() as $head){
		?>
  
           <div class="col-lg-4 col-md-6 col-sm-6 col-12">

				<div class="des-cov2 bg-white" style="text-align: center;margin-bottom: 20px;">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailpejabatskpd/<? echo $head['id_skpd'];?>">
							<img src="<?php echo base_url(); ?>asset/banner/<?php echo $head['gambar']; ?>" alt=""></a>
					</div>
					<div class="des-parax">
						<div class="dayt skpd">
							<h7><a href="<?php echo base_url(); ?>web/detailpejabatskpd/<? echo $head['id_skpd'];?>"><? echo $head['skpd'];?></a></h7>
							
						</div>
						<div class="dayt">
							<p><? echo $head['alamat'];?></p>
							
						</div>
						<div class="bottom">
                    
                    <a style="color: #fff;" class="btn btn-danger btn-sm" rel="publisher"
                       href="<?php echo base_url(); ?>web/detailpejabatskpd/<? echo $head['id_skpd'];?>">
                        <i class="fa fa-link"></i> Lihat Pejabat
                    </a>
                    
                   
                    
                </div>
						
					</div>
				</div></div>

      
      <?php } ?> <div class="col-lg-4 col-md-6 col-sm-6 col-12"></div>
  </div>
  <div class="row">
				 <?php
	foreach($semua->result_array() as $head){
		?>
  
           <div class="col-lg-4 col-md-6 col-sm-6 col-12">

				<div class="des-cov2s bg-white" style="text-align: center;margin-bottom: 20px;">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailpejabatskpd/<? echo $head['id_skpd'];?>">
							<img src="<?php echo base_url(); ?>asset/banner/<?php echo $head['gambar']; ?>" alt=""></a>
					</div>
					<div class="des-parax">
						<div class="dayt skpd">
							<h7><a href="<?php echo base_url(); ?>web/detailpejabatskpd/<? echo $head['id_skpd'];?>"><? echo $head['skpd'];?></a></h7>
							
						</div>
						<div class="dayt">
							<p><? echo $head['alamat'];?></p>
							
						</div>
						<div class="bottom">
                    
                    <a style="color: #fff;" class="btn btn-danger btn-sm" rel="publisher"
                       href="<?php echo base_url(); ?>web/detailpejabatskpd/<? echo $head['id_skpd'];?>">
                        <i class="fa fa-link"></i> Lihat Pejabat
                    </a>
                    
                   
                    
                </div>
						
					</div>
				</div></div>

      
      <?php } ?>
					
					</div>
				</div>
	</section>
	<!-- team end-->

	