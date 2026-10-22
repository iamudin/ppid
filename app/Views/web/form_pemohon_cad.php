<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>web/simpanpemohon" role="form">
			
		
			<div class="row">
			<h2>Identitas Pemohon</h2>
				<hr class="colorgraph">
			
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
                                                        
				
			<h2>Data Permohonan</h2>
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
foreach($kategori2->result_array() as $k)
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
                            <label>Mendapatkan Salinan Informasi</label><br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="softcopy" name="mendapatkan_salinan">Softcopy
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="hardcopy" name="mendapatkan_salinan">Hardcopy
                            </label>
                        </div>
                        
                              <div class="form-group">
                            <label>Cara Mendapatkan Salinan Informasi</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" required="required" value="Datang Langsung" name="cara_mendapatkan">Datang Langsung
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" required="required" value="Via Pos" name="cara_mendapatkan">Via Pos
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input checked type="radio" required="required" value="Website" name="cara_mendapatkan">Email/Upload File
                                </label>
                            </div>
                            
		
			
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"><input type="submit" value="Simpan" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
				
			</div>
			 <br>
		</form>