
        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Galeri Foto</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Galeri Foto</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahalbum"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/galeri">Kembali</a>
	</div>
                                    <div class="table-responsive5">
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
           <div class="batasiklan">Tekan <b>F5</b> Untuk Refresh dan Upload Foto Berikutanya,Foto Yang di upload bisa lebih dari satu/multiple
           &nbsp;
           <a class="btn btn-primary" href="<?php echo base_url(); ?>webadmin/tambahfoto/<?php echo $menuk;?>">Refresh</a>
           </div>
           <div class="cleaner_h5"></div>
 <script src="<?php echo base_url(); ?>asset/blank/assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
       
<link href="<?php echo base_url(); ?>drop/dropzone.min.css" type="text/css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>drop/dropzone.min.js"></script>
<script type="application/javascript">
$(function(){
  Dropzone.options.myAwesomeDropzone = {
   maxFilesize: 5,
    addRemoveLinks: true,
    dictResponseError: 'Server not Configured',
    acceptedFiles: "image/jpeg,image/png,image/gif",
    init:function(){
      var self = this;
      // config
      self.options.addRemoveLinks = true;
      self.options.dictRemoveFile = "Delete";
      //New file added
      self.on("addedfile", function (file) {
        console.log('new file added ', file);
      });
      // Send file starts
      self.on("sending", function (file) {
        console.log('upload started', file);
        $('.meter').show();
      });
      
      // File upload Progress
      self.on("totaluploadprogress", function (progress) {
        console.log("progress ", progress);
        $('.roller').width(progress + '%');
      });

      self.on("queuecomplete", function (progress) {
        $('.meter').delay(999).slideUp(999);
      });
      
      // On removing file
      self.on("removedfile", function (file) {
        console.log(file);
      });
    }
  };
})
</script>
     <form action="<?php echo site_url('/webadmin/uploadfotobaru'); ?>" class="dropzone" id="my-awesome-dropzone" >
     <input type="hidden" name="id_param" value="<?php echo $menuk;?>">
</form>
   
<br />
	<div class="table-responsive5">
<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
<tr>
<th>
<strong>No</strong></th><th><strong>Nama Berita Foto</strong></th><th><strong>Nama File</strong></th>
</tr>
</thead>
<tbody>
<?php 
$no = 1;
foreach($daftarartikel->result_array() as $artikel){ ?>
<tr class="tr">
<td><?php echo $no; ?></td>
<td><?php echo $artikel['nama_album']; ?><br><br>
<a href='<?php echo base_url()."webadmin/editfoto/".$artikel['id_foto'];?>/<?php echo $menuk;?>' title='Edit Content' class="btn btn-info">
 <i class="fa fa-edit"></i></a>&nbsp;<a href='<?php echo base_url()."webadmin/hapusfoto/".$artikel['id_foto'];?>/<?php echo $menuk;?>' onClick="return confirm('Anda yakin ingin menghapus data ini?')" title='Hapus Content'class="btn btn-danger">
 <i class="fa fa-trash"></i> </a>
</td>
<td><img class="gambar" src="<?php echo base_url(); ?>asset/galeri/original/<?php echo $artikel['foto_besar']; ?>" width="150"/></td>

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

