

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Tambah Permohonan Keberatan</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Tambah Permohonan Keberatan</h4>
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
                           
                                    
 	<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>webadmin/simpankebaratan" role="form">
			
		
			
			
				<hr class="colorgraph">
			<div class="form-group"> <label>No.Register</label> <input class="form-control" value="" required="required" name="register">  </div>
                        <div class="pilihan_kategori">
                            
                        <div class="form-group"><label>NIK/No.Identitas Pribadi</label><input class="form-control" value="" required="required" name="nik_no_ktp"></div><div class="form-group"> <label>Nama Lengkap</label> <input class="form-control" value="" required="required" name="nama_lengkap">  </div><div class="form-group"> <label>Upload KTP Pribadi</label> <input required="required" name="userfile" type="file" accept="image/*">*File yang boleh diupload jpg, jpeg, png dan maksimal 2MB. </div></div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea rows="3" class="form-control" required name="alamat"></textarea>
                                                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" value="" required="required" name="email">
                                                        </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input class="form-control" value="" required="required" name="no_telepon">
                                                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input class="form-control" value="" required="required" name="pekerjaan">
                                                        </div>
                                                        
				
			
			<hr class="colorgraph">
			                             <div class="form-group">
                            <label>Dinas/Kantor/Bagian Tujuan Permintaan</label>
                            <select name="kategori2"  id="kategori" class="form-control">
<option value="">Pilih SKPD/OPD</option>
<?php
foreach($kategori->result_array() as $k)
{
echo"<option value='".$k['id_skpd']."'>".$k['skpd']."</option>";
}
?>
</select>
                        </div>
			<div class="form-group">
                            <label>Judul Pengaduan<em class="required-star">*</em> </label>
                            <textarea rows="3" required class="form-control" name="rincian_informasi"></textarea>
                                                        </div>
                                                        
                                                        <div class="form-group">
                            <label>Alasan keberatan<em class="required-star">*</em></label>
                            
                            <br>
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
                            
                           
                                                       
                                                        
                                                          </div>
                                                        
                        <div class="form-group">
                            <label>Isi<em class="required-star">*</em></label>
                            <textarea rows="5" required class="form-control" name="tujuan"></textarea>
                                                        </div>
                                                        
                                                        
                        
                       
                       
                            
		
			
			<hr class="colorgraph">
			
				<div class="col-xs-12 col-md-6"><input type="submit" value="Simpan" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
				
			
			 <br>
		</form>
                                   
                                 </div>      
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->