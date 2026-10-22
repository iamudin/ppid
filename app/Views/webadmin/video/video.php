

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Video</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Video</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahvideo"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/video">Refresh</a>
	</div>
                                    <div class="table-responsive5">
     <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr><th>No.</th>
<th>Judul Video</th>
<th>Kategori</th>
<th>Isi</th>
<th>Gambar</th>
<th>Videografer</th>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr class="tr">
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['judul_video']; ?><br><br>
<a href='<?php echo base_url()."webadmin/editvideo/".$artikel['id_video'];?>' title='Edit Content'class="btn btn-info">
 <i class="fa fa-edit"></i></a>&nbsp;
  <a href='<?php echo base_url()."webadmin/hapusvideo/".$artikel['id_video'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'class="btn btn-danger">
 <i class="fa fa-trash"></i></a>
</td>
<td><?php echo $artikel['kategori']; ?></td>
<td><a href="<?php echo $artikel['url']; ?>" target="_blank"><?php echo $artikel['url']; ?></a></td>
<td><img class="gambar" src="<?php echo base_url(); ?>asset/banner/<?php echo $artikel['gambar']; ?>" width="150"/></td>
<td width="15%"><?php echo $artikel['penulis']; ?></td>
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