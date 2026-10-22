

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Permohonan Keberatan Selesai</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Permohonan Keberatan Selesai</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                    <div class="btn-toolbar" style="margin-bottom:20px;">
                                      <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahkeberatan"> Tambah Data</a>&nbsp;
      <a class="btn btn-info" href="<?php echo base_url(); ?>webadmin/keberatan">PERMOHONAN BARU</a>&nbsp;
    <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/keberatanfinal">PERMOHONAN SELESAI</a>

  </div>
                                                 <div class="table-responsive">
                                        <div class="table-responsive">
	
<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<tr><td width="25"><strong>No.</strong></td>
  <td width="57"><strong>Data Pemohon</strong></td>
  <td width="97"><strong>Judul Pengaduan<em>*</em></strong></td>
  <td width="107"><strong>Alasan Keberatan</strong></td>
<td width="107"><strong>Isi</strong></td>
<td width="107"><strong>Tanggal</strong></td>
<td width="56"><strong>Status</strong></td>
<td><strong>Waktu Pemenuhan</strong></td>
<td><strong>Ket</strong></td>
</tr>
</thead>
<tbody>
<?php 
$no = $page+1;
foreach($daftarartikel->result_array() as $artikel){ 
	$file = str_replace('media/file/','',$artikel['foto']);
	?>
<tr class="tr">
<td align='center'><?php echo $no; ?></td>
<td><strong><?php echo $artikel['nik']; ?> <a target="_blank" href='<?php echo base_url(); ?>media/ktp/<? echo $file;?>'> <i class="fa fa-search" aria-hidden="true"></i> </a></strong><br><strong><?php echo $artikel['nama']; ?></strong><br>
  <?php echo $artikel['alamat']; ?><br>
  <?php echo $artikel['phone']; ?><br>
  <?php echo $artikel['email']; ?><br><br>
  <a href='<?php echo base_url()."webadmin/editkeberatan/".$artikel['id_keberatan'];?>' title='Edit Content'class="btn btn-warning">
 <i class="glyphicon glyphicon-edit"></i>Ubah</a>&nbsp;
  <a href='<?php echo base_url()."webadmin/proseskeberatan/".$artikel['id_keberatan'];?>' title='Edit Content'class="btn btn-info">
 <i class="glyphicon glyphicon-edit"></i>Proses</a><br><br>
 
 <a onClick="return confirm('Anda yakin ingin menghapus data ini?')" href='<?php echo base_url()."webadmin/hapuskeberatan/".$artikel['id_keberatan'];?>'
  title='Edit Content'class="btn btn-danger">
 <i class="glyphicon glyphicon-trash"></i> Hapus</a>&nbsp;
  <a target="_blank" href='<?php echo base_url()."webadmin/cetakkeberatan/".$artikel['id_keberatan'];?>' 
  title='Edit Content'class="btn btn-success">
 <i class="glyphicon glyphicon-print"></i> Cetak </a>
  
  
  </td>
<td><?php echo substr($artikel['rincian'],0,100); ?></td>
<td><?php echo $artikel['alasan']; ?></td>
<td><?php echo $artikel['tujuan']; ?></td>
<td><?php echo tgl_indo($artikel['posted_date']); ?></td>
<td><?php echo $artikel['status']; ?></td>
<td width="124"><?php echo tgl_indo($artikel['pemenuhan']); ?></td>
<td width="124"><?php echo $artikel['ket']; ?></td>
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