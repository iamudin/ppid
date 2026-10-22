

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Pengguna</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
			<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahpengguna"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/pengguna">Refresh</a>
	
	</div>
                                    <div class="table-responsive5">
   <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr><th>No.</th>
<th>Nama</th>
<th>Alamat</th>
<th>Username</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr class="tr">
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['nama']; ?></td>
<td><?php echo $artikel['alamat']; ?></td>
<td><?php echo $artikel['username']; ?></td>
<td><?php echo $artikel['akses']; ?></td>
<td width="15%"><a href='<?php echo base_url()."webadmin/editwartawan/".$artikel['kode_wartawan'];?>' title='Edit Content'class="btn btn-info">
 <i class="fa fa-edit"></i></a>&nbsp;
  <a href='<?php echo base_url()."webadmin/hapuswartawan/".$artikel['kode_wartawan'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'class="btn btn-danger">
 <i class="fa fa-trash"></i></a>
</td>
</tr>
<?php 
	$no++;
 }
  
?>
</tbody>
</table>    <nav aria-label="Page navigation example">

                                 


		<?php
		echo $paginator;
		?>
		
	</nav>      	</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
