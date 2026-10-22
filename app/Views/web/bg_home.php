

	<!-- banner start-->
	<section id="banner-home">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-10 col-sm-12 col-12">
					<div class="banner-text-home wow fadeInUp" data-wow-duration="2s">
						<h6>Selamat datang di </h6>
						<h1>Layanan Informasi Publik PPID Kabupaten Bengkalis</h1>
						<p>Menghulu Keterbukaan Informasi, Menghilir Membangun Negeri</p>
						
					</div>
				</div>
				<div class="col-lg-5 col-md-2 col-sm-12 col-12">
					<div class="video-play-banner">
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--  banner end-->


	<!-- Ab start-->
	<section id="ab-home">
		<div class="container">
		<div class="heading">
			<h2>ab-section</h2>
		</div>
			
				<div class="col-lg-12 col-md-12 col-sm-12 col-12 main-com">
					<nav>
						<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pencarian Informasi</a>
							<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
								<i class="fas fa-city amr "></i> Cek Permohonan
							</a>
						</div>
					</nav>
					<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							 <form method="post" action="<?php echo base_url(); ?>web/caripublik">
							<div class="row">
								<div class="col-lg-3 col-md-6 col-sm-6 col-12">
									<div class="booking-info">
										<div class="select-box">
											<span class="sec-po"><i class="fas fa-file"></i></span>
											<select name="jenis">
												<option value="ac"> Jenis Informasi</option>
												<?php
							foreach($par->result_array() as $tmpl_soal){ ?>
												<option value="<?php echo $tmpl_soal['id'];?>"><?php echo $tmpl_soal['title'];?></option>
											<?php } ?>

											</select>
											<i class="fas fa-angle-down map-io"></i>
										</div>

									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="booking-info">
										<div class="select-box">
											<span class="sec-po"><i class="fas fa-building"></i></span>
											<select name="skpd">
												<option value="ac"> PPID Utama/Pembantu</option>
												<?php
							foreach($skpd->result_array() as $tmpl_soal){ ?>
												<option value="<?php echo $tmpl_soal['id_skpd'];?>"><?php echo $tmpl_soal['skpd'];?></option>
											<?php } ?>
									
											</select>
											<i class="fas fa-angle-down map-io"></i>
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-12">
									<div class="booking-info">
										<div id="datepicker" class="input-group">
											<input name="katakunci" class="form-control" type="text" placeholder="Kata Kunci!">
											<span class="input-group-addon sec-po"><i class="fa fa-search"></i></span>
										</div>
										
									</div>
								</div>
								<div class="col-lg-2 col-md-6 col-sm-6 col-12">
									<div class="booking-info">
										<div class="select-box">
											
											<button type="submit" class="btn btn-2">Cari Sekarang</button>
											
										</div>

									</div>
								</div>

								
							</div>
						</form>
						</div>
						<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
							<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>web/cekstatus" role="form">
							<div class="row">
								
								<div class="col-lg-5 col-md-6 col-sm-6 col-12">
									<div class="booking-info">
										<div id="datepicker" class="input-group">
											<span class="sec-po"><i class="fa fa-id-card"></i></span>
											<input name="nik_no_ktp" required class="form-control" type="text" placeholder="NIK/No.Identitas Pribadi">
											
										</div>

									</div>
								</div>
								<div class="col-lg-5 col-md-6 col-sm-6 col-12">
									<div class="booking-info">
										<div class="booking-info">
											<div id="datepicker" class="input-group">
											<span class="sec-po"><i class="fa fa-envelope-open"></i></span>
											<input required name="nama_lengkap" class="form-control" type="text" placeholder="Email Anda..">
											
										</div>

										</div>
									</div>
								</div>
								
								<div class="col-lg-2 col-md-6 col-sm-6 col-12">
									<div class="booking-info">
										<div class="select-box">
											<button type="submit" class="btn btn-2">Cek Sekarang</button>
										</div>

									</div>
								</div>
							</form>
								
								
							</div>
						</div>
					</div>
					<div class="valedoter">
						<h2>Home</h2>
					</div>
				</div>
		</div>
	</section>
	<!-- Ab end-->