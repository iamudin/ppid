 <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Kepegawaian</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Kepegawaian</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahkepegawaian"> Tambah Data</a>&nbsp;
        <a class="btn btn-info" href="<?php echo base_url(); ?>webadmin/tambahjabatan">Tambah Jabatan</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/kepegawaian">Refresh</a>
		
	</div>
                                    <div class="table-responsive5">
                                    <form method="post" action="<?php echo base_url(); ?>webadmin/simpanjabatan">
<div class="form-group">
                            <label class="control-label">Jabatan</label>
                            <input type="search" name="nama" class="input form-control" size="35" style="width:65%;" /></div>
                             <button type="submit" class="btn btn-primary">Simpan Data</button>
   
</form> 
<br>
                                      <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead>
<tr>
<th width="34">No.</th>
<th width="555">Jabatan</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr>
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['jabatan']; ?></td>
<td width="500">
  <a class="btn btn-info" href="<?php echo base_url()."webadmin/editjabatan/".$artikel['id_jabatan'];?>">
    <i class="fa fa-edit"></i>
    </a>&nbsp;
  <a class="btn btn-danger" href="<?php echo base_url()."webadmin/hapusjabatan/".$artikel['id_jabatan'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
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