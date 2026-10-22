
<!--S:DETAIL-->


<div class="detail">
	<article>
	<!--S:JUDUL ARTICLE-->
	<div class="detail_area">
        <div class="date"><strong><? echo tgl_indo($tanggal);?> | <? echo $waktu;?> WIB</strong> - Dibaca: <strong><? echo $counter;?></strong> kali</div>
		<div class="sub"><? echo $anak;?></div>
		<h1 class="jdl"><? echo $judul_berita;?></h1>
		<div class="author">Editor: <b><? echo $edi;?></b> - Reporter: <b><? echo $rep;?></b> - Fotografer: <b><? echo $foto;?></b></div>
		<div class="clearfix"></div>
	</div>
	<!--E:JUDUL ARTICLE-->
    <?
	if($gambar=="welcome.jpg")
	{
		
	}
	else
	{
		?>
		<div class="pic">
					 <img src="<?php echo base_url(); ?>asset/berita/original/<? echo $gambar;?>?w=650&amp;q=90" alt="<? echo $judul_berita;?>" title="<? echo $judul_berita;?>" class="">			<span><? echo $ket_foto;?></span>
			</div>
            <?
	}
	?>
    

    
    <div class="text_detail detail_area" id="detikdetailtext">
    	<div align="center">
    
   
     <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>		
							 
   

    </div>
			   <?
		echo $isi;
		?>
               </div>
		
						                	                		               

</article>


	<!--S:Berita Terkait-->
<div class="title_box hijau">
    <span>Berita Terkait</span>
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
 <a href="<?php echo base_url(); ?>mobile/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>" class="list">
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

   <div class="title_box merah">
    <span>TULIS KOMENTAR</span>
    <a href="#" class="btn_more2 fr">+</a>
</div>
   
   <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	 
    
    <div class="fb-comments" data-href="<?php echo base_url(); ?>mobile/detailberita/<? echo $id_berita;?>" data-numposts="5" data-colorscheme="light"></div>
    
		<div class="title_box biru">
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
	 <span class="info">Dibaca : <? echo $hd['counter'];?> Kali</span>
 </div>
 <div class="clearfix"></div>
 </a>
 </article>
 <?php $n++;} ?>
			
		
		
</div>