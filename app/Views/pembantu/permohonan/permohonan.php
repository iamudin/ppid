 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Permohonan Informasi Publik</h1>
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
                                  
		  <a class="btn btn-info" href="<?php echo base_url(); ?>pembantu/permohonan">PERMOHONAN BARU</a>
		<a class="btn btn-success" href="<?php echo base_url(); ?>pembantu/permohonanfinal">PERMOHONAN SELESAI</a>

	</div>
                                    <div class="table-responsive">
                                        <div class="table-responsive">
	
<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<tr><td width="25"><strong>No.</strong></td>
  <td width="57"><strong>Data Pemohon</strong></td>
  <td width="97"><strong>Rincian Informasi</strong></td>
<td width="107"><strong>Tujuan</strong></td>
<td width="107"><strong>Tanggal</strong></td>
<td width="56"><strong>PPID Dituju</strong></td>
<td width="56"><strong>Mendapatkan Salinan Informasi</strong></td>
<td width="56"><strong>Cara Mendapatkan Salinan Informasi</strong></td>
<td width="56"><strong>Status</strong></td>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){
	$file = str_replace('media/file/','',$artikel['foto']);
		 //$realfile = $path . "/" . $file;
	?>
<tr class="tr">
<td align='center'><?php echo $no; ?></td>
<td><strong><?php echo $artikel['nik']; ?> <a target="_blank" href='<?php echo base_url(); ?>media/ktp/<? echo $file;?>'> <i class="fa fa-search" aria-hidden="true"></i> </a><br>
 
	 <?php echo $artikel['nama']; ?></strong><br>
  <?php echo $artikel['alamat']; ?><br>
  <?php echo $artikel['phone']; ?><br>
  <?php echo $artikel['email']; ?><br>
  <?php echo $artikel['jenis']; ?><br><br>
   
  <a href='<?php echo base_url()."pembantu/prosespermohonan/".$artikel['id_pemohon'];?>' title='Edit Content'class="btn btn-info">
 <i class="glyphicon glyphicon-edit"></i> Proses </a> </a><br><br>
 
 <?php if ($artikel['jenisku']=="ORMAS"){ ?>
  <a target="_blank" href='<?php echo base_url()."pembantu/editkpt/".$artikel['id_pemohon'];?>' title='Edit Content'class="btn btn-warning">
 <i class="glyphicon glyphicon-edit"></i> Lihat KTP</a>&nbsp;
 <?php }?>
 </td>
<td><?php echo substr($artikel['rincian'],0,100); ?></td>
<td><?php echo $artikel['tujuan']; ?></td>
<td><?php echo tgl_indo($artikel['posted_date']); ?></td>
<td><?php echo $artikel['skpd']; ?></td>
<td><?php echo $artikel['salinan']; ?></td>
<td><?php echo $artikel['cara2']; ?></td>
<td><?php echo $artikel['status']; ?></td>
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
            