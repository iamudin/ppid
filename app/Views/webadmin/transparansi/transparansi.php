

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Transparansi</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Transparansi</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahtransparansi"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/transparansi">Refresh</a>
            </div>
                             <div class="table-responsive5">
                                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead>
<tr>
<th width="30">No.</th>
<th width="361">Judul</th>
<th width="231">Jenis Transparansi</th>
<th width="158">Tahun</th>
<th width="161">Perangkat Daerah</th>
<th width="161">Tanggal</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr>
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['judul']; ?></td>
<td><?php echo $artikel['jenistransparansi']; ?></td>
<td><?php echo $artikel['tahun']; ?></td>
<td><?php echo $artikel['skpd']; ?></td>
<td><?php echo tgl_indo($artikel['tanggal']); ?></td>
<td width="119">
  <a class="btn btn-info" href="<?php echo base_url()."webadmin/edittransparansi/".$artikel['id_transparansi'];?>">
  <i class="fa fa-edit"></i>
  </a>&nbsp;
  <a class="btn btn-danger" href="<?php echo base_url()."webadmin/hapustransparansi/".$artikel['id_transparansi'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
    <i class="fa fa-trash"></i>
    </a>
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
