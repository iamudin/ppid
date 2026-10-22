<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6 style="text-transform: capitalize;"><?php echo $bread;?></h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">

       <hr>
					<table id="table" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"><thead>
<tr>
<th width="35">No.</th>
<th width="504">Judul</th>
<th width="252">Jenis Transparansi</th>
<th width="171">Tahun</th>
<th width="195">Tanggal</th>
<th>Tindakan</th>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){
$file = str_replace('media/file/','',$artikel['file']);
 ?>
<tr>
<td align='center'><?php echo $no; ?></td>
<td><a href="<?php echo base_url(); ?>web/tampilkantransparansi/<? echo $artikel['id_transparansi'];?>/<? echo $file;?>"><?php echo $artikel['judul']; ?></a></td>
<td><?php echo $artikel['jenistransparansi']; ?></td>
<td><?php echo $artikel['tahun']; ?></td>
<td><?php echo tgl_indo($artikel['tanggal']); ?></td>
<td width="385">
  <a target="_BLANK" class="btn btn-danger btn-sm" href="<?php echo base_url()."web/unduhtransparansi/".$artikel['id_transparansi'];?>/<? echo $file;?>">
 Download
  </a>&nbsp;
  <a class="btn btn-primary btn-sm" href="<?php echo base_url()."web/tampilkantransparansi/".$artikel['id_transparansi'];?>/<? echo $file;?>">
    Tampilkan
    </a>
</td>

</tr>
<?php 
	$no++;
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


					<div id="chart2"></div><br>
					 <div class="row">
					 	<?php
					 	$no=1;

foreach($kategori2->result_array() as $k)
{ 
	if($no=="1" OR $no=="5" OR $no=="9" OR $no=="13" OR $no=="17"){
		$warna="primary";
	}
	elseif ($no=="2" OR $no=="6" OR $no=="10" OR $no=="14" OR $no=="18") {
		$warna="danger";
	}
	elseif ($no=="3" OR $no=="7" OR $no=="11" OR $no=="15" OR $no=="19") {
		$warna="success";
	}
	elseif ($no=="4" OR $no=="8" OR $no=="12" OR $no=="16" OR $no=="20") {
		$warna="info";
	}else{
		$warna="primary";
	}	
	$idx=$k['id_jenistransparansi'];
$ar= $this->News_model->Semua_JumlahTransparansi($idx);
  foreach($ar->result_array() as $hm)
{
    $total_lk=$hm['jum'];
}
	?>
    <div class="col-md-3">
    	<a href="<?php echo base_url(); ?>web/detailanggaran/<?php echo $k['id_jenistransparansi'];?>">
      <div class="card-counter <?php echo $warna;?>">
        <i class="fa fa-chart-bar"></i>
        <span class="count-numbers"><?php echo $total_lk;?></span>
        <span class="count-name"><?php echo $k['jenistransparansi'];?></span>
      </div></a>
    </div>
<?php $no++;} ?>
						
		</div>
	</section>
	<!-- team end-->