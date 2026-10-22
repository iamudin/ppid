

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Galeri Foto</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">BGaleri Foto</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahalbum"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/galeri">Refresh</a>
		</div>
                                    <div class="table-responsive5">
                                       <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th>No.</th>
<th>Judul Berita Foto</th>
<th>Fotografer</th>
<th>Tanggal</th>

</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr>
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['nama_album']; ?><br><br>
<a class="btn btn-info" href="<?php echo base_url()."webadmin/editalbum/".$artikel['id_album'];?>">
  <i class="fa fa-edit"></i>
  </a>&nbsp;
  <a class="btn btn-danger" href="<?php echo base_url()."webadmin/hapusalbum/".$artikel['id_album'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
    <i class="fa fa-trash"></i>
    </a>&nbsp;<a class="btn btn-success" href="<?php echo base_url()."webadmin/tambahfoto/".$artikel['id_album'];?>"> Tambah Foto Album</a>
	

</td>
<td><?php echo $artikel['penulis']; ?></td>
<td><?php echo tgl_indo($artikel['tanggal_album']); ?></td>


</tr>
<?php 
	$no++;
 }
  
?>
</tbody>
</table>
                           <nav aria-label="Page navigation example">

                                 


		<?php
		echo $paginator;
		?>
		
	</nav>      
                                      
							</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

