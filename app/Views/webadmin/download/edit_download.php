

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Informasi Publik</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Informasi Publik</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahdownload"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/download">Refresh</a>
            </div>
                      
  <?php
	foreach($edit->result_array() as $d)
	{
		$a= $d["ket"];
		$b= $d["download"];
		$type= $d["kode_menu"];
		$nn=$d['file'];
		$o=$d['kode_download'];
	}
?>

<?php echo form_open_multipart('webadmin/updatedownload');?>
<div class="form-group">
                            <label class="control-label">Judul</label>
    <input class="form-control" name="judul" type="search" id="judul" value="<?php echo $b; ?>"  size="75"/></div>
   <div class="form-group">
                            <label class="control-label">Type Informasi Publik</label>
 <select name="kategori"  id="kategori2" class="form-control">
    <option value="1">Pilih Type</option>
    <?php
foreach($kategori->result_array() as $k)
{
if($k['id']==$type)
{
echo"<option value='".$k['id']."' selected='selected'>".$k['title']."</option>";
}
else{
echo"<option value='".$k['id']."'>".$k['title']."</option>";
}
}
?>
    
    </select></div>
    
     <div class="form-group">
                            <label class="control-label">PPID Utama/Pembantu</label>
 <select name="kategori2" class="input form-control" id="kategori">
  <?php
	 $tipe=$d['id_skpd'];
foreach($kategori2->result_array() as $k)
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
  </select></div>
    
    <div class="form-group">
                            <label class="control-label">Keterangan</label>
    <textarea id="alamat" name="putusan" class="ckeditor form-control"><?php echo $a; ?></textarea>
    <input name="id_berita" type="hidden" id="id_berita" value="<?php echo $o; ?>" /></div>
    <div class="form-group">
                            <label class="control-label">File Download</label>
 
  <input class="form-control" type="file" name="userfile" size="40"/></div>
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
