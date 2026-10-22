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
                                   	<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahpermohonan"> Tambah Data</a>
                                   	
		  <a class="btn btn-default" href="<?php echo base_url(); ?>webadmin/permohonan">Refresh</a>
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/permohonanfinal">Data Yang Selesai</a>
	
	</div>
                                    
 <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>webadmin/simpanpermohonan" role="form">
			
		
		
			
				<hr class="colorgraph">
			
                        <div class="form-group">
                            <label>Kategori</label><br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="PRIBADI" name="katku">Pribadi
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="PERUSAHAAN" name="katku">Perusahaan
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
                                <input type="radio" required="required" value="melihat" name="cara_memperoleh">Melihat
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="membaca" name="cara_memperoleh">Membaca
                            </label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="mendengarkan" name="cara_memperoleh">Mendengarkan
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="mencatat" name="cara_memperoleh">Mencatat
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Cara Mendapatkan Salinan Informasi</label><br>
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="mengambil_langsung" name="cara_mendapatkan">Mengambil Langsung
                                </label>
                            
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="faksimili" name="cara_mendapatkan">Faksimili
                                </label>
                            
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="email" name="cara_mendapatkan">Email/Upload File
                                </label>
                           
	 </div>
                        <div class="form-group">
                            <label>Mendapatkan Salinan Informasi</label><br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="softcopy" name="mendapatkan_salinan">Softcopy
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="hardcopy" name="mendapatkan_salinan">Hardcopy
                            </label>
                        </div>
                        
                        
		
		
			
			<hr class="colorgraph">
			
				<div class="col-xs-12 col-md-6"><input type="submit" value="Simpan" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
				
			
			 <br>
		</form>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            