

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Data Statis</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Data Statis</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
            	<div class="btn-toolbar" style="margin-bottom:20px;">
			<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahstatis"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/statis">Refresh</a>
			</div>
                             <div class="table-responsive5">
                             <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr><th>No.</th>
<th>Judul Data</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr class="tr">
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['title']; ?></td>
<td width="49%"><a class="btn btn-info" href='<?php echo base_url()."webadmin/editstatis/".$artikel['id_data'];?>' title='Edit Content'class="btn btn-small">
 <i class="fa fa-edit"></i></a>&nbsp;
  <a href='<?php echo base_url()."webadmin/hapusstatis/".$artikel['id_data'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'class="btn btn-danger">
 <i class="fa fa-trash"></i></a>
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


       