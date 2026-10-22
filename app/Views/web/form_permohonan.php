<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Permohonan Informasi Publik</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
					
				
			<div class="row">
			<div class="col-sm-4">
                <div class="card card-default">
				  <div class="card-body" style="text-align: center;">
					<h6 class="card-title">
						<div class="title-box wrap-img">
							<span class="title-box img greenku greenku-padding" style="font-size: 42px;"><i class="fa fa-user"></i></span>
						</div>
PERORANGAN
					</h6>
					<form method="post" id="form_add" role="form" action="<?php echo base_url(); ?>web/form_pemohon" enctype="multipart/form-data">        
					<p class="content-box" style="font-size: 16px;">
						Pemohon informasi adalah orang perseorangan Warga Negara Indonesia (WNI) dengan persyaratan melampirkan fotokopi Kartu Tanda Penduduk (KTP).<br><br>
					</p>
					<input type="hidden" name="jenis_form" value="1">
					<input type="submit" class="btn btn-success btn-block green" value="Mulai Mengisi" name="next_page">
					</form>
				  </div>
				</div>    
            </div>
			
			<div class="col-sm-4">
                <div class="card card-default">
				   <div class="card-body" style="text-align: center;">
					<h6 class="card-title">
						<div class="title-box wrap-img">
							<span class="title-box img yellowku" style="font-size: 42px;"><i class="fa fa-gavel"></i></span>
						</div>
						KELOMPOK BERBADAN HUKUM
					</h6>
					<form method="post" id="form_add" role="form" action="<?php echo base_url(); ?>web/form_pemohon2" enctype="multipart/form-data">        
					<p class="content-box" style="font-size: 16px;">
						Pemohon informasi adalah lembaga berbadan hukum Indonesia dengan persyaratan melampirkan akta pendirian yang telah terdaftar di Kementerian Hukum dan Hak Asasi Manusia / Pengadilan Negeri.
					</p>
					<input type="hidden" name="jenis_form" value="2">
					<input type="submit" class="btn btn-warning btn-block" value="Mulai Mengisi" name="next_page">
					</form>
				  </div>
				</div>    
            </div>
			
			<div class="col-sm-4">
                <div class="card card-default">
				   <div class="card-body" style="text-align: center;">
					<h6 class="card-title">
						<div class="title-box wrap-img">
							<span class="title-box img blueku" style="font-size: 42px;"><i class="fa fa-users"></i></span>
						</div>
						KELOMPOK MASYARAKAT
					</h6>
					<form method="post" id="form_add" role="form" action="<?php echo base_url(); ?>web/form_pemohon3" enctype="multipart/form-data">        
					<p class="content-box" style="font-size: 16px;">
						Pemohon informasi adalah lembaga/masyarakat yang masih berdiri dalam suatu lembaga dengan persyaratan melampirkan akta/surat izin yang berlaku pada lembaga tersebut.
					</p>
					<input type="hidden" name="jenis_form" value="3">
					<input type="submit" class="btn btn-primary btn-block" value="Mulai Mengisi" name="next_page">
					</form>
				  </div>
				</div>    
            </div>
        </div><!-- /.row -->
			
 
						
		</div>
	</section>
	<!-- team end-->