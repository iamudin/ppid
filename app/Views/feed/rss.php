<?php
echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
?>
<rss version="2.0"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
xmlns:admin="http://webns.net/mvcb/"
xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
xmlns:media="http://search.yahoo.com/mrss/"
xmlns:content="http://purl.org/rss/1.0/modules/content/">
	<channel>
		<title><?php echo $feed_name; ?></title>
		<link><?php echo $feed_url; ?></link>
		<description><?php echo $page_description; ?></description>
		<dc:language><?php echo $page_language; ?></dc:language>
		<dc:creator><?php echo $creator_email; ?></dc:creator>
		<image>
			<url>http://disdik.bengkaliskab.go.id/logo.png</url>
		</image>		

		<dc:rights>Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
		<admin:generatorAgent rdf:resource="http://disdik.bengkaliskab.go.id/" />

		<?php foreach($posts as $row):?>
			
			<item>
				<title><?php echo $row->judul_berita; ?></title>
				<link><?php echo base_url(); ?>web/detailberita/<? echo $row->id_berita;?>/<? echo $row->url;?></link>
				<guid><?php echo base_url(); ?>web/detailberita/<? echo $row->id_berita;?>/<? echo $row->url;?></guid>
				<pubDate><?php echo date('l, F d, Y h:i A', strtotime($row->tanggal));?></pubDate>
				<description>
                
					<![CDATA[
                    <img src="<?php echo base_url('asset/berita/large/'.$row->gambar);?>" width="120" height="70" border="0" align="left" hspace="5"> 
						<?=str_replace('/asset/berita/', base_url() . 'asset/berita/thumb/', $row->isi); ?>
					]]>
				</description>

				<enclosure url="<?php echo base_url('asset/berita/thumb/'.$row->gambar);?>" length="10240" type="image/jpg" />
			</item>

		<?php endforeach; ?>

	</channel>
</rss>