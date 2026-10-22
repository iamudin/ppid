
<!-- Content -->
<div id="blog-single-atas" align="center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <div class="section-content box-sort-in p-b0 button-example">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	<a href="<?php echo base_url(); ?>web/link/informasi-publik" class="icon-cell">
                                       <div class="flight-cover">
							<i class="fas fa-database"></i>
							
						</div>
						<p>Daftar Informasi Publik</p></a>
                                    </div>

                                     <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                     	<a href="<?php echo base_url(); ?>web/link/permohonan-informasi-publik" class="icon-cell">
                                       <div class="flight-cover">
							<i class="fas fa-paper-plane"></i>
							
						</div>
						<p>Permohonan
Informasi Publik</p></a>
                                    </div>

                                     <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                 <a href="<?php echo base_url(); ?>web/link/cek-status-permohonan-informasi-publik" class="icon-cell">      <div class="flight-cover">
							<i class="fas fa-envelope-open"></i>
							
						</div>
						<p>Cek Status Permohonan</p></a>
                                    </div>

                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	  <a href="<?php echo base_url(); ?>web/link/cek-permohonan-keberatan" class="icon-cell">
                                       <div class="flight-cover">
							<i class="fas fa-envelope-open"></i>
							
						</div>
						<p>Cek Status
Keberatan</p></a>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	<a href="<?php echo base_url(); ?>web/statis/alur-mekanisme-pelayanan-informasi-publik">
                                        <div class="flight-cover">
							<i class="fas fa-cogs"></i>
							
						</div>
						<p>Mekanisme Layanan
Informasi Publik</p></a>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-4 col-xl-2 m-b10">
                                    	<a href="<?php echo base_url(); ?>web/link/statistik-informasi-publik">
                                       <div class="flight-cover">
							<i class="fas fa-chart-bar"></i>
							
						</div>
						<p>Statistik Layanan Informasi Publik</p></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


	<section id="blog-single-main">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-12 col-12">

					<div class="row clearfix">
                                    <div class="col-md-12">
                        <div class="bg-white sambutan m-b15">
                            <div class="card-body">
                        <h3 class="m-b15 title">Selayang Pandang</h3>
                        <p class="m-b15">Puji syukur kehadirat Allah SWT atas rahmat dan karunia-Nya, kita dapat menjalankan tugas dan kewajiban sehari-hari, tentunya dalam kondisi sehat wal'afiat.
 
Terbitnya website ini, sebagai wujud patuh dan tunduk terhadap lahirnya Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.<br><br>

Undang-undang ini dengan tegas memberikan kewajiban kepada Badan Publik untuk membuka informasi yang berkaitan dengan institusinya, kebijakan yang dihasilkan, serta kegiatan-kegiatan yang dilakukan, termasuk kondisi keuangan dan penggunaan anggaran.
<br><br>

“Terwujudnya Kabupaten Bengkalis yang Bermarwah, Maju dan Sejahtera”, khususnya melalui transparansi dan keterbukaan informasi publik“</p>
                       
       <div class="media">
  <img src="https://diskominfotik.bengkaliskab.go.id/agussofyandiskominfotikbengkalis.jpg" alt="Agus Sofyan" class="mr-3 rounded-circle" style="width:60px;">
  <div class="media-body">
    <h6 class="m-b0">Agus Sofyan, S.STP., MPA.</h6>
    <p>Kepala Dinas</p>
  </div>
</div>                     
                <div align="right"><a href="<?php echo base_url(); ?>web/statis/sambutan"  class="btn btn-danger btn-sm btn-sm">[ Selengkapnya ]</a></div>                    

                       
                         </div>

                    </div><!--/.business_leader_left_cont-->
                    </div>
                </div>
  <?php
		$ik1=$this->News_model->Banner_Function("1");
	    foreach($ik1->result_array() as $ter){
		?>
        <a href="<? echo $ter['keterangan'];?>" target="_blank">
<img class="m-b15" width="100%"  src="<?php echo base_url(); ?>asset/banner/<? echo $ter['foto_besar'];?>" >
 </a>
<?
		}
		?><div class="clearfix"></div>
                <?php
					$nox=1;
foreach($bawah->result_array() as $bi)
{
	$isi=strip_tags($bi['isi']);

?>
<div class="media meida-md">
                                <div class="media-left">

                                    <a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>">
                                     <div class="thumbnailku">
                                    <img class="object-fit_cover" src="<?php echo base_url(); ?>asset/berita/original/<? echo $bi['gambar'];?>" alt=""></div></a>


                                </div>
                                <!-- /.Post image -->
                                <div class="media-body">
                                    <div class="post-header">



                                        <h3 class="media-heading"><a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>"><? echo $bi['judul_berita'];?></a></h3>
                                        <div class="entry-meta">
                                            <span class="entry-date"><i class="fas fa-calendar-alt" aria-hidden="true"></i><time><? echo tgl_indo($bi['tanggal']);?><span class="hidden-xs">- <? echo $bi['waktu'];?> WIB</span></time></span>

                                        </div>
                                        <!-- /.Post meta -->
                                            <p class="d-none d-sm-block"> <? echo substr($isi,0,100);?>.</p>
                                    </div>


                                </div>
                            </div>

<?php }?>


                <?php
					$nox=1;
foreach($bawah2->result_array() as $bi)
{
	$isi=strip_tags($bi['isi']);

?>
<div class="media meida-md">
                                <div class="media-left">

                                    <a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>">
                                     <div class="thumbnailku">
                                    <img class="object-fit_cover" src="<?php echo base_url(); ?>asset/berita/original/<? echo $bi['gambar'];?>" alt=""></div></a>


                                </div>
                                <!-- /.Post image -->
                                <div class="media-body">
                                    <div class="post-header">



                                        <h3 class="media-heading"><a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>"><? echo $bi['judul_berita'];?></a></h3>
                                        <div class="entry-meta">
                                            <span class="entry-date"><i class="fas fa-calendar-alt" aria-hidden="true"></i><time><? echo tgl_indo($bi['tanggal']);?><span class="hidden-xs">- <? echo $bi['waktu'];?> WIB</span></time></span>

                                        </div>
                                        <!-- /.Post meta -->
                                            <p class="d-none d-sm-block"> <? echo substr($isi,0,100);?>.</p>
                                    </div>


                                </div>
                            </div>

<?php }?>

 
				</div>
				<div class="col-lg-4 col-md-12 col-sm-12 col-12">
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
							<h6>Waktu Pelayanan</h6>
						</div>
						
							<div class="all-boytr">
								<table width="100%" class="table table-sm">
  <tbody>
    <tr>
      <td width="13%">Senin – Kamis</td>
      <td width="1%">:</td>
      <td width="86%">09.00 – 15.00 WIB</td>
    </tr>
    <tr>
      <td>Istirahat</td>
      <td>:</td>
      <td>12.00 – 13.00 WIB</td>
    </tr>
    <tr>
      <td>Jumat</td>
      <td>:</td>
      <td>09.00 – 15.00 WIB</td>
    </tr>
    <tr>
      <td>Istirahat </td>
      <td>:</td>
      <td>11.00 – 13.00 WIB</td>
    </tr>
  </tbody>
</table>
								
							
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
							<h6>Statistik Permohonan</h6>
						</div>
						
						 <div class="all-boytr">
						

						<div class="item-cata">
									<div class="icon-catr">
										<a href="#"><i class="far fa-dot-circle"></i>Jumlah Pemohon</a>
									</div>
									<div class="co-num">
										<a href="#"><?php foreach($pemohon->result_array() as $soal)
	{echo $soal['tot'];}?>				</a>
									</div>
								</div> 

								<div class="item-cata">
									<div class="icon-catr">
										<a href="#"><i class="far fa-dot-circle"></i>Permohonan Informasi</a>
									</div>
									<div class="co-num">
										<a href="#"><?php foreach($permohonan->result_array() as $soal)
	{echo $soal['tot'];}?>				</a>
									</div>
								</div> 

								<div class="item-cata">
									<div class="icon-catr">
										<a href="#"><i class="far fa-dot-circle"></i>Penyediaan Informasi</a>
									</div>
									<div class="co-num">
										<a href="#"><?php foreach($penyediaan->result_array() as $soal)
	{echo $soal['tot'];}?>				</a>
									</div>
								</div> 

								<div class="item-cata">
									<div class="icon-catr">
										<a href="#"><i class="far fa-dot-circle"></i>Permohonan Ditolak</a>
									</div>
									<div class="co-num">
										<a href="#"><?php foreach($tolak->result_array() as $soal)
	{echo $soal['tot'];}?>			</a>
									</div>
								</div> 

								<div class="item-cata">
									<div class="icon-catr">
										<a href="#"><i class="far fa-dot-circle"></i>Keberatan Permohonan</a>
									</div>
									<div class="co-num">
										<a href="#"><?php foreach($keberatan->result_array() as $soal)
	{echo $soal['tot'];}?>			</a>
									</div>
								</div> 

						  </div>
						</div>


						<div class="coomm-seclitor bg-white">
						<div class="comm-foot-hed-widget">
							<h6>Pengumuman</h6>
						</div>
					
							<div class="blog-cljgx">
								<?php
	$n=1;
foreach($pengumuman->result_array() as $u)
{ ?>
								<div class="blog-cliccs">
									<div class="alo-blog-clss-text-agenda">
										
										<h6><a href="<?php echo base_url(); ?>web/detailpengumuman/<? echo $u['id_pengumuman'];?>/<? echo $u['permalink'];?>"><? echo $u['judul_pengumuman'];?></a></h6>
										<p class="datre"><i class="fas fa-calendar-alt" aria-hidden="true"></i> <? echo tgl_indo($u['tanggal']);?></p>
										
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

	<!-- tour start-->
	<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6>Database</h6>
			<h2>Informasi Publik</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">

			<div id="chart"></div>
			
		 <table id="table" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"><thead>
                            <tr>
                                <th width="2%">No</th>
                                <th width="26%">PPID Utama/Pembantu</th>
                                <th width="58%">Judul</th>
                            </tr>
                        </thead>
                     
                        <tbody>                
                                                                              <?php
	$n=1;
//$bk= $this->News_model->Download_Function("258","5");
foreach($download->result_array() as $bi)
{
	$file = str_replace('media/file/','',$bi['file']);
?>             
                                                            <tr>
                                    <td align="center"><?php echo $n;?></td>
                                    <td><? echo $bi['skpd'];?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>web/tampilkan/<? echo $bi['kode_download'];?>/<? echo $file;?>">
                                            <span class='title-daftar'><? echo $bi['download'];?></span>
                                        </a>
                                       <p>
                                       	<? echo $bi['ket'];?>
                                       </p>
                                    
                                    </td>
                                </tr>
                                 <?php $n++;} ?>
                                  <tbody> 
						</table>
						<br>

						  <div align="center"><a href="<?php echo base_url(); ?>web/link/informasi-publik"  class="btn btn-danger btn-sm btn-sm">[ Selengkapnya ]</a></div> 

    
		</div>
	</section>
	<!-- tour start-->
<!-- team start-->
	<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6>Profil</h6>
			<h2>Pejabat</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			<div class="slider-des owl-carousel owl-theme">
				 <?php
	foreach($profilku->result_array() as $bi){
		//$isi=$head['nama_album'];
		?>
				<div class="des-cov">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/link/profil-pejabat"><img src="<?php echo base_url(); ?>asset/profil/<? echo $bi['foto'];?>" alt=""></a>
					</div>
					
				</div>
			<?php } ?>
				
				
				
			</div>
			<!--Model box-->
			<br>

						  <div align="center"><a href="<?php echo base_url(); ?>web/link/profil-pejabat"  class="btn btn-danger btn-sm btn-sm">[ Selengkapnya ]</a></div> 
		</div>
	</section>
	<!-- team end-->
	

	<!-- team start-->
	<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6>Infografik</h6>
			<h2>PPID Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			<div class="slider-des owl-carousel owl-theme">
				 <?php
	foreach($peristiwa->result_array() as $bi){
		//$isi=$head['nama_album'];
		?>
				<div class="des-cov">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailberitafoto/<? echo $bi['id_beritafoto'];?>/<? echo $bi['permalink'];?>"><img src="<?php echo base_url(); ?>asset/banner/<? echo $bi['gambar'];?>" alt=""></a>
					</div>
					<div class="des-para">
						<div class="dayt">
							<p><a href="<?php echo base_url(); ?>web/detailberitafoto/<? echo $bi['id_beritafoto'];?>/<? echo $bi['permalink'];?>"><? echo $bi['judul_beritafoto'];?></a></p>
							
						</div>
						
						
					</div>
				</div>
			<?php } ?>
				
				
				
			</div>
			<!--Model box-->
			<br>

						  <div align="center"><a href="<?php echo base_url(); ?>web/link/infografis"  class="btn btn-danger btn-sm btn-sm">[ Selengkapnya ]</a></div> 
		</div>
	</section>
	<!-- team end-->

<!-- tour start-->
	<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6>Transparansi</h6>
			<h2>Anggaran</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">

			
			<div id="chart2"></div><br>
		 <table id="table" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"><thead>
<tr>
<th width="2%">No.</th>
<th width="40%">Judul</th>
<th width="35%">Jenis Transparansi</th>
<th width="23%">Tahun</th>
</tr>
</thead>
<tbody>
<?php 
$no = 1;
foreach($transparansi->result_array() as $artikel){
$file = str_replace('media/file/','',$artikel['file']);
 ?>
<tr>
<td align='center'><?php echo $no; ?></td>
<td><a href="<?php echo base_url(); ?>web/tampilkantransparansi/<? echo $artikel['id_transparansi'];?>/<? echo $file;?>"><?php echo $artikel['judul']; ?></a></td>
<td><?php echo $artikel['jenistransparansi']; ?></td>
<td><?php echo $artikel['tahun']; ?></td>
</tr>
<?php 
	$no++;
 }
  
?>
</tbody>
</table>
						<br>

						  <div align="center"><a href="<?php echo base_url(); ?>web/link/transparansi-anggaran"  class="btn btn-danger btn-sm btn-sm">[ Selengkapnya ]</a></div> 

    
		</div>
	</section>
	<!-- tour start-->
		<!-- tour start-->
	<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6>Video Informasi	</h6>
			<h2>PPID Bengkalis</h2>
			<div class="dlab-separator-outer">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			<div class="slider-des owl-carousel owl-theme">
				 <?php
$no=1;
foreach($video->result_array() as $bi)
{
?>
				<div class="des-cov">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailvideo/<? echo $bi['id_video'];?>/<? echo $bi['permalink'];?>"><img src="<?php echo base_url(); ?>asset/banner/<? echo $bi['gambar'];?>" alt=""></a>
					</div>
					<div class="des-para">
						<div class="dayt">
							<p><a href="<?php echo base_url(); ?>web/detailvideo/<? echo $bi['id_video'];?>/<? echo $bi['permalink'];?>"><? echo $bi['judul_video'];?>	</a></p>
							
						</div>
						
						
					</div>
				</div>
			<?php } ?>
				
				
				
			</div>
			<!--Model box-->
			<br>

						  <div align="center"><a href="<?php echo base_url(); ?>web/link/video-informasi"  class="btn btn-danger btn-sm btn-sm">[ Selengkapnya ]</a></div> 

    
		</div>
	</section>
	<!-- tour start-->

	<!-- team start-->
	<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6>Penghargaan</h6>
			<h2>PPID Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			<div class="slider-des owl-carousel owl-theme">
				 <?php
	foreach($penghargaan->result_array() as $bi){
		//$isi=$head['nama_album'];
		?>
				<div class="des-cov">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailpenghagargaan/<? echo $bi['id_penghargaan'];?>/<? echo $bi['permalink'];?>"><img src="<?php echo base_url(); ?>asset/penghargaan/<? echo $bi['gambar'];?>" alt=""></a>
					</div>
					<div class="des-para">
						<div class="dayt">
							<p><a href="<?php echo base_url(); ?>web/detailpenghagargaan/<? echo $bi['id_penghargaan'];?>/<? echo $bi['permalink'];?>"><? echo $bi['judul_penghargaan'];?></a></p>
							
						</div>
						
						
					</div>
				</div>
			<?php } ?>
				
				
				
			</div>
			<!--Model box-->
			<br>

						  <div align="center"><a href="<?php echo base_url(); ?>web/link/penghargaan-ppid"  class="btn btn-danger btn-sm btn-sm">[ Selengkapnya ]</a></div> 
		</div>
	</section>
	<!-- team end-->

	<!-- team start-->
	<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6>Galeri</h6>
			<h2>Kegiatan</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			<div class="slider-des owl-carousel owl-theme">
				           <?php
    foreach($cuplikan_galeri->result_array() as $head){
        $isi=substr($head['nama_album'],0,50);
        ?>
				<div class="des-cov">
					<div class="des-img">
						<a href="<?php echo base_url(); ?>web/detailfoto/<? echo $head['id_album'];?>/<? echo $head['permalink'];?>"><img src="<?php echo base_url(); ?>asset/galeri/original/<? echo $head['foto_besar'];?>" alt=""></a>
					</div>
					<div class="des-para">
						<div class="dayt">
							<p><a href="<?php echo base_url(); ?>web/detailfoto/<? echo $head['id_album'];?>/<? echo $head['permalink'];?>"><? echo $head['nama_album'];?></a></p>
							
						</div>
						
						
					</div>
				</div>
			<?php } ?>
				
				
				
			</div>
			<!--Model box-->
			<br>

						  <div align="center"><a href="<?php echo base_url(); ?>web/link/galeri-kegiatan"  class="btn btn-danger btn-sm btn-sm">[ Selengkapnya ]</a></div> 
		</div>
	</section>
	<!-- team end-->
<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6>Update</h6>
			<h2>Media Sosial</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
			<div class="row">

<div class="col-md-4">
<div class="card" style="height:475px;">
    <div class="card-body">
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.8&appId=353727057999136";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
               
                <div class="fb-page" data-href="https://www.facebook.com/ppidbengkalis/" data-tabs="timeline" data-height="420" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Bppidbengkalis/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ppidbengkalis/">PPID Bengkalis</a></blockquote></div>
 </div>
            </div>

            </div>

<div class="col-md-4">
    <div class="card" style="height:475px;">
    <div class="card-body">
     <a data-height="420" class="twitter-timeline" href="https://twitter.com/ppidbengkalis" data-widget-id="707828617259016192">Tweets by @HumasBWI</a>

                <script>
                    ! function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0],
                            p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = p + "://platform.twitter.com/widgets.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, "script", "twitter-wjs");
                </script>
</div></div>
</div>
<div class="col-md-4">
    <div class="card" style="height:475px;">
    <div class="card-body">
 <script src="https://apps.elfsight.com/p/platform.js" defer></script>
<div class="elfsight-app-9647dc0a-0c6f-44e6-a7dd-69098a7413a4"></div>
</div></div>
</div>      

</div>             
			
		</div>
	</section>
	<!-- team end-->
<section id="tour-desx" class="footre-bottom">
		
		<div class="container">
		<div class="row">	
			
			
					<?php
						$link= $this->News_model->Side_Link();
foreach($link->result_array() as $link2)
{
	?><div class="col-md-2 col-6">
         
					<a target="_blank" href="<? echo $link2['url'];?>"><img width="100%" src="<?php echo base_url(); ?>asset/banner/<? echo $link2['gambar'];?>" alt=""></a>
					 </div>
				<?php } ?>

				
			</div>
			
		</div>
	</section>
	<!-- team end-->
	
	
	
	
