
<!--S:DETAIL-->


<div class="detail">
	<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
        <div class="date"><strong><? echo tgl_indo($tanggal);?> | <? echo $waktu;?> WIB</strong> - Dibaca: <strong><? echo $counter;?></strong> kali</div>
		<div class="sub"><? echo $anak;?></div>
		<h1 class="jdl"><? echo $judul_berita;?></h1>
		
		<div class="clearfix"></div>
	</div>
	<!--E:JUDUL ARTICLE-->
 
    

    
    <div class="text_detail detail_area" id="detikdetailtext">
    	<div align="center">
    
   
     <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>		
							 
   

    </div>
			   <?
		echo $isi;
		?>
               </div>
		
						                	                		               

</article>
 

<!--E:ISI ARTICLE-->
<div class="detail_area">
	
	<table width="100%">
  <tbody>
    <tr>
      <td rowspan="3" valign="top"><img width="100" src="<?php echo base_url(); ?>asset/berita/original/<? echo $gambar;?>"></td>
      <td><? echo $edi;?></td>
    </tr>
    <tr>
      <td><? echo $lead;?></td>
    </tr>
    <tr>
      <td><small class="author-social-links small">
                 <a href="<? echo $foto;?>" class="author-social-link twitter small" target="_blank">
                 <i class="fa fa-2x fa-twitter"></i></a>&nbsp;
                 <a href="<? echo $rep;?>" class="author-social-link gplus small" target="_blank">
                 <i class="fa fa-2x fa-facebook"></i></a>&nbsp;
                 
                  <a href="<? echo $ig;?>" class="author-social-link instagram small" target="_blank">
                 <i class="fa fa-2x fa-instagram"></i></a>&nbsp;
                 
                  <a href="mailto:<? echo $email;?>" class="author-social-link envelope small" target="_blank">
                 <i class="fa fa-2x fa-envelope"></i></a>
                 
                 	 </small><!-- author-social-links --></td>
    </tr>
  </tbody>
</table>
	
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


<!-- E:Berita Terkait -->
  
   <div class="title_box">
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

	 
    
    <div class="fb-comments" data-href="https://diskominfotik.bengkaliskab.go.id/mobile/detailopini/<? echo $id_berita;?>" data-numposts="5" data-colorscheme="light"></div>
    
	
		<!--S:Berita Terkait-->
<div class="title_box hijau">
    <span>Baca Juga</span>
    <a href="#" class="btn_more2 fr">+</a>
</div>
 <div id="newsfeed-container" class="list_feed">
 <?php
 $terkait     = $this->News_model->Berita_Terkait($id_kategori,$id_berita);
	foreach($terkait->result_array() as $bi)
{
	$isi=strip_tags($bi['isi']);
?>  
   <article>
 <a href="<?php echo base_url(); ?>mobile/detailopini/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>" class="list">
  <div class="ratio4_3 box_img">
 <div class="img_con">
 <img src="<?php echo base_url(); ?>asset/berita/large/<? echo $bi['gambar'];?>" alt="<? echo $bi['judul_berita'];?>" title="<? echo $bi['judul_berita'];?>" class=""> </div>
 </div>
 <div class="text">
 <span class="sub"><? echo $bi['anak'];?></span>
 <h2><? echo $bi['judul_berita'];?>	</h2>
 <span class="info"> <?php echo tgl_indo($bi['tanggal']); ?></span>
 </div>

 <div class="clearfix"></div>
 
 </a>
</article>
    <? } ?>
   
   
   
  
</div>
<!-- E:Berita Terkait -->	
			
		
		
</div>