

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Ubah Permohonan Informasi Publik</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Ubah Permohonan Informasi Publik</h4>
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

            </div>                <div class="table-responsive">

<?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_pemohon'];
}
?>

<form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>webadmin/updatepermohonan" role="form">
			
		
		
			
				<hr class="colorgraph">
			<div class="form-group"> <label>No.Register</label> <input class="form-control" value="<? echo $d['register'];?>" required="required" name="register">  </div>
                        <div class="form-group">
                            <label>Kategori</label><br>
                            <?php if($d['jenis']=="PRIBADI"){ ?>
                            <label class="radio-inline">
                                <input checked type="radio" required="required" value="PRIBADI" name="katku">&nbsp;PERORANGAN
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="PERUSAHAAN" name="katku">&nbsp;KELOMPOK BERBADAN HUKUM
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="ORMAS" name="katku">&nbsp;KELOMPOK MASYARAKAT
                            </label>
                            <?php }elseif($d['jenis']=="PERUSAHAAN"){?>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="PRIBADI" name="katku">&nbsp;PERORANGAN
                            </label>
                            <label class="radio-inline">
                                <input checked type="radio" required="required" value="PERUSAHAAN" name="katku">&nbsp;KELOMPOK BERBADAN HUKUM
                            </label>
                            
                            <label class="radio-inline">
                                <input type="radio" required="required" value="ORMAS" name="katku">&nbsp;KELOMPOK MASYARAKAT
                            </label>
                            
                            <?php }else{ ?>
                            
                            <label class="radio-inline">
                                <input type="radio" required="required" value="PRIBADI" name="katku">&nbsp;PERORANGAN
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="PERUSAHAAN" name="katku">&nbsp;KELOMPOK BERBADAN HUKUM
                            </label>
                            
                            <label class="radio-inline">
                                <input checked type="radio" required="required" value="ORMAS" name="katku">&nbsp;KELOMPOK MASYARAKAT
                            </label>
                            
                            <?php } ?>
                        </div>
                            
                <div class="form-group"><label>NIK/No.Identitas Pribadi (Khusus Perusahaan Masukkan
nomor akta pendirian yang telah terdaftar di Kementerian Hukum dan Hak
Asasi Manusia/Pengadilan Negeri serta lampirkan gambar akta pendirian
yang berlaku. )</label>
                        
                  <input class="form-control" value="<? echo $d['nik'];?>" required="required" name="nik_no_ktp"></div>
                        
                <div class="form-group"> <label>Nama Lengkap</label> <input class="form-control" value="<? echo $d['nama'];?>" required="required" name="nama_lengkap">  </div>
                        
                        <div class="form-group"> <label>Upload KTP Pribadi ( Khusus Perusahaan Upload Gambar Akta )</label> <input name="userfile" type="file" accept="image/*">*File yang boleh diupload jpg, jpeg, png dan maksimal 2MB. </div>
                        
                        
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
                            <label>Rincian Informasi</label>
                            <textarea rows="3" required class="form-control" name="rincian_informasi"><? echo $d['rincian'];?></textarea>
                </div>
                                                        
                <div class="form-group">
                            <label>Tujuan Penggunaan Informasi</label>
                            <textarea rows="3" required class="form-control" name="tujuan"><? echo $d['tujuan'];?></textarea>
                </div>
                                                        
                                                        
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
                            <label>Cara Memperoleh Informasi</label><br>
                            <?php if($d['cara']=="melihat"){ ?>
                            <label class="radio-inline">
                                <input checked type="radio" required="required" value="melihat" name="cara_memperoleh">&nbsp;Melihat
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
                            <?php }elseif($d['cara']=="membaca"){ ?>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="melihat" name="cara_memperoleh">&nbsp;Melihat
                            </label>
                            <label class="radio-inline">
                                <input checked type="radio" required="required" value="membaca" name="cara_memperoleh">&nbsp;Membaca
                            </label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="mendengarkan" name="cara_memperoleh">&nbsp;Mendengarkan
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="mencatat" name="cara_memperoleh">&nbsp;Mencatat
                            </label>
                            
                            <?php }elseif($d['cara']=="mendengarkan"){ ?>
                            
                            <label class="radio-inline">
                                <input type="radio" required="required" value="melihat" name="cara_memperoleh">&nbsp;Melihat
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="membaca" name="cara_memperoleh">&nbsp;Membaca
                            </label>
                            <br>
                            <label class="radio-inline">
                                <input checked type="radio" required="required" value="mendengarkan" name="cara_memperoleh">&nbsp;Mendengarkan
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="mencatat" name="cara_memperoleh">&nbsp;Mencatat
                            </label>
                            
                            <?php }else{ ?>
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
                                <input checked type="radio" required="required" value="mencatat" name="cara_memperoleh">&nbsp;Mencatat
                            </label>
                            
                            
                            <?php } ?>
                        </div>
           <div class="form-group">
                            <label>Cara Mendapatkan Salinan Informasi</label><br>
                             <?php if($d['cara2']=="Datang Langsung"){ ?>
                            <label class="radio-inline">
                                    <input checked type="radio" required="required" value="Datang Langsung" name="cara_mendapatkan">&nbsp;Datang Langsung
                                </label>
                            
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="Via Pos" name="cara_mendapatkan">&nbsp;Via Pos
                                </label>
                            
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="Website" name="cara_mendapatkan">&nbsp;Website
                                </label>
                                <?php }elseif($d['cara2']=="Via Pos"){ ?>
                                <label class="radio-inline">
                                    <input type="radio" required="required" value="Datang Langsung" name="cara_mendapatkan">&nbsp;Datang Langsung
                                </label>
                            
                            <label class="radio-inline">
                                    <input checked type="radio" required="required" value="Via Pos" name="cara_mendapatkan">&nbsp;Via Pos
                                </label>
                            
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="Website" name="cara_mendapatkan">&nbsp;Website
                                </label>
                                <?php }else{ ?>
                                <label class="radio-inline">
                                    <input type="radio" required="required" value="Datang Langsung" name="cara_mendapatkan">&nbsp;Datang Langsung
                                </label>
                            
                            <label class="radio-inline">
                                    <input type="radio" required="required" value="Via Pos" name="cara_mendapatkan">&nbsp;Via Pos
                                </label>
                            
                            <label class="radio-inline">
                                    <input checked type="radio" required="required" value="Website" name="cara_mendapatkan">&nbsp;Website
                                </label>
                                
                                <?php } ?>
                           
	 </div>
                        <div class="form-group">
                            <label>Mendapatkan Salinan Informasi</label><br>
                            <?php if($d['salinan']=="softcopy"){ ?>
                            <label class="radio-inline">
                                <input checked type="radio" required="required" value="softcopy" name="mendapatkan_salinan">&nbsp;Softcopy
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="hardcopy" name="mendapatkan_salinan">&nbsp;Hardcopy
                            </label>
                            <?php }else{ ?>
                            
                            <label class="radio-inline">
                                <input type="radio" required="required" value="softcopy" name="mendapatkan_salinan">&nbsp;Softcopy
                            </label>
                            <label class="radio-inline">
                                <input checked type="radio" required="required" value="hardcopy" name="mendapatkan_salinan">&nbsp;Hardcopy
                            </label>
                            
                            <?php } ?>
                        </div>
                        
                            <div class="form-group">
                            <label>Mekanisme Permohonan</label><br>
                            <?php if($d['cara3']=="Mengambil Langsung"){ ?>
                            <label class="radio-inline">
                                <input checked type="radio" required="required" value="Mengambil Langsung" name="mendapatkan_salinan2">&nbsp;Datang Langsung
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="Website" name="mendapatkan_salinan2">&nbsp;Website
                            </label>
                            <?php }else{ ?>
                            
                            <label class="radio-inline">
                                <input type="radio" required="required" value="Mengambil Langsung" name="mendapatkan_salinan2">&nbsp;Datang Langsung
                            </label>
                            <label class="radio-inline">
                                <input checked type="radio" required="required" value="Website" name="mendapatkan_salinan2">&nbsp;Website
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
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

