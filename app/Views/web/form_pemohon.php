<section id="tour-des" class="bg-gray">
		<div class="content-box">
			<h6 style="text-transform: capitalize;">Form Permohonan</h6>
			<h2>Informasi Publik Perorangan</h2>
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

                        <div class="form-group">
                            <label for="phone">Rincian Informasi</label>
                            <input type="text" name="rincian_informasi" class="form-control" placeholder="Rincian Informasi">


                        </div>

                        <div class="form-group">
                            <label for="phone">Tujuan Penggunaan Informasi</label>
                            <input type="text" name="tujuan" class="form-control" placeholder="Tujuan Penggunaan Informasi">
                        </div>

                   

                        <div class="form-group mainm-sel">
                            <label for="text" id="form-control">Dinas/Kantor/Bagian Tujuan Permintaan</label>
                                <div class="select-box">
                                    <span class="sec-po"></span>
                                    <select name="kategori2" id="text">
                                       <option value="">Pilih PPID Utama/Pembantu</option>
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
                            <label for="phone">Cara Memperoleh Informasi</label>
                           
                           <div class="form-check">
  <label class="form-check-label">
                                <input type="radio" required="required" value="melihat" name="cara_memperoleh"> Melihat
                            </label>
                        </div>
                           <div class="form-check">
  <label class="form-check-label">
                                <input type="radio" required="required" value="membaca" name="cara_memperoleh"> Membaca
                           </label></div>

                           <div class="form-check">
  <label class="form-check-label">
                                <input type="radio" required="required" value="mendengarkan" name="cara_memperoleh"> Mendengarkan
                           </label></div>
                           <div class="form-check">
  <label class="form-check-label">
                                <input type="radio" required="required" value="mencatat" name="cara_memperoleh"> Mencatat
                           </label></div> </div>

                         <div class="form-group">
                            <label for="phone"> Mendapatkan Salinan Informasi</label>
                           
                       

                         <div class="form-group">
                       <div class="form-check">
  <label class="form-check-label">
                                <input type="radio" required="required" value="softcopy" name="mendapatkan_salinan"> Softcopy
                            </label></div>
                           <div class="form-check">
  <label class="form-check-label">
                                <input type="radio" required="required" value="hardcopy" name="mendapatkan_salinan"> Hardcopy
                            </label></div>
 </div>

                        <div class="form-group">
                            <label for="phone">Cara Mendapatkan Salinan Informasi</label>
                           
                       

                          <div class="form-check">
  <label class="form-check-label">
                                    <input type="radio" required="required" value="Datang Langsung" name="cara_mendapatkan"> Datang Langsung
                                </label>
                            </div>
                           <div class="form-check">
  <label class="form-check-label">
                                    <input type="radio" required="required" value="Via Pos" name="cara_mendapatkan"> Via Pos
                                </label>
                            </div>
                          <div class="form-check">
  <label class="form-check-label">
                                    <input checked type="radio" required="required" value="Website" name="cara_mendapatkan"> Email/Upload File
                                </label>
                            </div>
                         </div>
                       
                      
                    <div class="sunb-btn-naple">
                                <input type="submit" value="Simpan" class="submit widet btn-lg" tabindex="7">
                            </div>

                    </form>
                        </div>
                    </div>
			
 
						
		</div>
	</section>
	<!-- team end-->