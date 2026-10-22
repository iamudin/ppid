

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">PPID</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">PPID</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahpembantu"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/pembantu">Refresh</a>
            </div>
                             <div class="table-responsive5">
   <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr><th>No.</th>
<th>Nama</th>
<th>Email</th>
<th>Perangkat Daerah</th>
<th>Username</th>
<th>Cover</th>
<th>Alamat</th>
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
<td><?php echo $artikel['email']; ?></td>
<td><?php echo $artikel['skpd']; ?></td>
<td><?php echo $artikel['username']; ?></td>
<td width="15%"><img style="width:100%" src="<?php echo base_url(); ?>asset/banner/<?php echo $artikel['gambar']; ?>"/></td>
<td width="15%"><?php echo $artikel['alamat']; ?></td>
<td width="15%"><a href='<?php echo base_url()."webadmin/editpembantu/".$artikel['id_pembantu'];?>' title='Edit Content'class="btn btn-info">
  <i class="fa fa-edit"></i></a>&nbsp;
  <a href='<?php echo base_url()."webadmin/hapuspembantu/".$artikel['id_pembantu'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'class="btn btn-danger">
    <i class="fa fa-trash"></i></a>
</td>
</tr>
<?php 
	$no++;
 }
  
?>
</tbody>
</table>
                                  

<?php
        echo $paginator;
        ?>
                               
                                </div>      
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

