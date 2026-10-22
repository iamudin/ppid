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
        <?php
	foreach($edit->result_array() as $d)
	{
		$id = $d["id_kepegawaian"];
		$anak = $d["nip"];
		$judul = $d["nama_pegawai"];
		$isi = $d["riwayat"];
		$gambar = $d['gambar'];
		$tipe = $d['kode_jabatan'];
        $ed=$d['jk'];
		$ed2=$d['kelahiran'];
		$ed3=$d['pangkat/gol'];
		$ed4=$d['pend_terakhir'];
		
		$f=$d['fb'];
		$i=$d['ig'];
		$e=$d['email'];
	}
?>
<script type="text/javascript" src="<?php echo base_url(); ?>editor/ckeditor/ckeditor.js"></script>
<?php echo form_open_multipart('webadmin/updatepegawai');?>
<div class="form-group">
                            <label class="control-label">NIP</label>
                            <input name="nip" type="search" class="input form-control" id="nip" value="<?php echo $anak; ?>" size="75"/>
</div><div class="form-group">
                            <label class="control-label">
                            Nama Pegawai</label>
                            <input name="nama" type="search" class="input form-control" id="nama" style="width:90%" value="<?php echo $judul; ?>" size="45"/>
</div>

<div class="form-group">
                            <label class="control-label">Kelahiran</label>
                            <input name="kelahiran" type="search" id="kelahiran" class="form-control" value="<?php echo $ed2; ?>"  size="75"/></div>
                            <div class="form-group">
                            <label class="control-label">JK</label>
                            <select name="editor" class="input form-control">
  <?
if($ed==L){
	?>
  <option value="L" selected="selected">PRIA</option>
  <option value="P">WANITA</option>
  <?
}
else
{
?>
  <option value="L">PRIA</option>
  <option value="P" selected="selected">WANITA</option>
  <?
}
?>
    
</select></div>
<div class="form-group">
                            <label class="control-label">Pend.Terakhir</label>

<input name="pendidikan" type="search" id="pendidikan" class="form-control" value="<?php echo $ed4; ?>"  size="75"/></div>
<div class="form-group">
                            <label class="control-label">
Pangkat/Golongan</label>
<input name="golongan" type="search" class="form-control" id="golongan" value="<?php echo $ed3; ?>"/></div>

<div class="form-group">
                            <label class="control-label">Jabatan</label>
                            <select name="kategori" class="input form-control" id="kategori">
  <?php
foreach($kategori->result_array() as $k)
{
if($k['id_jabatan']==$tipe)
{
echo"<option value='".$k['id_jabatan']."' selected='selected'>".$k['jabatan']."</option>";
}
else{
echo"<option value='".$k['id_jabatan']."'>".$k['jabatan']."</option>";
}
}
?>
  </select></div>
<div class="form-group">
                            <label class="control-label">Riwayat Pekerjaan</label>
                            
                            <textarea class="ckeditor form-control" name="content"><?php echo $isi;  ?></textarea><input type="hidden" name="id_berita" value="<?php echo $id; ?>" /></div>

  <div class="form-group">
                            <label class="control-label">Facebook</label>
                            <input value="<?php echo $f; ?>" placeholder="https://www.facebook.com/HumasBengkalis/" type="search" name="fb" class="form-control" id="kelahiran"/>
                            </div>
 
   <div class="form-group">
                            <label class="control-label">Intagram</label>
                            <input value="<?php echo $i; ?>" placeholder="https://www.instagram.com/HumasBengkalis/" type="search" name="ig" class="form-control" id="kelahiran"/>
                            </div>
   <div class="form-group">
                            <label class="control-label">Email</label>
                            <input value="<?php echo $e; ?>" placeholder="humasbengkalis@gmail.com" type="search" name="email" class="form-control" id="kelahiran"/>
                            </div>
                            
<div class="form-group">
                            <label class="control-label">
                            Gambar Thumbnail</label>
                            <img src="<?php echo base_url(); ?>asset/pegawai/<?php echo $gambar ?>" width="100"/><br />
  <input type="file" name="userfile" size="40"/><br /> *Kosongkan saja, jika gambar thumbnail tidak diganti</div>
  
  <input type="submit"  value="Simpan Data" class="btn btn-primary"/>
            </form>                                
							</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->