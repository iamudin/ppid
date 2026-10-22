

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
                      <?php echo form_open_multipart('webadmin/simpantransparansi');?>
 <div class="form-group">
                            <label class="control-label">Judul</label>
  <input type="search" name="judul" class="form-control"size="75" id="judul"/>
 </div>
    
      <div class="form-group">
                            <label class="control-label">Jenis Transparansi</label>
  
<select name="kategori2"  id="kategori" class="form-control">
<option value="">Pilih jenis</option>
<?php
foreach($kategori2->result_array() as $k)
{
echo"<option value='".$k['id_jenistransparansi']."'>".$k['jenistransparansi']."</option>";
}
?>
</select></div>

  <div class="form-group">
                            <label class="control-label">Tahun</label>
  
<select name="tahun"  id="tahun" class="form-control">
<option value="">Pilih Tahun</option>
<?php
foreach($tahun->result_array() as $k)
{
echo"<option value='".$k['id_tahun']."'>".$k['tahun']."</option>";
}
?>
</select></div>
    
    <div class="form-group">
                            <label class="control-label">Perangkat Daerah</label>
  
<select name="id_skpd"  id="id_skpd" class="form-control">
<option value="">Perangkat Daerah</option>
<?php
foreach($skpd->result_array() as $k)
{
echo"<option value='".$k['id_skpd']."'>".$k['skpd']."</option>";
}
?>
</select></div>
  
    
    <input type="hidden" name="tipe" value="berita" />
     <div class="form-group">
                            <label class="control-label">
    File Download</label>
  <input type="file" name="userfile" size="40" class="form-control"/></div>
  
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
