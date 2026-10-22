<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Permohonan Keberatan</h6>
			<h2>PPID Kabupaten Bengkalis</h2>
			<div class="dlab-separator-outer ">
                                <div class="dlab-separator bg-warning style-skew"></div>
                            </div>
		</div>
		<div class="container">
			
				
				<div class="bookoing-secrty">
                        <div class="all-pacj-dfgh">
                            <h6>Identitas Pemohon</h6>
                        </div>
                        <div class="bookk0-natd-form">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>web/simpanpemohon">
                        <div class="form-group">
                            <label for="name">NIK/No.Identitas Pribadi</label>
                           <input placeholder="NIK/No.Identitas Pribadi" class="form-control" value="" required="required" name="nik_no_ktp">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Nama Lengkap</label>
                            <input placeholder="Nama Lengkap" class="form-control" value="" required="required" name="nama_lengkap">
                        </div>
                        <div class="form-group">
                            <label for="email">Upload KTP Pribadi</label>
                            <input class="form-control" required="required" name="userfile" type="file" accept="image/*">*File yang boleh diupload jpg, jpeg, png dan maksimal 2MB.
                        </div>
                        <div class="form-group">
                            <label for="phone">Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" id="phone">
                        </div>

                         <div class="form-group">
                            <label for="phone">Email</label>
                            <input placeholder="Email" class="form-control" value="" required="required" name="email">
                        </div>
                         <div class="form-group">
                            <label for="phone">No.Telepon</label>
                            <input placeholder="No.Telepon" class="form-control" value="" required="required" name="no_telepon">
                        </div>

                         <div class="form-group">
                            <label for="phone">Pekerjaan</label>
                            <input placeholder="Pekerjaan" class="form-control" value="" required="required" name="pekerjaan">
                        </div>

                       

                      

                   

                        <div class="form-group mainm-sel">
                            <label for="text" id="form-control">Dinas/Kantor/Bagian Tujuan Permintaan</label>
                                <div class="select-box">
                                    <span class="sec-po"></span>
                                    <select name="kategori2" id="text">
                                       <option value="">Pilih SKPD/OPD</option>
<?php
foreach($kategori2->result_array() as $k)
{
echo"<option value='".$k['id_skpd']."'>".$k['skpd']."</option>";
}
?>
                                    </select>
                                    <div class="serv-ivmf-2 book-in">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </div>
                            </div>

 <div class="form-group">
                            <label for="phone">Judul Pengaduan</label>
                            <input placeholder="Judul Pengaduan" class="form-control" value="" required="required" name="rincian_informasi">
                        </div>

                         <div class="form-group">
                            <label for="phone">Alasan keberatan</label>
                           
                           <div class="form-check">
  <label class="form-check-label">
                               <input type="radio" required="required" value="Permohonan informasi ditolak" name="cara_mendapatkan"> Permohonan informasi ditolak
                            </label>
                        </div>
                           <div class="form-check">
  <label class="form-check-label">
                                <input type="radio" required="required" value="Informasi berkala tidak disediakan " name="cara_mendapatkan"> Informasi berkala tidak disediakan 
                           </label></div>

                           <div class="form-check">
  <label class="form-check-label">
                                <input type="radio" required="required" value="Permintaan informasi tidak ditanggapi" name="cara_mendapatkan"> Permintaan informasi tidak ditanggapi
                           </label></div>
                           <div class="form-check">
  <label class="form-check-label">
                                <input type="radio" required="required" value="Permintaan informasi ditanggapi tidak sebagaimana yang diminta" name="cara_mendapatkan"> Permintaan informasi ditanggapi tidak sebagaimana yang diminta
                           </label></div> 

                            <div class="form-check">
  <label class="form-check-label">
                                    <input type="radio" required="required" value="Informasi disampaikan melebihi jangka waktu yang ditentukan" name="cara_mendapatkan"> Informasi disampaikan melebihi jangka waktu yang ditentukan
                                </label>
                            </div>
                            
                             <div class="form-check">
  <label class="form-check-label">
                                    <input type="radio" required="required" value="Permintaan informasi tidak dipenuhi" name="cara_mendapatkan"> Permintaan informasi tidak dipenuhi
                                </label>
                            </div>
                            
                             <div class="form-check">
  <label class="form-check-label">
                                    <input type="radio" required="required" value="Biaya yang dikenakan tidak wajar" name="cara_mendapatkan"> Biaya yang dikenakan tidak wajar
                                </label>
                            </div>

                       </div>

              <div class="form-group">
                            <label for="phone">Isi</label>
                            <input placeholder="Isi" class="form-control" value="" required="required" name="tujuan">
                        </div>           

                       
                       
                      
                    <div class="sunb-btn-naple">
                                <input type="submit" value="Simpan" class="submit widet btn-lg" tabindex="7">
                            </div>

                    </form>
                        </div>
                    </div>	
				
			
			<!--Model box-->
			
 
						
		</div>
	</section>
	<!-- team end-->