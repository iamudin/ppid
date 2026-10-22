

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Polling</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Polling</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
			<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahsoalpoll"> Tambah Soal Polling</a>&nbsp;
        <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahjwbpoll">Tambah Jawaban Polling</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/polling">Refresh</a>
		</div>
                                    <div class="table-responsive5">
     <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead>
<tr>
<th width="4%">No.</th>
<th width="47%">Soal</th>
<th width="25%">Jawaban</th>
<th width="8%">Counter</th>
<th width="16%" colspan="2"><strong>Aksi</strong></th>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($jwb_poll->result_array() as $artikel){ ?>
<tr class="tr">
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['soal_poll']; ?></td>
<td><?php echo $artikel['jawaban']; ?></td>
<td><?php echo $artikel['counter']; ?></td>
<?php
echo"<td>
	<a class='btn btn-info' href='".base_url()."index.php/webadmin/editjwbpoll/".$artikel['id_jawaban_poll']."'><i class='fa fa-edit'></i></a></td><td><a class='btn btn-danger' href='".base_url()."index.php/webadmin/hapusjwbpoll/".$artikel['id_jawaban_poll']."' onClick=\"return confirm('Anda yakin ingin menghapus data ini?')\" ><i class='fa fa-trash'></i></a></td>";
?>
</tr>
<?php 
	$no++;
 }
  
?>
</tbody>
</table>
                                   <div class="pagination pagination-centered">
		<ul>
		<?php
		echo $paginator;
		?>
		</ul>
	</div>						</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->