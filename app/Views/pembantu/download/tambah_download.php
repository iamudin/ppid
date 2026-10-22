 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Informasi Publik</h1>
                        <small><?php echo $this->config->item("nama_aplikasi_full"); ?></small>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url(); ?>app_admin_home"><i class="pe-7s-home"></i> Home</a></li>
                            
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
	<a class="btn btn-success" href="<?php echo base_url(); ?>pembantu/tambahdownload"> Tambah Data</a>
        <a class="btn btn-default" href="<?php echo base_url(); ?>pembantu/download">Refresh</a>
			</div>
                      <script type="text/javascript" src="<?php echo base_url(); ?>editor/ckeditor/ckeditor.js"></script>
                      <?php echo form_open_multipart('pembantu/simpandownload');?>
 <div class="form-group">
                            <label class="control-label">Judul</label>
  <input type="search" name="judul" class="form-control"size="75" id="judul"/>
 </div>
  <div class="form-group">
                            <label class="control-label">Type Informasi Publik</label>
  <select name="kategori"  id="kategori2" class="form-control">
    <option value="">Pilih Type</option>
    <?php
foreach($kategori->result_array() as $k)
{
echo"<option value='".$k['id']."'>".$k['title']."</option>";
}
?>
    </select>
    </div>
    
    
     
    
    
     <div class="form-group">
                            <label class="control-label">
    Keterangan</label>

    <textarea id="alamat" name="putusan" class="ckeditor form-control"></textarea></div>
    
    
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
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            