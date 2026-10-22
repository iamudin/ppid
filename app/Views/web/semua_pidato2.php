<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Laporan Tahunan</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
					<table width="100%" class="table table-bordered table-responsive">
                    <thead>
 <tr align="center" class="trhead">
<th width="3%">No.</th>
<th width="32%">Nama Data</th>
<th width="20%">Ukuran</th>
<th width="15%">Tanggal</th>
<th width="30%">Tindakan</th>
</tr>
</thead>
<tbody>
<?php
		$nom=1;
		$path = "./media/file";
$dh = dir($path);
	    foreach($semua->result_array() as $bi){
	    $file = str_replace('media/file/','',$bi['file']);
		 $realfile = $path . "/" . $file;
		 //echo $file_path;
		  //$size      = filesize($file_path);
		?>
        <tr>
<td style="text-align:center;"><? echo $nom;?></td>
<td align="left"><a href="<?php echo base_url(); ?>web/tampilkan/<? echo $bi['kode_download'];?>/<? echo $file;?>" ><? echo $bi['download'];?></a>
</td>
<td><? echo filesize($realfile);?> Kb</td>
<td><? echo tgl_indo($bi['tanggal']);?></td>
<td align="center"><a class="btn btn-danger btn-sm" target="_blank" href="<?php echo base_url(); ?>web/unduh/<? echo $bi['kode_download'];?>/<? echo $file;?>" >Download</a>

<a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>web/tampilkan/<? echo $bi['kode_download'];?>/<? echo $file;?>" >Tampilkan</a>
</td>

</tr>            
        <?
	$nom++;
}
?>
</tbody>
</table>
				
				
				
			
			<!--Model box-->
			<br>

						
		</div>
	</section>
	<!-- team end-->