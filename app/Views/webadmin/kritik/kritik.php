

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Pengunjung</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Pengunjung</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		  <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/kritik">Refresh</a>&nbsp;
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/kritikview">Data Yang Di Tampilkan</a>

	</div>
                                    <div class="table-responsive5">
                                    
<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<tr><td width="25"><strong>No.</strong></td>
<td width="57"><strong>Nama</strong></td>
<td width="103"><strong>Alamat</strong></td>
<td width="100"><strong>No.Hp</strong></td>
<td width="60"><strong>Email</strong></td>
<td width="97"><strong>Pesan</strong></td>
<td width="107"><strong>Tanggal</strong></td>
<td width="56"><strong>Status</strong></td>
<td><strong>Aksi</strong></td></tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr class="tr">
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['nama']; ?></td>
<td><?php echo $artikel['alamat']; ?></td>
<td><?php echo $artikel['phone']; ?></td>
<td><?php echo $artikel['email']; ?></td>
<td><?php echo substr($artikel['pesan'],0,100); ?></td>
<td><?php echo tgl_indo($artikel['posted_date']); ?></td>
<td align="center"><?php echo $artikel['status']; ?></td>
<td width="124"><a href='<?php echo base_url()."webadmin/editkritik/".$artikel['id_hubungi'];?>' title='Edit Content'class="btn btn-info">
 <i class="fa fa-edit"></i></a>&nbsp;
  <a href='<?php echo base_url()."webadmin/hapuskritik/".$artikel['id_hubungi'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'class="btn btn-danger">
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

            