
	<!--  blog-single-content start-->
	<section id="blog-single-main-detail" class="detail">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-12 col-12">
					<div class="all-single-cover">
						
						  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
  <li class="breadcrumb-item active" style="text-transform: capitalize;">Pengumuman</li>
</ol>
						<div class="blog-single-dd-hed">
							<h4><a href="#!"><? echo $judul_berita;?></a></h4><br>
							<div id="isiku">  <?
		echo $isi;
		?>
                         <hr>
                          <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th>
<strong>No</strong></th>
<th><strong>Nama File</strong></th>
<th><strong>Tindakan</strong></th>
</tr>
</thead>
<tbody>
<?php 
	$car=$this->News_model->Car_Lampiran($id_berita);
$no = 1;
foreach($car->result_array() as $artikel){ ?>
<tr class="tr">
<td><?php echo $no; ?></td>
<td><?php echo $artikel['file']; ?>
</td>
<td>
 <a class="btn btn-danger btn-xs" target="_blank" href="<?php echo base_url(); ?>asset/lampiran/original/<?php echo $artikel['file']; ?>" >Download Lampiran</a>
</td>

</tr>
<?php 
$no++;
 }
  
?>
</tbody>
</table>
                               </div>
						</div>
						
						
						
						<div class="inner-tahesxx">
							<hr>
							<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5d66391c5fea9f001288d5bf&product=inline-share-buttons' async='async'></script>

<div class="sharethis-inline-share-buttons"></div> 
							
						</div>
						
						
						<div class="lave-cooment">
							
						</div>

						
					</div>
				</div>
				