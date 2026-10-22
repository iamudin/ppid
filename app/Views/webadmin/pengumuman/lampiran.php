

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item d-none d-sm-block"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Pengumuman</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Pengumuman</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                    <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahpengumuman"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/pengumuman">Refresh</a>
    
    </div>
                                    <div class="table-responsive">
                                    <style type="text/css">
.batasiklan{
	border-bottom:2px solid #dba427;
	padding-bottom:5px;
	font-size:16px;
}

</style>
<?php
$menuk=$this->uri->segment(3);
?>
           <div class="batasiklan">Tekan <b>F5</b> Untuk Refresh dan Upload file Berikutanya,File Yang di upload bisa lebih dari satu/multiple
           &nbsp;
           <a class="btn btn-primary" href="<?php echo base_url(); ?>webadmin/tambahlampiran/<?php echo $menuk;?>">Refresh</a>
           </div>
           <div class="cleaner_h5"></div>
 <script src="<?php echo base_url(); ?>asset/blank/assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
       
<link href="<?php echo base_url(); ?>drop/dropzone.min.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>drop/dropzone.min.js"></script>
     <form action="<?php echo site_url('/webadmin/uploadlampiranbaru'); ?>" class="dropzone"  >
     <input type="hidden" name="id_param" value="<?php echo $menuk;?>">
</form>
   
<br />
	<div class="table-responsive">
<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th>
<strong>No</strong></th>
<th><strong>Judul Pengumuman</strong></th>
<th><strong>Nama File</strong></th>
</tr>
</thead>
<tbody>
<?php 
$no = 1+$page;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr class="tr">
<td><?php echo $no; ?></td>
<td><?php echo $artikel['judul_pengumuman']; ?><br><br>
<a href='<?php echo base_url()."webadmin/hapuslampiran/".$artikel['id_lampiran'];?>/<?php echo $menuk;?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'class="btn btn-danger">
 <i class="fa fa-trash"></i> </a>
</td>
<td><a href="<?php echo base_url(); ?>asset/lampiran/original/<?php echo $artikel['file']; ?>" width="150"/><?php echo $artikel['file']; ?></a></td>

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

