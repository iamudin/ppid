 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Proses Permohonan Informasi Publik</h1>
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
<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
<tr>
  <td width="57"><strong>Data Pemohon</strong></td>
  <td width="97"><strong>Rincian Informasi</strong></td>
  <td width="107"><strong>Tujuan</strong></td>
  <td width="107"><strong>Tanggal</strong></td>
  <td width="56"><strong>Cara Memperoleh Informasi</strong></td>
  <td width="56"><strong>Mendapatkan Salinan Informasi</strong></td>
  <td width="56"><strong>Status</strong></td>
</tr>
<tbody>
  <?php 
$no = 1;
foreach($edit->result_array() as $artikel){
	$file = str_replace('media/file/','',$artikel['foto']);
		 //$realfile = $path . "/" . $file;
	?>
  <tr class="tr">
  <td><strong><?php echo $artikel['nik']; ?> <a target="_blank" href='<?php echo base_url(); ?>media/ktp/<? echo $file;?>'> <i class="fa fa-search" aria-hidden="true"></i> </a><br>
    
    <?php echo $artikel['nama']; ?></strong><br>
    <?php echo $artikel['alamat']; ?><br>
    <?php echo $artikel['phone']; ?><br>
    <?php echo $artikel['email']; ?><br>
    <?php echo $artikel['jenis']; ?><br> 
  </td>
  <td><?php echo substr($artikel['rincian'],0,100); ?></td>
  <td><?php echo $artikel['tujuan']; ?></td>
  <td><?php echo tgl_indo($artikel['posted_date']); ?></td>
  <td><?php echo $artikel['cara']; ?></td>
  <td><?php echo $artikel['salinan']; ?></td>
  <td><?php echo $artikel['status']; ?></td>
  </tr>
  <?php 
	$no++;
 }
  
?>
</tbody>
</table>
<legend>Proses Permohonan</legend>

<?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_pemohon'];
}
?>

<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>pembantu/updatefinal" role="form">
			
		 <div class="form-group"> <label>No.Register</label> <input readonly class="form-control" value="<? echo $d['register'];?>" required="required" name="register">  </div>
		
			
                    <div class="form-group">
                            <label>Pilih Status Permohonan</label>
                            <select name="kategori" class="input form-control" id="kategori">
  <option value="DIPENUHI">Dipenuhi</option>
  <option value="TIDAK DIPENUHI">Tidak dipenuhi</option>
  <option value="DITOLAK">Ditolak</option>

  </select>
                </div>                                    
				
			<div class="form-group">
                            <label>Link Informasi Publik (Jika informasi telah dipublikasikan)</label>
                            <textarea rows="3" class="form-control" name="rincian_informasi"><?php echo $d['download'];?></textarea>
                </div>
                       
			
			<div class="form-group">
                            <label>Keterangan (Penjelasan apabila informasi publik tidak dipenuhi atau ditolak)</label>
                            <textarea rows="3" class="form-control" name="rincian_informasi2"><?php echo $d['ket'];?>
                            	
                            </textarea>
                </div>
                                                        
               
                        
                        
		
		
			
			
			
				<input type="submit" value="Simpan Permohonan" class="btn btn-primary" tabindex="7">
				
			
			 <br>
			 <input type="hidden" name="id" value="<? echo $id;?>" />
		</form>
<hr class="colorgraph">
<legend>Upload Kelengkapan Berkas</legend>
<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>pembantu/updatefinalberkas" role="form">
			
		
		
			
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
				
			
			
			
                           <div class="form-group"> <label>Berkas</label> <input name="userfile" type="file">*File yang boleh diupload jpg, jpeg, png,pdf dan maksimal 3MB. </div>
              
                                                        
               
                        
                        
		
		
			
			
			
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
                                                              <td><a target="_blank" class="btn btn-primary" href="<?php echo base_url(); ?>media/ktp/<?php echo $artikel['berkas']; ?>" >Tampilkan</a>
                                                              
                                                               
                                               
                                                              
                                                              
                                                              </td>
                                                            </tr>
                                                            
                                                            <?php $no++;} ?>
                                  <tbody> 
						</table>
						
		

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            