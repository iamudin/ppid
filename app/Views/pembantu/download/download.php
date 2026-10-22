 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Informasi Publik</h1>
                        <small><?php echo $this->config->item("nama_aplikasi_full"); ?></small>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>app_admin_home"><i class="pe-7s-home"></i> Home</a></li>
                            
                            <li class="active">Welcome</li>
                        </ol>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Master Data</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
	<a class="btn btn-success" href="<?php echo base_url(); ?>pembantu/tambahdownload"> Tambah Data</a>
        <a class="btn btn-default" href="<?php echo base_url(); ?>pembantu/download">Refresh</a>
			</div>
                                    <div class="table-responsive">
                                        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%"><thead>
<tr>
<th>No.</th>
<th>Informasi</th>
<th>Judul</th>
<th>Tanggal</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr>
<td align='center'><?php echo $no; ?></td>
<td><?php echo $artikel['title']; ?></td>
<td><?php echo $artikel['download']; ?></td>
<td><?php echo tgl_indo($artikel['tanggal']); ?></td>
<td width="107">
  <a class="btn btn-info" href="<?php echo base_url()."pembantu/editdownload/".$artikel['kode_download'];?>">
  <i class="glyphicon glyphicon-edit"></i>
  </a>&nbsp;
  <a class="btn btn-danger" href="<?php echo base_url()."pembantu/hapusdownload/".$artikel['kode_download'];?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
    <i class="glyphicon glyphicon-trash"></i>
    </a>
</td>

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
	</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            