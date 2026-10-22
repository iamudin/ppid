
 <!-- s:hl -->
 <div id="hl" style="margin-top: -10px;">
 <?php
 	$hl=1;
	foreach($headline->result_array() as $bi){
		?>
 <article>
 <a href="<?php echo base_url(); ?>mobile/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>">
 <div class="ratio16_9 box_img">
 <div class="img_con">
 <img src="<?php echo base_url(); ?>asset/berita/original/<? echo $bi['gambar'];?>?w=600&amp;q=90" alt="<? echo $bi['judul_berita'];?>" title="<? echo $bi['judul_berita'];?>" class=""> </div>
 </div>
 <div class="text caption">
 <h1><? echo $bi['judul_berita'];?></h1>
 
 <span class="info"><? echo tgl_indo($bi['tanggal']);?> </span>
 </div>
 </a>
</article>
<?php } ?>
 </div>
 <!-- e:hl -->
 
 <!-- s:list -->

 <div id="newsfeed-container" class="list_feed">
   <?php
foreach($bawah->result_array() as $bi)
{
?>  
<article>
 <a href="<?php echo base_url(); ?>mobile/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>" class="list">
  <div class="ratio4_3 box_img">
 <div class="img_con">
 <img src="<?php echo base_url(); ?>asset/berita/large/<? echo $bi['gambar'];?>"
  alt="<? echo $bi['judul_berita'];?>" title="<? echo $bi['judul_berita'];?>" class="">
  </div>
 </div>
 <div class="text">
  <span class="post-category <? echo $bi['permalink'];?>">
				<? echo $bi['title'];?>				</span>
 <span class="sub"><? echo $bi['anak'];?></span>
 <h2><? echo $bi['judul_berita'];?>	</h2>
 <span class="info"> <?php echo tgl_indo($bi['tanggal']); ?> - <?php echo $bi['waktu']; ?> WIB</span>
 </div>

 <div class="clearfix"></div>
 
 </a>
</article>
<?php } ?>





 

 <div align="center" id="newsfeed-more-news" class="more_news more-trigger">
 <a class="btn_more" href="<?php echo base_url(); ?>mobile/link/berita">Selengkapnya</a>
 </div>
</div>

<!--Sambutan-->
<div class="sambutan">
	<article>
    
   <?php
    $id="sambutan-pendek";
    $terkait     = $this->News_model->Data_Statis($id);
	foreach($terkait->result_array() as $ter){
		 echo $ter['content'];
	}
	?>
  
   </article>
     </div>
    
<div class="clearfix"></div>
<div align="center" id="newsfeed-more-news" class="more_news more-trigger">
 <a class="btn_more" href="<?php echo base_url(); ?>mobile/statis/sambutan">
 Selengkapnya</a>
 </div>



<div class="clearfix"></div>
 <div class="title_box merah">
 <span>PATEN</span>
 <a href="#" class="btn_more2 fr">+</a>
 </div>
 

 
							 <?php
$n=1;
$sub_menu=$this->News_model->Menu_Bawah2("8");
		foreach($sub_menu->result_array() as $sm)
		{ ?>
 <article>
 <a href="<?php echo base_url(); ?>mobile/<? echo $sm['sorting'];?>/<? echo $sm['permalink'];?>" class="list list_most">
 <div class="no"><?php echo $n;?></div>
 <div class="text">
 <h2><? echo $sm['title'];?></h2>
	
 </div>
 <div class="clearfix"></div>
 </a>
 </article>
 <?php $n++;} ?>
<div class="clearfix"></div>





  <!--S: HOT PHOTO-->
 <div class="title_box merah">
 <span>Berita Foto</span>
 <a href="<?php echo base_url(); ?>mobile/link/berita-foto" class="btn_more2 fr">+</a>
 </div>
<div class="hotpoto fotoku">
 <?php
foreach($peristiwa->result_array() as $bi)
{
?>    
 <a href="<?php echo base_url(); ?>mobile/detailberitafoto/<? echo $bi['id_beritafoto'];?>/<? echo $bi['permalink'];?>">
 <div class="ratio4_3 box_img">
 <div class="img_con"> <img src="<?php echo base_url(); ?>asset/banner/<? echo $bi['gambar'];?>?w=&amp;q=" alt="" title="" class="">
   <span class="play"></span>
 </div>
 </div>
 <span class="judulphoto"><h5><? echo $bi['judul_beritafoto'];?></h5></span>
 <div class="clearfix"></div>
 </a>
 <?php } ?>
 
 
 
 
 <div class="clearfix"></div>
</div>
 
<div class="clearfix"></div>
<div class="title_box hijau">
 <span>TERPOPULER</span>
 <a href="<?php echo base_url(); ?>mobile/link/berita" class="btn_more2 fr">+</a>
 </div>
 
							 <?php
							 $n=1;
	  $bk= $this->News_model->Berita_Popular();
	foreach($bk->result_array() as $hd){
		?>
 <article>
 <a href="<?php echo base_url(); ?>mobile/detailberita/<? echo $hd['id_berita'];?>/<? echo $hd['url'];?>" class="list list_most">
 <div class="no"><?php echo $n;?></div>
 <div class="text">
 <span class="sub"><? echo $hd['anak'];?></span>
 <h2><? echo $hd['judul_berita'];?>	</h2>
	 <span class="info">Dibaca: <? echo $hd['counter'];?> Kali</span>
 </div>
 <div class="clearfix"></div>
 </a>
 </article>
 <?php $n++;} ?>
  <div class="clearfix"></div>
 <div class="title_box biru">
 <span>Video Kegiatan</span>
 <a href="<?php echo base_url(); ?>mobile/link/video-kegiatan" class="btn_more2 fr">+</a>
 </div>
<div class="hotpoto video">
 <?php
foreach($video->result_array() as $bi)
{ ?>   
 <a href="<?php echo base_url(); ?>mobile/detailvideo/<? echo $bi['id_video'];?>/<? echo $bi['permalink'];?>">
 <div class="ratio4_3 box_img">
 <div class="img_con"> <img src="<?php echo base_url(); ?>asset/banner/<? echo $bi['gambar'];?>?w=&amp;q=" alt="" title="" class="">
  <span class="play"></span>
 </div>
 </div>

 <span class="judulphoto"><h5><? echo $bi['judul_video'];?></h5></span>
 <div class="clearfix"></div>
 </a>
 <?php } ?>
 
 
 
 
 <div class="clearfix"></div>
</div>
<div class="clearfix"></div>



 
 <div class="title_box orange">
 <span>AGENDA KEGIATAN</span>
 <a href="<?php echo base_url(); ?>mobile/link/agenda" class="btn_more2 fr">+</a>
 </div>
 
							 <?php
							 $n=1;
	 foreach($agenda->result_array() as $agenda3)
{
		?>
 <article>
 <a href="<?php echo base_url(); ?>mobile/detailagenda/<? echo $agenda3['id_agenda'];?>/<? echo $agenda3['permalink'];?>" class="list list_most">
 <div class="no"><?php echo $n;?></div>
 <div class="text">
 <h2><? echo $agenda3['tema_agenda'];?></h2>
	 <span class="info"><? echo tgl_indo($agenda3['tgl_mulai']);?></span>
 </div>
 <div class="clearfix"></div>
 </a>
 </article>
 <?php $n++;} ?>
<div class="clearfix"></div>
 <div class="title_box hijaumuda">
 <span>Galeri Foto</span>
 <a href="<?php echo base_url(); ?>mobile/link/galeri-kegiatan" class="btn_more2 fr">+</a>
 </div>
<div class="hotpoto fotoku">
  <?php
	foreach($cuplikan_galeri->result_array() as $head){
		$isi=$head['nama_album'];
		?>  
 <a href="<?php echo base_url(); ?>mobile/detailfoto/<? echo $head['id_album'];?>/<? echo $head['permalink'];?>">
 <div class="ratio4_3 box_img">
 <div class="img_con"> <img src="<?php echo base_url(); ?>asset/galeri/original/<? echo $head['foto_besar'];?>?w=&amp;q=" alt="<? echo $isi;?>" title="<? echo $isi;?>" class="">
   <span class="play"></span>
 </div>
 </div>
 <span class="judulphoto"><h5><? echo $isi;?></h5></span>
 <div class="clearfix"></div>
 </a>
 <?php } ?>
 <div class="clearfix"></div>
</div>
<div class="clearfix"></div>





<div class="title_box merah">
 <span>STRUKTUR ORGANISASI</span>
 <a href="<?php echo base_url(); ?>mobile/link/struktur-bagian" class="btn_more2 fr">+</a>
 </div>
 
							   <?php
foreach($pegawai->result_array() as $g)
{
?>
 <article>
 <a href="#" class="list">

 <div class="text">
 <h2><? echo $g['nama_pegawai'];?></h2>
 <span class="info"> <? echo $g['jabatan'];?></span>
 </div>
  <div class="ratio4_3 box_img">
 <div class="img_con">
 <img src="<?php echo base_url(); ?>asset/pegawai/<? echo $g['gambar'];?>" alt="<? echo $g['nama_pegawai'];?>" title="<? echo $g['nama_pegawai'];?>" class=""> </div>
 </div>
 <div class="clearfix"></div>
 
 </a>
</article>
 <?php $n++;} ?>
  <div align="center" id="newsfeed-more-news" class="more_news more-trigger">
 <a class="btn_more" href="<?php echo base_url(); ?>mobile/link/kepegawaian">Selengkapnya</a>
 </div>
<div class="clearfix"></div>



 



<div class="title_box biru">
 <span>POLLING</span>
 <a href="#" class="btn_more2 fr">+</a>
 </div>
 <article>
 
<div class="sambutan2">
  <form method="post" action="<?php echo base_url(); ?>mobile/hasilpolling">
<?php
foreach($soal_polling->result_array() as $soal)
	{
		echo "<input type='hidden' name='id_soal' value='".$soal['id_soal_poll']."'>";
		echo "".$soal['soal_poll']."";
	}
?> 
                    
<div class="clearfix"></div>
                   <?php
foreach($jawaban_polling->result_array() as $jawaban)
	{
		echo "<input type='radio' name='polling' value='".$jawaban['id_jawaban_poll']."'> ".$jawaban['jawaban']."<div class='cleaner_h5'></div>";
	}
?>
 <div class="clearfix"></div>
<input class="btn btn-info" type="submit" value="Simpan" /> <input class="btn btn-warning" type="submit" value="Lihat" />
</form>
 </div>
 </article>
 <div class="clearfix"></div>
 
  
<div class="title_box ungu">
 <span>DOWNLOAD</span>
 <a href="<?php echo base_url(); ?>mobile/link/download" class="btn_more2 fr">+</a>
 </div>
 
							 <?php
							 $n=1;
$bk= $this->News_model->Download_Function("258","5");
foreach($bk->result_array() as $bi)
{
	$file = str_replace('media/file/','',$bi['file']);
		?>
 <article>
 <a href="<?php echo base_url(); ?>mobile/unduh/<? echo $bi['kode_download'];?>/<? echo $file;?>" class="list list_most">
 <div class="no"><?php echo $n;?></div>
 <div class="text">
 <h2><? echo $bi['download'];?></h2>
	 <span class="info">Didownload: <? echo $bi['counter'];?> Kali</span>
 </div>
 <div class="clearfix"></div>
 </a>
 </article>
 <?php $n++;} ?>

						


 
<div class="clearfix"></div>
