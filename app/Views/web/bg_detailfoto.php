<section id="tour-des" class="bg-gray">
		
		<div class="container">
			<div class="content-box">
			<h6 style="text-transform: capitalize;">Galeri Kegiatan</h6>
			<h2><? echo $nama_album;?></h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div><div align="center"> <ul>
                                    <li class="post-date"><small> <i class="fa fa-calendar"></i> <? echo tgl_indo($tanggal);?> <span> | <? echo $waktu;?> WIB</span> </small></li>
                                    <li class="post-author"></small><i class="glyphicon glyphicon-user"></i> By: <b><? echo $foto;?></b> </small></li>
                                    
                                </ul></div>
					<div class="row">
						
				   <?php
	
	foreach($detail->result_array() as $head){
		?><div class="col-lg-4 col-md-6 col-sm-6 col-12">
				<div class="des-cov2 bg-white" style="text-align: center;margin-bottom: 20px;">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>asset/galeri/original/<? echo $head['foto_besar'];?>"><img src="<?php echo base_url(); ?>asset/galeri/original/<? echo $head['foto_besar'];?>" alt=""></a>
					</div>
					
				</div></div>
			<?php } ?>
					
					</div>
				
			
			<!--Model box-->
			
 <!-- pagination start -->
					<div class="blog-pagination d-flex justify-content-center text-center">
						<div class="wrapper blog-wrapper">
							<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d66391c5fea9f001288d5bf&product=inline-share-buttons' async='async'></script>

							<div class="sharethis-inline-share-buttons"></div> 
						</div>
					</div>
		     	<!-- pagination end -->
						
		</div>
	</section>
	<!-- team end-->