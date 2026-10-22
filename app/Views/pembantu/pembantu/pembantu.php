 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>PPID Pembantu</h1>
                        <small><?php echo $this->config->item("nama_aplikasi_full"); ?></small>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>webadmin"><i class="pe-7s-home"></i> Home</a></li>
                            
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
		       <a class="btn btn-default" href="<?php echo base_url(); ?>pembantu/pengguna">Refresh</a>
	
	</div>
                                    <div class="table-responsive">
   <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr><th>No.</th>
<th>Nama</th>
<th>Email</th>
<th>SKPD/OPD</th>
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
  <i class="glyphicon glyphicon-edit"></i></a>&nbsp;
  <a href='<?php echo base_url()."webadmin/hapuspembantu/".$artikel['id_pembantu'];?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'class="btn btn-danger">
    <i class="glyphicon glyphicon-trash"></i></a>
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
            