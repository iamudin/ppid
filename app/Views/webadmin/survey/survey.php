

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Survey</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Survey</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		  <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/survey">Refresh</a>&nbsp;
		<a class="btn btn-success" href="<?php echo base_url(); ?>pertanyaan">Pertanyaan Survey</a>

	</div>
                                    <div class="table-responsive5">
                                    
<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<tr><td width="40" height="28"><strong>No.</strong></td>
<td width="154"><strong>Nama Depan</strong></td>
<td width="175"><strong>Nam Belakang</strong></td>
<td width="70"><strong>Email</strong></td>
<td width="90"><strong>HP/WA</strong></td>
<td width="122"><strong>Pekerjaan</strong></td>
<td width="118"><strong>Jenis Pelayanan</strong></td>
<td width="155"><strong>Saran</strong></td>
<td><strong>Aksi</strong></td></tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr class="tr">
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['nama_depan']; ?></td>
<td><?php echo $artikel['nama_belakang']; ?></td>
<td><?php echo $artikel['email']; ?></td>
<td><?php echo $artikel['wa']; ?></td>
<td><?php echo $artikel['pekerjaan']; ?></td>
<td><?php echo $artikel['pelayanan']; ?></td>
<td align="center"><?php echo $artikel['saran']; ?></td>
<td width="130"><a href='<?php echo base_url()."webadmin/tampilpengirim/".$artikel['id_pengirim'];?>' title='Edit Content'class="btn btn-info">
 <i class="fa fa-search"></i></a>&nbsp;
  <a href='<?php echo base_url()."webadmin/hapuspengirim/".$artikel['id_pengirim'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'class="btn btn-danger">
 <i class="fa fa-trash"></i></a>
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

            