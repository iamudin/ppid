<?php echo header("Content-Type: application/rss+xml"); // important!?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
    <title><?php echo $title;?></title>
    <link>https://diskominfotik.bengkaliskab.go.id/</link>
    <description>
     <?php echo $description;?>
    </description>
    <?php 
foreach($items as $item){ ?>
    <item>
      <title><?php echo $item->judul_berita;?></title>
      <link><?php echo base_url(); ?>web/detailberita/<?php echo $item->id_berita;?>/<?php echo $item->url;?></link>
      <guid><?php echo $item->id_berita;?></guid>
      <pubDate><?php echo date(DATE_RSS, strtotime($item->tanggal." ".$item->waktu));?></pubDate>
      <description><?php echo $item->lite;?></description>
      <content:encoded><![CDATA[
<!doctype html>
<html lang="en" prefix="op: http://media.facebook.com/op#">
<head>
<meta charset="utf-8">
<link rel="canonical" href="<?php echo base_url(); ?>web/detailberita/<?php echo $item->id_berita;?>/<?php echo $item->url;?>">
<meta property="op:markup_version" content="v1.0">
</head>
<body>
<article><header><figure><img src="<?php echo base_url();?>asset/berita/large/<? echo $item->gambar;?>" />
<?php if($item->ket_foto==""){?><figcaption>Foto : Tim Redaksi Diskominfotik</figcaption><? }else{ ?>
<figcaption><? echo $item->ket_foto;?></figcaption><?php } ?></figure>
      
      <h1><?php echo $item->judul_berita;?></h1><time class="op-published" dateTime="<?php echo date(DATE_RSS, strtotime($item->tanggal." ".$item->waktu));?>"><?php echo tgl_indo($item->tanggal) . ' - ' . $item->waktu;?></time><time class="op-modified" dateTime="<?php echo date(DATE_RSS, strtotime($item->tanggal." ".$item->waktu));?>"><?php echo tgl_indo($item->tanggal) . ' - ' . $item->waktu;?></time>
      </header><?php echo $item->isi;?>
    
     <h2>Related Articles</h2>
  <ul class="op-related-articles" title="">
        <?php
						 $id_kategori=$item->id_kategori;
						 $id_berita=$item->id_berita;
 $terkait     = $this->News_model->Berita_Terkait($id_kategori,$id_berita);
	foreach($terkait->result_array() as $bi)
{
	$isi=strip_tags($bi['isi']);
?> 
    <li><a href="<?php echo base_url(); ?>web/detailberita/<? echo $bi['id_berita'];?>/<? echo $bi['url'];?>"><? echo $bi['judul_berita'];?></a></li>
    <?php } ?>
  </ul>
      <p>Ikuti Terus Diskominfotik Bengkalis Melalui Media Sosial </p>
     <figure class="op-interactive">
      <iframe>
        <!-- Include social media embed code here -->  
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.9&appId=353727057999136";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
     <div class="fb-page" data-href="https://www.facebook.com/diskominfotikbengkalis" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/diskominfotikbengkalis" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/diskominfotikbengkalis">Diskominfotik Bengkalis</a></blockquote></div>
      </iframe>
    </figure>
    
<footer><small>© Redaksi Diskominfotik Bengkalis</small></footer></article></body></html>]]></content:encoded></item>
    <?php } ?>
</channel></rss>