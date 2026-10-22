

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Pengumuman</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Pengumuman</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
			<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahpengumuman"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/pengumuman">Refresh</a>
	
	</div>
                                    <div class="table-responsive5">
          <script type="text/javascript" src="<?php echo base_url(); ?>editor/ckeditor/ckeditor.js"></script>
<?php
	foreach($detail->result_array() as $d)
	{
		$id = $d["id_pengumuman"];
		$judul = $d["judul_pengumuman"];
		$isi = $d["isi"];
	}
?>
<?php echo form_open_multipart('webadmin/updatepengumuman');?>
<div class="form-group">
                            <label class="control-label">Judul</label>
    
  <input type="search" name="judul" class="input form-control"
 value="<?php echo $judul; ?>"/>
  <input type="hidden" name="id_pengumuman" value="<?php echo $id; ?>" />
 </div>
 <div class="form-group">
                            <label class="control-label">
 Isi Content</label>
<textarea class="ckeditor form-control" name="content"><?php echo $isi; ?></textarea>
</div>

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

            