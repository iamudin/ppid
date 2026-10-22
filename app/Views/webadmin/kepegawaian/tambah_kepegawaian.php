 <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Kepegawaian</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Kepegawaian</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahkepegawaian"> Tambah Data</a>&nbsp;
        <a class="btn btn-info" href="<?php echo base_url(); ?>webadmin/tambahjabatan">Tambah Jabatan</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/kepegawaian">Refresh</a>
		
	</div>
                                    <div class="table-responsive5">
           <script type="text/javascript" src="<?php echo base_url(); ?>editor/ckeditor/ckeditor.js"></script>
<?php echo form_open_multipart('webadmin/simpanpegawai');?>

<div class="form-group">
                            <label class="control-label">NIP</label>
<input type="search" name="nip" class="form-control" size="75" id="nip"/>
</div>
<div class="form-group">
                            <label class="control-label">Nama Pegawai</label>
<input type="search" name="nama"  size="55" class="form-control" id="nama"/>
</div>
<div class="form-group">
                            <label class="control-label">Kelahiran</label>
                            <input type="search" name="kelahiran" class="form-control"id="kelahiran"/></div>
                            <div class="form-group">
                            <label class="control-label">JK</label><select name="editor" class="form-control">
  <option value="L">PRIA</option>
  <option value="P">WANITA</option>
</select></div>
<div class="form-group">
                            <label class="control-label">
                            
                            Pend.Terakhir</label>
                            <input type="search" name="pendidikan" class="form-control" id="pendidikan"/></div>
                            
                            <div class="form-group">
                            <label class="control-label">Pangkat/Golongan</label>
                            <input type="search" name="golongan" class="form-control" id="golongan"/></div>
                            <div class="form-group">
                            <label class="control-label">Jabatan</label>
<select name="kategori"  id="kategori" class="form-control">
<option value="1">Pilih Jabatan</option>
<?php
foreach($kategori->result_array() as $k)
{
echo"<option value='".$k['id_jabatan']."'>".$k['jabatan']."</option>";
}
?>
</select>&nbsp;<span class="listinput">
</span>
</div>

<div class="form-group">
                            <label class="control-label">Riwayat Pekerjaan</label>
                            
  <textarea class="ckeditor form-control" name="content"></textarea>
  <input type="hidden" name="tipe" value="berita" /></div>
  
  <div class="form-group">
                            <label class="control-label">Facebook</label>
                            <input placeholder="https://www.facebook.com/HumasBengkalis/" type="search" name="fb" class="form-control" id="kelahiran"/>
                            </div>
 
   <div class="form-group">
                            <label class="control-label">Intagram</label>
                            <input placeholder="https://www.instagram.com/HumasBengkalis/" type="search" name="ig" class="form-control" id="kelahiran"/>
                            </div>
   <div class="form-group">
                            <label class="control-label">Email</label>
                            <input placeholder="humasbengkalis@gmail.com" type="search" name="email" class="form-control" id="kelahiran"/>
                            </div>                                                      
  <div class="form-group">
                            <label class="control-label">
  Foto Thumbnail</label>
  <input type="file" name="userfile" size="40"/></div>
  
 <input type="submit"  value="Simpan" class="btn btn-primary"/>
            </form>                             
							</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->