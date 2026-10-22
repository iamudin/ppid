<div class="col-lg-4 col-md-12 col-sm-12 col-12">
					<div class="left-blog-tree">
						 	<div class="coomm-seclitor bg-white">
							<div class="comm-foot-hed-widget">
							<h6>Login PPID</h6>
						</div>
						<div class="all-boytr">
										<form action="<?php echo base_url(); ?>index.php/web/login" method="post">
  <div class="form-group">
 
    <input type="text" name="username" class="form-control" placeholder="Username" id="email">
  </div>
  <div class="form-group">

    <input name="password" type="password" class="form-control" placeholder="Password" id="pwd">
  </div>
 
  <button type="submit" class="btn btn-danger">Login</button>
</form>
</div>
						</div>

						<div class="coomm-seclitor bg-white">
						<div class="comm-foot-hed-widget">
							<h6>Agenda Kegiatan</h6>
						</div>
					
							<div class="blog-cljgx">
							 <?php
	$n=1;
foreach($agenda->result_array() as $agenda)
{
	$mulai=$agenda['tgl_mulai'];
	$tanggal = substr($mulai,8,2);

	$ubah = gmdate($mulai, time()+60*60*8);
		$pecah = explode("-",$ubah);
		$tgl = $pecah[2];
		$bln = $pecah[1];
		$thn = $pecah[0];

		$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
		$nama_hari = "";
		if($nama=="Sunday") {$nama_hari="Sun";}
		else if($nama=="Monday") {$nama_hari="Mon";}
		else if($nama=="Tuesday") {$nama_hari="Tue";}
		else if($nama=="Wednesday") {$nama_hari="Wed";}
		else if($nama=="Thursday") {$nama_hari="Thu";}
		else if($nama=="Friday") {$nama_hari="Fri";}
		else if($nama=="Saturday") {$nama_hari="Sat";}
		
		$bul=getBulan2($bln);
					?>
								<div class="blog-cliccs">
									<div class="alo-blog-clss-text-agenda">
										
										<h6><a href="<?php echo base_url(); ?>web/detailagenda/<? echo $agenda['id_agenda'];?>/<? echo $agenda['permalink'];?>"> <? echo $agenda['tema_agenda'];?></a></h6>
										<p class="datre"><i class="fas fa-calendar-alt" aria-hidden="true"></i>  <? echo tgl_indo($agenda['tgl_mulai']);?></p>
										
									</div>
								</div>
								<?php } ?>
							</div>
						</div>

						 	<div class="coomm-seclitor bg-white">
							<div class="comm-foot-hed-widget">
							<h6>Cek Status Permohonan</h6>
						</div>
						<div class="all-boytr">
						<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>web/cekstatus" role="form">
  <div class="form-group">
 
    <input type="text" name="nik_no_ktp" class="form-control" placeholder="NIK/No.Identitas Pribadi" id="email">
  </div>
  <div class="form-group">

    <input name="nama_lengkap" type="text" class="form-control" placeholder="Email Anda.." id="pwd">
  </div>
 
  <button type="submit" class="btn btn-danger">Cek Status</button>
</form>
</div>
						</div>
						
						<div class="coomm-seclitor bg-white">
						<div class="comm-foot-hed-widget">
							<h6>Berita Terpopuler</h6>
						</div>
					
							<div class="blog-cljg2">
							 		  <?php
	 $n=1;
$bk= $this->News_model->Berita_PopularDetail();
foreach($bk->result_array() as $bi)
{
	
?>        
							 		<div class="blog-cliccs2">
									<div class="blog-clss-img2  wow zoomIn" data-wow-duration="1s">
										<a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>"><img width="100" src="<?php echo base_url(); ?>asset/berita/large/<? echo $bi['gambar'];?>" alt=""></a>
									</div>
									<div class="alo-blog-clss-text2">
										<h6><a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>"><? echo $bi['judul_berita'];?></a></h6>
										<p class="datre2">Dibaca : <b><? echo $bi['counter'];?></b> Kali</p>
									</div>
								</div>
							<?php } ?>
									

								

							</div>
						</div>

						
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--  blog-single-content end-->
	
	<br>
	