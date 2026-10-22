 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Edit Permohonan Keberatan</h1>
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
                                   		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahkeberatan"> Tambah Data</a>
		  <a class="btn btn-info" href="<?php echo base_url(); ?>webadmin/keberatan">PERMOHONAN BARU</a>
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/keberatanfinal">PERMOHONAN SELESAI</a>
	</div>
                                    <div class="table-responsive">
     <script type="text/javascript" src="<?php echo base_url(); ?>editor/ckeditor/ckeditor.js"></script>
<?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_keberatan'];
}
?>
<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>webadmin/updatekeberatan" role="form">
			
		
		
			
				<hr class="colorgraph">
			
                     <div class="form-group"> <label>No.Register</label> <input class="form-control" value="<? echo $d['register'];?>" required="required" name="register">  </div>
                            
                <div class="form-group"><label>NIK/No.Identitas Pribadi</label>
                        
                  <input class="form-control" value="<? echo $d['nik'];?>" required="required" name="nik_no_ktp"></div>
                        
                <div class="form-group"> <label>Nama Lengkap</label> <input class="form-control" value="<? echo $d['nama'];?>" required="required" name="nama_lengkap">  </div>
                        
                        <div class="form-group"> <label>Upload KTP Pribadi</label> <input name="userfile" type="file" accept="image/*">*File yang boleh diupload jpg, jpeg, png dan maksimal 2MB. </div>
                        
                        
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea rows="3" class="form-control" required name="alamat"><? echo $d['alamat'];?></textarea>
                </div>
                <div class="form-group">
                  <label>Email</label>
                    <input class="form-control" value="<? echo $d['email'];?>" required="required" name="email">
                                                </div>
                <div class="form-group">
                  <label>No Telepon</label>
                    <input class="form-control" value="<? echo $d['phone'];?>" required="required" name="no_telepon">
                                                </div>
                <div class="form-group">
                  <label>Pekerjaan</label>
                    <input class="form-control" value="<? echo $d['pekerjaan'];?>" required="required" name="pekerjaan">
                                                </div>
                                                        
				
			
			<hr class="colorgraph">
			 
                                                         <div class="form-group">
                            <label>Dinas/Kantor/Bagian Tujuan Permintaan</label>
                            <select name="kategori" class="input form-control" id="kategori">
  <?php
	 $tipe=$d['id_skpd'];
foreach($kategori->result_array() as $k)
{
if($k['id_skpd']==$tipe)
{
echo"<option value='".$k['id_skpd']."' selected='selected'>".$k['skpd']."</option>";
}
else{
echo"<option value='".$k['id_skpd']."'>".$k['skpd']."</option>";
}
}
?>
  </select>
                        </div>
                        
			<div class="form-group">
                            <label>Judul Pengaduan*</label>
                            <textarea rows="3" required class="form-control" name="rincian_informasi"><? echo $d['rincian'];?></textarea>
                </div>
                                                        
                <div class="form-group">
                            <label>Isi*</label>
                            <textarea rows="3" required class="form-control" name="tujuan"><? echo $d['tujuan'];?></textarea>
                </div>
                                                        
                                                        
                                                        
                        
                        <div class="form-group">
                            <label>Alasan keberatan* </label><br>
                            <?php if($d['alasan']=="Permohonan informasi ditolak"){ ?>
                             <label class="radio-inline">
                                    <input checked type="radio" required="required" value="Permohonan informasi ditolak" name="cara_mendapatkan">&nbsp;Permohonan informasi ditolak
                                </label>
                          <br>
                            <label class="radio-inline">
                            
                                
                                    <input type="radio" required="required" value="Informasi berkala tidak disediakan " name="cara_mendapatkan">&nbsp;Informasi berkala tidak disediakan 
                                </label>
                            <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi tidak ditanggapi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak ditanggapi
                                </label>
                           <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi ditanggapi tidak sebagaimana yang diminta" name="cara_mendapatkan">&nbsp;Permintaan informasi ditanggapi tidak sebagaimana yang diminta
                                </label>
                           <br>
                            <label class="radio-inline">
                              
                                    <input type="radio" required="required" value="Informasi disampaikan melebihi jangka waktu yang ditentukan" name="cara_mendapatkan">&nbsp;Informasi disampaikan melebihi jangka waktu yang ditentukan
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Permintaan informasi tidak dipenuhi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak dipenuhi
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Biaya yang dikenakan tidak wajar" name="cara_mendapatkan">&nbsp;Biaya yang dikenakan tidak wajar
                                </label>
                            
                            
                            <?php }elseif($d['alasan']=="Informasi berkala tidak disediakan "){ ?>
                            
                             <label class="radio-inline">
                                    <input type="radio" required="required" value="Permohonan informasi ditolak" name="cara_mendapatkan">&nbsp;Permohonan informasi ditolak
                                </label>
                          <br>
                            <label class="radio-inline">
                            
                                
                                    <input checked type="radio" required="required" value="Informasi berkala tidak disediakan " name="cara_mendapatkan">&nbsp;Informasi berkala tidak disediakan 
                                </label>
                            <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi tidak ditanggapi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak ditanggapi
                                </label>
                           <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi ditanggapi tidak sebagaimana yang diminta" name="cara_mendapatkan">&nbsp;Permintaan informasi ditanggapi tidak sebagaimana yang diminta
                                </label>
                           <br>
                            <label class="radio-inline">
                              
                                    <input type="radio" required="required" value="Informasi disampaikan melebihi jangka waktu yang ditentukan" name="cara_mendapatkan">&nbsp;Informasi disampaikan melebihi jangka waktu yang ditentukan
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Permintaan informasi tidak dipenuhi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak dipenuhi
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Biaya yang dikenakan tidak wajar" name="cara_mendapatkan">&nbsp;Biaya yang dikenakan tidak wajar
                                </label>
                            
                            <?php }elseif($d['alasan']=="Permintaan informasi tidak ditanggapi"){ ?>
                            
                             <label class="radio-inline">
                                    <input type="radio" required="required" value="Permohonan informasi ditolak" name="cara_mendapatkan">&nbsp;Permohonan informasi ditolak
                                </label>
                          <br>
                            <label class="radio-inline">
                            
                                
                                    <input type="radio" required="required" value="Informasi berkala tidak disediakan " name="cara_mendapatkan">&nbsp;Informasi berkala tidak disediakan 
                                </label>
                            <br>
                            <label class="radio-inline">
                                
                                    <input checked type="radio" required="required" value="Permintaan informasi tidak ditanggapi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak ditanggapi
                                </label>
                           <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi ditanggapi tidak sebagaimana yang diminta" name="cara_mendapatkan">&nbsp;Permintaan informasi ditanggapi tidak sebagaimana yang diminta
                                </label>
                           <br>
                            <label class="radio-inline">
                              
                                    <input type="radio" required="required" value="Informasi disampaikan melebihi jangka waktu yang ditentukan" name="cara_mendapatkan">&nbsp;Informasi disampaikan melebihi jangka waktu yang ditentukan
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Permintaan informasi tidak dipenuhi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak dipenuhi
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Biaya yang dikenakan tidak wajar" name="cara_mendapatkan">&nbsp;Biaya yang dikenakan tidak wajar
                                </label>
                                
                                <?php }elseif($d['alasan']=="Permintaan informasi ditanggapi tidak sebagaimana yang diminta"){ ?>
                            
                             <label class="radio-inline">
                                    <input type="radio" required="required" value="Permohonan informasi ditolak" name="cara_mendapatkan">&nbsp;Permohonan informasi ditolak
                                </label>
                          <br>
                            <label class="radio-inline">
                            
                                
                                    <input type="radio" required="required" value="Informasi berkala tidak disediakan " name="cara_mendapatkan">&nbsp;Informasi berkala tidak disediakan 
                                </label>
                            <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi tidak ditanggapi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak ditanggapi
                                </label>
                           <br>
                            <label class="radio-inline">
                                
                                    <input checked type="radio" required="required" value="Permintaan informasi ditanggapi tidak sebagaimana yang diminta" name="cara_mendapatkan">&nbsp;Permintaan informasi ditanggapi tidak sebagaimana yang diminta
                                </label>
                           <br>
                            <label class="radio-inline">
                              
                                    <input type="radio" required="required" value="Informasi disampaikan melebihi jangka waktu yang ditentukan" name="cara_mendapatkan">&nbsp;Informasi disampaikan melebihi jangka waktu yang ditentukan
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Permintaan informasi tidak dipenuhi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak dipenuhi
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Biaya yang dikenakan tidak wajar" name="cara_mendapatkan">&nbsp;Biaya yang dikenakan tidak wajar
                                </label>
                                
                                    <?php }elseif($d['alasan']=="Informasi disampaikan melebihi jangka waktu yang ditentukan"){ ?>
                            
                             <label class="radio-inline">
                                    <input type="radio" required="required" value="Permohonan informasi ditolak" name="cara_mendapatkan">&nbsp;Permohonan informasi ditolak
                                </label>
                          <br>
                            <label class="radio-inline">
                            
                                
                                    <input type="radio" required="required" value="Informasi berkala tidak disediakan " name="cara_mendapatkan">&nbsp;Informasi berkala tidak disediakan 
                                </label>
                            <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi tidak ditanggapi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak ditanggapi
                                </label>
                           <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi ditanggapi tidak sebagaimana yang diminta" name="cara_mendapatkan">&nbsp;Permintaan informasi ditanggapi tidak sebagaimana yang diminta
                                </label>
                           <br>
                            <label class="radio-inline">
                              
                                    <input checked type="radio" required="required" value="Informasi disampaikan melebihi jangka waktu yang ditentukan" name="cara_mendapatkan">&nbsp;Informasi disampaikan melebihi jangka waktu yang ditentukan
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Permintaan informasi tidak dipenuhi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak dipenuhi
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Biaya yang dikenakan tidak wajar" name="cara_mendapatkan">&nbsp;Biaya yang dikenakan tidak wajar
                                </label>
                                
                                    <?php }elseif($d['alasan']=="Permintaan informasi tidak dipenuhi"){ ?>
                            
                             <label class="radio-inline">
                                    <input type="radio" required="required" value="Permohonan informasi ditolak" name="cara_mendapatkan">&nbsp;Permohonan informasi ditolak
                                </label>
                          <br>
                            <label class="radio-inline">
                            
                                
                                    <input type="radio" required="required" value="Informasi berkala tidak disediakan " name="cara_mendapatkan">&nbsp;Informasi berkala tidak disediakan 
                                </label>
                            <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi tidak ditanggapi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak ditanggapi
                                </label>
                           <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi ditanggapi tidak sebagaimana yang diminta" name="cara_mendapatkan">&nbsp;Permintaan informasi ditanggapi tidak sebagaimana yang diminta
                                </label>
                           <br>
                            <label class="radio-inline">
                              
                                    <input type="radio" required="required" value="Informasi disampaikan melebihi jangka waktu yang ditentukan" name="cara_mendapatkan">&nbsp;Informasi disampaikan melebihi jangka waktu yang ditentukan
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input checked type="radio" required="required" value="Permintaan informasi tidak dipenuhi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak dipenuhi
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Biaya yang dikenakan tidak wajar" name="cara_mendapatkan">&nbsp;Biaya yang dikenakan tidak wajar
                                </label>
                                
                            <?php }else{ ?>
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="Permohonan informasi ditolak" name="cara_mendapatkan">&nbsp;Permohonan informasi ditolak
                                </label>
                          <br>
                            <label class="radio-inline">
                            
                                
                                    <input type="radio" required="required" value="Informasi berkala tidak disediakan " name="cara_mendapatkan">&nbsp;Informasi berkala tidak disediakan 
                                </label>
                            <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi tidak ditanggapi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak ditanggapi
                                </label>
                           <br>
                            <label class="radio-inline">
                                
                                    <input type="radio" required="required" value="Permintaan informasi ditanggapi tidak sebagaimana yang diminta" name="cara_mendapatkan">&nbsp;Permintaan informasi ditanggapi tidak sebagaimana yang diminta
                                </label>
                           <br>
                            <label class="radio-inline">
                              
                                    <input type="radio" required="required" value="Informasi disampaikan melebihi jangka waktu yang ditentukan" name="cara_mendapatkan">&nbsp;Informasi disampaikan melebihi jangka waktu yang ditentukan
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Permintaan informasi tidak dipenuhi" name="cara_mendapatkan">&nbsp;Permintaan informasi tidak dipenuhi
                                </label>
                            <br>
                            <label class="radio-inline">
                               
                                    <input type="radio" required="required" value="Biaya yang dikenakan tidak wajar" name="cara_mendapatkan">&nbsp;Biaya yang dikenakan tidak wajar
                                </label>
                            
                            
                            
                            <?php } ?>
                        </div>
                        
                       
                        
		
		
			
			<hr class="colorgraph">
			
				<div class="col-xs-12 col-md-6"><input type="submit" value="Simpan" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
				
			
			 <br>
			 <input type="hidden" name="id" value="<? echo $id;?>" />
		</form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            