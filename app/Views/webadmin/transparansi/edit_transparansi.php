

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Transparansi</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Transparansi</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahtransparansi"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/transparansi">Refresh</a>
            </div>
                      
  <?php
	foreach($edit->result_array() as $d)
	{
		$a= $d["id_tahun"];
		$b= $d["judul"];
		$type= $d["id_jenistransparansi"];
		$nn=$d['file'];
		$o=$d['id_transparansi'];
	}
?>

<?php echo form_open_multipart('webadmin/updatetransparansi');?>
<div class="form-group">
                            <label class="control-label">Judul</label>
    <input class="form-control" name="judul" type="search" id="judul" value="<?php echo $b; ?>"  size="75"/></div>
    
     <div class="form-group">
                            <label class="control-label">Jenis Transparansi</label>
 <select name="kategori2" class="input form-control" id="kategori">
  <?php
	 $tipe=$d['id_jenistransparansi'];
foreach($kategori2->result_array() as $k)
{
if($k['id_jenistransparansi']==$tipe)
{
echo"<option value='".$k['id_jenistransparansi']."' selected='selected'>".$k['jenistransparansi']."</option>";
}
else{
echo"<option value='".$k['id_jenistransparansi']."'>".$k['jenistransparansi']."</option>";
}
}
?>
  </select></div>

<div class="form-group">
                            <label class="control-label">Tahun</label>
 <select name="tahun" class="input form-control" id="kategori">
  <?php
     $tipe=$d['id_tahun'];
foreach($tahun->result_array() as $k)
{
if($k['id_tahun']==$tipe)
{
echo"<option value='".$k['id_tahun']."' selected='selected'>".$k['tahun']."</option>";
}
else{
echo"<option value='".$k['id_tahun']."'>".$k['tahun']."</option>";
}
}
?>
  </select></div>

  <div class="form-group">
                            <label class="control-label">Perangkat Daerah</label>
 <select name="id_skpd" class="input form-control" id="id_skpd">
  <option value="">Perangkat Daerah</option>
  <?php
     $tipe=$d['id_skpd'];
foreach($skpd->result_array() as $k)
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

    
   <input name="id_berita" type="hidden" id="id_berita" value="<?php echo $o; ?>" />
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
