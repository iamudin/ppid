

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Permohonan Informasi Publik</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Permohonan Informasi Publik</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                <div class="btn-toolbar" style="margin-bottom:20px;">
          <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahpermohonan"> Tambah Data</a>&nbsp;
                                    
          <a class="btn btn-info" href="<?php echo base_url(); ?>webadmin/permohonan">PERMOHONAN BARU</a>&nbsp;
          <a class="btn btn-warning" href="<?php echo base_url(); ?>webadmin/permohonanpembantu">DISPOSISI PPID PEMBANTU</a>&nbsp;
        <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/permohonanfinal">PERMOHONAN SELESAI</a>

            </div>
                             <div class="table-responsive5">
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
    <a href='<?php echo base_url()."webadmin/editpermohonan/".$artikel['id_pemohon'];?>' title='Edit Content'class="btn btn-warning">
 <i class="fa fa-edit"></i> Ubah</a>&nbsp;
  <a href='<?php echo base_url()."webadmin/prosespermohonan/".$artikel['id_pemohon'];?>' title='Edit Content'class="btn btn-info">
 <i class="fa fa-edit"></i> Proses </a><br><br>
 
 <a onClick="return confirm('Anda yakin ingin menghapus data ini?')" href='<?php echo base_url()."webadmin/hapuspermohonan/".$artikel['id_pemohon'];?>'
  title='Edit Content'class="btn btn-danger">
 <i class="fa fa-trash"></i> Hapus</a>&nbsp;
  <a target="_blank" href='<?php echo base_url()."webadmin/cetakpermohonan/".$artikel['id_pemohon'];?>' 
  title='Edit Content'class="btn btn-success">
 <i class="fa fa-print"></i> Cetak </a><br><br>
 
 <?php if ($artikel['jenisku']=="ORMAS"){ ?>
  <a href='<?php echo base_url()."webadmin/editkpt/".$artikel['id_pemohon'];?>' title='Edit Content'class="btn btn-warning">
 <i class="fa fa-edit"></i> Lihat KTP</a>&nbsp;
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

