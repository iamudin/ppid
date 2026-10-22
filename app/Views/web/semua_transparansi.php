<section id="tour-des" class="bg-white">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Transparansi</h6>
			<h2>Anggaran</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">

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
			