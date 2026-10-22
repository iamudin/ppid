

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Tambah Permohonan Informasi Publik</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Tambah Permohonan Informasi Publik</h4>
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
                  *Khusus Permohonan Kelompok Masyarakat Klik Di Sini <a class="btn btn-sm btn-danger" href="<?php echo base_url(); ?>webadmin/tambahpermohonanbantu">Tambah </a>                  
 <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>webadmin/simpanpermohonan" role="form">
			
		
		
			
				<hr class="colorgraph">
			 <div class="form-group"> <label>No.Register</label> <input class="form-control" value="" required="required" name="register">  </div>
                       
                       
                        <div class="form-group">
                            <label>Kategori</label><br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="PRIBADI" name="katku">&nbsp;Pribadi
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="PERUSAHAAN" name="katku">&nbsp;Perusahaan
                            </label>
                        </div>
                            
                        <div class="form-group"><label>NIK/No.Identitas Pribadi (Khusus Perusahaan Masukkan nomor akta pendirian yang telah terdaftar di Kementerian Hukum/Hak Azasi Manusia/Pengadilan Negeri serta lampirkan gambar akta pendirian yang berlaku. )</label>
                        
                        <input class="form-control" value="" required="required" name="nik_no_ktp"></div>
                        
                        <div class="form-group"> <label>Nama Lengkap</label> <input class="form-control" value="" required="required" name="nama_lengkap">  </div>
                        
                        <div class="form-group"> <label>Upload KTP Pribadi ( Khusus Perusahaan Upload Gambar Akta )</label> <input required="required" name="userfile" type="file" accept="image/*">*File yang boleh diupload jpg, jpeg, png dan maksimal 2MB. </div>
                        
                        
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
                            <label>Rincian Informasi</label>
                            <textarea rows="3" required class="form-control" name="rincian_informasi"></textarea>
                                                        </div>
                                                        
                        <div class="form-group">
                            <label>Tujuan Penggunaan Informasi</label>
                            <textarea rows="3" required class="form-control" name="tujuan"></textarea>
                                                        </div>
                                                        
                                                        
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
                            <label>Cara Memperoleh Informasi</label><br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="melihat" name="cara_memperoleh">&nbsp;Melihat
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="membaca" name="cara_memperoleh">&nbsp;Membaca
                            </label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="mendengarkan" name="cara_memperoleh">&nbsp;Mendengarkan
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="mencatat" name="cara_memperoleh">&nbsp;Mencatat
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Cara Mendapatkan Salinan Informasi</label><br>
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="mengambil_langsung" name="cara_mendapatkan">&nbsp;Mengambil Langsung
                                </label>
                            
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="faksimili" name="cara_mendapatkan">&nbsp;Faksimili
                                </label>
                            
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="email" name="cara_mendapatkan">&nbsp;Email/Upload File
                                </label>
                           
	 </div>
                        <div class="form-group">
                            <label>Mendapatkan Salinan Informasi</label><br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="softcopy" name="mendapatkan_salinan">&nbsp;Softcopy
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="hardcopy" name="mendapatkan_salinan">&nbsp;Hardcopy
                            </label>
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

