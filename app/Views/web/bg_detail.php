
	<!--  blog-single-content start-->
	<section id="blog-single-main-detail">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-12 col-12">

					
						<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
  <li class="breadcrumb-item active"><?php echo $kategori;?></li>
</ol>
						<div class="blog-single-dd-hed">
							<div class="dlab-post-meta baris">
                                <ul>
                                    <li class="post-date"><i class="fas fa-clock"></i><strong class="text-black"><? echo tgl_indo($tanggal);?> - <? echo $waktu;?> Wib</strong> </li>
                                    <li class="post-author text-black"><strong class="text-black">Dibaca : <? echo $counter;?> Kali</strong></li>
                                </ul>
                            </div>
							<h4><? echo $judul_berita;?></h4><hr>
							 <ul>
                                 
                                    <li class="post-author"></small><i class="fas fa-user"></i> Editor: <b><? echo $edi;?></b> - Reporter: <b><? echo $rep;?></b> - Fotografer: <b><? echo $foto;?></b> </small></li>
                                    
                                </ul><br>
<div class="blog-sighn-img  wow fadeIn" data-wow-duration="3s">
							<a href="#!"><img src="<?php echo base_url(); ?>asset/berita/original/<? echo $gambar;?>" alt="img">  </a>
						</div>
						 <?php if($ket_foto!=""){ ?>
                             <div class="caption p-a10"><small>Teks foto: <? echo $ket_foto;?></small></div><?php } ?>
<br>
							<div id="isiku"><div class="sharethis-inline-share-buttons"></div> <hr>

							 <?
		echo $isi;
		?></div>
						</div>
						
						
						
						<div class="inner-tahesxx">
							<hr>
							

<div class="sharethis-inline-share-buttons"></div> 
							
						</div>
					

						<div class="lave-cooment">
								<div class="comm-foot-hed-widget">
							<h6>Baca Juga</h6>
						</div>
							<div class="row">
								
								 <?php
 $terkait     = $this->News_model->Berita_Terkait($id_kategori,$id_berita);
	foreach($terkait->result_array() as $bi)
{
	$isi=strip_tags($bi['isi']);

	$isi=strip_tags($bi['isi']);
	
	$mulai=$bi['tanggal'];
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

<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<div class="des-cov-1 bg-white">
					<div class="des-img-1">
						<a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>"><img src="<?php echo base_url(); ?>asset/berita/original/<? echo $bi['gambar'];?>" alt=""></a>
					</div>
					<div class="des-para">
						<div class="dayt">
							<h6><a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>"><? echo $bi['judul_berita'];?></a></h6>
							
						</div>
						<div class="real-dat-para">
							<p><? echo tgl_indo($bi['tanggal']);?> - <? echo $bi['waktu'];?> WIB</p>
						</div>
						
					</div>
				</div>
				</div>

<?php } ?>
								
							</div>
						</div>
	<div class="lave-cooment">
						 	<div class="comm-foot-hed-widget">
							<h6>Tulis Komentar</h6>
						</div>
                  
                  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	</div>
	 
    
    <div class="fb-comments" data-href="<?php echo base_url(); ?>web/detailberita/<? echo $id_berita;?>" data-numposts="5" data-colorscheme="light"></div>
						
					
				</div>
				