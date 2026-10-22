
	<!--  blog-single-content start-->
	<section id="blog-single-main-detail" class="detail">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 col-sm-12 col-12">
					<div class="all-single-cover">
						
						  <ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
  <li class="breadcrumb-item active" style="text-transform: capitalize;">Agenda Kegiatan</li>
</ol>
						<div class="blog-single-dd-hed">
							<h4><a href="#!"><? echo $judul_berita;?></a></h4><br>
							<div id="isiku"> <table class="table table-bordered" width="100%">
                                        <tr>
                                            <td width="25%">Tanggal</td>
                                            <td width="1%">:</td>
                                            <td width="74%"><? echo tgl_indo($tanggal);?></td>
                                        </tr>
                                        <tr>
                                            <td>Jam</td>
                                            <td>:</td>
                                            <td><? echo $jam;?></td>
                                        </tr>
                                        <tr>
                                            <td>Agenda</td>
                                            <td>:</td>
                                            <td> <?
		echo $isi;
		?> </td>
                                        </tr>
                                        <tr>
                                            <td>Lokasi</td>
                                            <td>:</td>
                                            <td><? echo $lokasi;?> </td>
                                        </tr>
                                         <tr>
                                            <td>Petugas Liputan</td>
                                            <td>:</td>
                                            <td>
                                            
                                          <?php 
		
		$car=$this->News_model->Car_Pegawai($id_berita);
		foreach($car->result_array() as $sm)
		{ ?>
        
        			<div class="media">
    <div class="media-left" style="display: inline;
     float:left;">
      <img src="<?php echo base_url(); ?>asset/pegawai/<? echo $sm['gambar'];?>" class="media-object img-circle" style="width:45px;height:45px;">
    </div>
    <div class="media-body">
      <h4 class="media-heading"><? echo $sm['nama_pegawai'];?> <small><i><? echo $sm['ket'];?></i></small></h4>
      
      </div>
</div>
        <?php } ?>
                                            </td>
                                        </tr>
                                         
                                    
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
				