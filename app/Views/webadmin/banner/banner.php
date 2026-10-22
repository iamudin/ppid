

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Banner</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Banner</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
	<div class="btn-toolbar" style="margin-bottom:20px;">
			<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahbanner"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/banner">Refresh</a>
			</div> <div class="table-responsive5">
                            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<td width="25"><strong>No</strong></td><td width="365"><strong>Nama</strong></td><td width="284"><strong>File</strong></td><td width="390"><strong>Aksi</strong></td></tr>
</thead>
<tbody>
<?php 
$no = 1+$page;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr class="tr">
<td><?php echo $no; ?></td>
<td><?php echo $artikel['judul']; ?></td>
<td><img style="width:100%" src="<?php echo base_url(); ?>asset/banner/<?php echo $artikel['foto_besar']; ?>"/></td>
<td><a href='<?php echo base_url()."index.php/webadmin/editbanner/".$artikel['id_banner'];?>' title='Edit Content' class="btn btn-info">
 <i class="fa fa-edit"></i></a>&nbsp;<a href='<?php echo base_url()."index.php/webadmin/hapusbanner/".$artikel['id_banner'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'class="btn btn-danger">
 <i class="fa fa-trash"></i> </a>
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
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


       