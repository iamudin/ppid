

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Proses Permohonan Keberatan</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Proses Permohonan Keberatan</h4>
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
                                    
                                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<tr>
  <td width="57"><strong>Data Pemohon</strong></td>
  <td width="97"><strong>Judul Pengaduan<em>*</em></strong></td>
  <td width="107"><strong>Alasan Keberatan</strong></td>
  <td width="107"><strong>Isi</strong></td>
  <td width="107"><strong>Tanggal</strong></td>
  <td width="56"><strong>Status</strong></td>
  <td><strong>Waktu Pemenuhan</strong></td>
  <td><strong>Ket</strong></td>
</tr>
<tbody>
  <?php 
$no = 1;
foreach($edit->result_array() as $artikel){ 
	$file = str_replace('media/file/','',$artikel['foto']);
	?>
  <tr class="tr">
  <td><strong><?php echo $artikel['nik']; ?> <a target="_blank" href='<?php echo base_url(); ?>media/ktp/<? echo $file;?>'> <i class="fa fa-search" aria-hidden="true"></i> </a></strong><br><strong><?php echo $artikel['nama']; ?></strong><br>
    <?php echo $artikel['alamat']; ?><br>
    <?php echo $artikel['phone']; ?><br>
    <?php echo $artikel['email']; ?><br>
    
  </td>
  <td><?php echo substr($artikel['rincian'],0,100); ?></td>
  <td><?php echo $artikel['alasan']; ?></td>
  <td><?php echo $artikel['tujuan']; ?></td>
  <td><?php echo tgl_indo($artikel['posted_date']); ?></td>
  <td><?php echo $artikel['status']; ?></td>
  <td width="124"><?php echo $artikel['pemenuhan']; ?></td>
  <td width="124"><?php echo $artikel['ket']; ?></td>
  </tr>
  <?php 
	$no++;
 }
  
?>
</tbody>
</table>
     <script type="text/javascript" src="<?php echo base_url(); ?>editor/ckeditor/ckeditor.js"></script>
<?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_keberatan'];
}
?>

<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>webadmin/updatefinalberat" role="form">
			
		 <div class="form-group"> <label>No.Register</label> <input class="form-control" value="<? echo $d['register'];?>" required="required" name="register">  </div>
		
			
                    <div class="form-group">
                            <label>Pilih Status Permohonan</label>
                            <select name="kategori" class="input form-control" id="kategori">
                            <option value="Ditanggapi">Ditanggapi</option>
  <option value="Tidak Ditanggapi">Tidak Ditanggapi</option>
  </select>
                </div>                                    
				
			
                       
			
			<div class="form-group">
                            <label>Keterangan</label>
                            <textarea rows="3" class="form-control" name="rincian_informasi2"><?php echo $d['ket'];?>
                            	
                            </textarea>
                </div>
                                                        
               
                        
                        
		
		
			
			
			
				<input type="submit" value="Simpan Permohonan" class="btn btn-primary" tabindex="7">
				
			
			 <br>
			 <input type="hidden" name="id" value="<? echo $id;?>" />
		</form>
<hr class="colorgraph">
<legend>Upload Kelengkapan Berkas</legend>


<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>webadmin/updatefinalberkasberat" role="form">
			
		
		
			
                    <div class="form-group">
                            <label>Jenis Dokumen</label>
                            <select name="kategori" class="input form-control" id="kategori">
  <?php
foreach($kategori->result_array() as $k)
{
echo"<option value='".$k['id_jk']."'>".$k['jk']."</option>";
}
?>
  </select>
                </div>                                    
				
			
			
			
                           <div class="form-group"> <label>Berkas</label> <input name="userfile" type="file" accept="image/*">* *File yang boleh diupload jpg, jpeg, png, pdf dan maksimal 3MB </div>
              
                                                        
               
                        
                        
		
		
			
			
			
				<input type="submit" value="Simpan Berkas" class="btn btn-danger" tabindex="7">
				
			
			 <br>
			 <input type="hidden" name="id" value="<? echo $id;?>" />
		</form>
		<hr>

<table id="datatable" class="table display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="2%">No</th>
                                <th width="26%">Nama File</th>
                                <th width="58%">Tindakan</th>
                            </tr>
                        </thead>
                     
                        <tbody>             
                                                                        <?php 
$no = 1;
foreach($dok->result_array() as $artikel){
	$file = str_replace('media/file/','',$artikel['berkas']);
		 //$realfile = $path . "/" . $file;
	?>   
                                                                         
                                                            <tr>
                                                              <td><?php echo $no;?></td>
                                                              <td><?php echo $artikel['jk']; ?></td>
                                                              <td><a target="_blank" class="btn btn-primary" href="<?php echo base_url(); ?>media/ktp/<? echo $file;?>" >Tampilkan</a>
                                                              
                                                               
                                                            <a class="btn btn-danger" href="<?php echo base_url()."webadmin/hapusdokumenberat/".$artikel['id_kelengkapanberat'];?>/<?php echo $artikel['id_keberatan']; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
 <i class="glyphicon glyphicon-trash"></i>
 </a>
                                                              
                                                              
                                                              </td>
                                                            </tr>
                                                            
                                                            <?php $no++;} ?>
                                  <tbody> 
						</table>
                                   
                                   
                                     </div>      
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
            