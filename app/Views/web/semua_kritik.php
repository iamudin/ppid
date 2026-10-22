
	<!--  blog-single-content start-->
	<section id="blog-single-main-detail" class="detail">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-12 col-12">
					
						
						  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
  <li class="breadcrumb-item active" style="text-transform: capitalize;">Kontak</li>
</ol>
						<div class="blog-single-dd-hed">
							<h4><a href="#!">Kontak</a></h4><br>
							<div id="isiku"> <form method="post" action="<?php echo base_url(); ?>web/carisurat">
      <div class="row"> 	
                <div class="col-md-9">	
     
    		 <div class="input-group">
        <div class="form-group  has-feedback">
            <input name="kunci" placeholder="Pencarian Surat Warga" type="text" class="form-control" id="inputSuccess5">
            <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
        </div>
        <span class="input-group-btn">
            
            <button class="btn btn-danger" type="button">Cari</button>
        </span>
    </div>
    
			
   </div>
   <div class="col-md-3"> <a href="<?php echo base_url(); ?>web/saran" class="btn btn-success">Isi Form Kontak</a>
   </div>
   </div>
   </form>
      
       <hr>
                           <blockquote>  Silahkan mengisi fasilitas 
                           komunikasi <b>Surat Warga</b> kami. Mohon masukan 
                           dan pertanyaan disampaikan secara bijak
                            dengan kata-kata yang baik.<br><br>
                           
    Seluruh komentar yang masuk akan kami moderasi terlebih dahulu sebelum ditampilkan. 
    Komentar yang mengandung unsur sara, <i>hoax</i>, pornografi,
     spam, ujaran kebencian, atau link tidak bermanfaat akan kami hapus.<br><br>
Untuk pertanyaan, keluhan, masukan atau saran, silahkan
 disampaikan/ditulis dengan cara mengklik <b>Isi Form Kontak</b> diatas. Terimakasih.
                                </blockquote>
                        <hr>
		<div class="all-clien-sayt">
						<?php
	    foreach($semua->result_array() as $t){
		?>
							<div class="coom-2-client">
								<div class="coomm-2client-img">
									<img src="<?php echo base_url(); ?>asset/banner/<?php echo $t['foto']; ?>" alt="img">
								</div>
								<div class="coomm-2cliebt-hed">
									<div class="alow-rasta">
										<div class="all-kal">
									<h5><?php echo $t['nama']; ?></h5>
									
								</div>
									<div class="darkan-mara">
										<p><a href="#!"><?php echo tgl_indo($t['posted_date']); ?></a></p>
									</div>
									
									</div>
									<div class="all-text-emar">
										<p> <?php echo strip_tags($t['pesan']); ?></p>
									</div>
								</div>
							</div>

							<div class="coom-2-client mar-nened">
								<div class="coomm-2client-img">
									<img src="<?php echo base_url(); ?>user_3.jpg" alt="img">
								</div>
								<div class="coomm-2cliebt-hed">
									<div class="alow-rasta">
										<div class="all-kal">
									<h5>Admin</h5>
									
								</div>
									
									</div>
									<div class="all-text-emar">
										<p> <? echo strip_tags($t['replay']);?></p>
									</div>
								</div>
							</div>
							<?php } ?>
							
						</div>
		  

    
                                
                                 
                              
                               	<div class="blog-pagination d-flex justify-content-center text-center">
						<div class="wrapper blog-wrapper">
							<?php echo $paginator;?>
						</div>
					</div>  </div>
						</div>
						
						
						
						<div class="inner-tahesxx">
							<hr>
							<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d66391c5fea9f001288d5bf&product=inline-share-buttons' async='async'></script>

<div class="sharethis-inline-share-buttons"></div> 
							
						</div>
						
						
						<div class="lave-cooment">
							
						</div>

						
				
				</div>
				