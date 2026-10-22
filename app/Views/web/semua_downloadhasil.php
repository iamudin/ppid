<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Informasi Publik</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			  <form method="post" action="<?php echo base_url(); ?>web/caridownload">
      <div class="row"> 	
                <div class="col-md-12">	
     
    		 <div class="input-group">
        <div class="form-group  has-feedback">
            <input name="kunci" placeholder="Pencarian Dokumen" type="text" class="form-control" id="inputSuccess5">
            <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
        </div>
        <span class="input-group-btn">
            
            <button class="btn btn-danger" type="button">Cari</button>
        </span>
    </div>
    
			
   </div>
   
   </div>
   </form>
      
       <hr>
					<table class="table table-bordered table-responsive" width="100%">
                    <thead>
 <tr align="center" class="trhead">
<th width="3%">No.</th>
<th width="26%">Nama Data</th>
<th width="16%">PPID Utama/Pembantu</th>
<th width="12%">Ukuran</th>
<th width="12%">Tanggal</th>
<th width="10%">Download</th>
<th width="21%">Tindakan</th>
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
<td align="left"><strong><a href="<?php echo base_url(); ?>web/tampilkan/<? echo $bi['kode_download'];?>/<? echo $file;?>" ><? echo $bi['download'];?></a></strong><br><? echo $bi['ket'];?>
</td>
<td ><? echo $bi['skpd'];?></td>
<td ><? echo filesize($realfile);?> Kb</td>
<td ><? echo tgl_indo($bi['tanggal']);?></td>
<td><? echo $bi['counter'];?> Kali</td>
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
<div class="blog-pagination d-flex justify-content-center text-center">
						<div class="wrapper blog-wrapper">
							<?php echo $paginator;?>
						</div>
					</div>
						
		</div>
	</section>
	<!-- team end-->