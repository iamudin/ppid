
<!--S:DETAIL-->


<div class="detail">
	<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
        <div class="date"><strong><? echo tgl_indo($tanggal);?>  - <? echo $waktu;?> WIB</strong></div>
		<h1 class="jdl"><? echo $nama_album;?></h1>
		<div class="author">Fotografer: <b><? echo $foto;?></b></div>
		<div class="clearfix"></div>
	</div>
	<!--E:JUDUL ARTICLE-->
   <div class="hotpoto">
  <?php
	foreach($detail->result_array() as $head){
		$id_album=$head['id_album'];
		$isi=substr($head['nama_album'],0,50);
		?> 
 <a href="<?php echo base_url(); ?>asset/galeri/original/<? echo $head['foto_besar'];?>" class="swipebox" title="<? echo $isi;?>">
 <div class="ratio4_3 box_img">
 <div class="img_con"> <img src="<?php echo base_url(); ?>asset/galeri/original/<? echo $head['foto_besar'];?>?w=&amp;q=" alt="<? echo $isi;?>" title="" class=""></div>
 </div>
 <div class="clearfix"></div>
 </a>
 <?php } ?>
 <div class="clearfix"></div>
</div>
     <div class="clearfix"></div>
 <div class="clearfix"></div>
    
    <div class="text_detail detail_area" id="detikdetailtext">
    	<div align="center">
    
   
     <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>		
							 
   

    </div>
               </div>
		
						                	                		               

</article>
<!--E:ISI ARTICLE-->
<div class="detail_area">
		<!--S:SHARE BOX-->
	

  <div align="center"><h4 class="index-title">[Ikuti Terus <b>Disdik Bengkalis</b> Melalui Sosial Media] </h4><br>
               <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-page" data-href="https://www.facebook.com/Dinas-Pendidikan-Kabupaten-Bengkalis-1031846180252509/"
 data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
 <blockquote cite="https://www.facebook.com/Dinas-Pendidikan-Kabupaten-Bengkalis-1031846180252509/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Dinas-Pendidikan-Kabupaten-Bengkalis-1031846180252509/">Disdik Bengkalis</a></blockquote></div><br><br>
<div align="center">
<a href="https://twitter.com/disdikbks" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @disdikbks</a>
<br><br>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<!-- Pasang kode ini di mana pun Anda ingin lencana ditampilkan. -->
<a href="https://plus.google.com/+116775838200274191656?prsrc=3"
   rel="publisher" target="_blank" style="text-decoration:none;display:inline-block;color:#333;text-align:center; font:13px/16px arial,sans-serif;white-space:nowrap;">
<img src="//ssl.gstatic.com/images/icons/gplus-64.png" alt="" style="border:0;width:64px;height:64px;"/><br />
<span style="font-weight:bold;">Disdik Bengkalis</span><br /><span>di Google+</span>
</a><br>
<br>
 <a href="https://www.instagram.com/disdikbengkaliskab/" target="_blank"><img src="<?php echo base_url(); ?>baru/images/instagram.png" alt=""></a>
 
 <br />
<span style="font-weight:bold;">Disdik Bengkalis</span><br /><span>di Instagram</span>
</div>
 </div>
	</div>

	<!--S:Berita Terkait-->

<div class="title_box hijaumuda">
 <span>Galeri Foto Lainnya</span>
 <a href="<?php echo base_url(); ?>mobile/link/galeri-foto" class="btn_more2 fr">+</a>
 </div>
<div class="hotpoto fotoku">
  <?php
    $terkait     = $this->News_model->Galeri_Terkait($id_berita);
	foreach($terkait->result_array() as $head){
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
<div class="clearfix"></div>
<div class="clearfix"></div>
<br><br>
<!-- E:Berita Terkait -->

   <div class="title_box hijau">
    <span>TULIS KOMENTAR</span>
    <a href="#" class="btn_more2 fr">+</a>
</div>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	 
    
    <div class="fb-comments" data-href="https://disdik.bengkaliskab.go.id/mobile/detailfoto/<? echo $id_berita;?>" data-numposts="5" data-colorscheme="light"></div>
    
		<div class="title_box merah">
		<span>TERPOPULER</span>
		<a href="#" class="btn_more2 fr">+</a>
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
			
		
		
</div>