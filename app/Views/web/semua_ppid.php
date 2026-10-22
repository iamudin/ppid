<section id="tour-des" class="bg-gray">
		<div class="content-box">
			
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
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
						<a href="<?php echo base_url(); ?>web/detailskpd/<? echo $head['id_skpd'];?>">
	<span class="notify-badge">PPID Utama</span>
							<img src="<?php echo base_url(); ?>asset/banner/<?php echo $head['gambar']; ?>" alt=""></a>
					</div>
					<div class="des-parax">
						<div class="dayt skpd">
							<h7><a href="<?php echo base_url(); ?>web/detailskpd/<? echo $head['id_skpd'];?>"><? echo $head['skpd'];?></a></h7>
							
						</div>
						<div class="dayt">
							<p><? echo $head['alamat'];?></p>
							
						</div>
						<div class="bottom">
                    
                    <a target="_blank" class="btn btn-danger btn-sm" rel="publisher"
                       href="<? echo $head['webiste'];?>">
                        <i class="fa fa-link"></i>
                    </a>
                    
                    <a target="_blank" class="btn btn-primary btn-twitter btn-sm" href="<? echo $head['twitter'];?>">
                        <i class="fab fa-twitter"></i>
                    </a>
                   
                    <a target="_blank" class="btn btn-primary btn-sm" rel="publisher"
                       href="<? echo $head['fb'];?>">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a target="_blank" class="btn btn-warning btn-sm" rel="publisher"
                       href="<? echo $head['ig'];?>">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a target="_blank" class="btn btn-danger btn-sm" rel="publisher"
                       href="<? echo $head['yt'];?>">
                        <i class="fab fa-youtube"></i>
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
						<a href="<?php echo base_url(); ?>web/detailskpd/<? echo $head['id_skpd'];?>">
	<span class="notify-badge">PPID Pembantu</span>
							<img src="<?php echo base_url(); ?>asset/banner/<?php echo $head['gambar']; ?>" alt=""></a>
					</div>
					<div class="des-parax">
						<div class="dayt skpd">
							<h7><a href="<?php echo base_url(); ?>web/detailskpd/<? echo $head['id_skpd'];?>"><? echo $head['skpd'];?></a></h7>
							
						</div>
						<div class="dayt">
							<p><? echo $head['alamat'];?></p>
							
						</div>
						<div class="bottom">
                    
                    <a target="_blank" class="btn btn-danger btn-sm" rel="publisher"
                       href="<? echo $head['webiste'];?>">
                        <i class="fa fa-link"></i>
                    </a>
                    
                    <a target="_blank" class="btn btn-primary btn-twitter btn-sm" href="<? echo $head['twitter'];?>">
                        <i class="fab fa-twitter"></i>
                    </a>
                   
                    <a target="_blank" class="btn btn-primary btn-sm" rel="publisher"
                       href="<? echo $head['fb'];?>">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a target="_blank" class="btn btn-warning btn-sm" rel="publisher"
                       href="<? echo $head['ig'];?>">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a target="_blank" class="btn btn-danger btn-sm" rel="publisher"
                       href="<? echo $head['yt'];?>">
                        <i class="fab fa-youtube"></i>
                    </a>
                    
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