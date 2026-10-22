

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Banner</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Banner</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
	<div class="btn-toolbar" style="margin-bottom:20px;">
			<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahbanner"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/banner">Refresh</a>
			</div>
<?php
	foreach($edit->result_array() as $d)
	{
		$id = $d["id_banner"];
		$ket= $d["keterangan"];
		$foto = $d["foto_besar"];
		$al = $d["judul"];
	}
?>
<?php echo form_open_multipart('webadmin/updatebanner');?>
<input type="hidden" name="id_foto" value="<?php echo $id; ?>" />
<div class="form-group">
                            <label class="control-label">Nama File</label>
                            
                            <input value="<? echo $al;?>" type="search" name="nama" class="input form-control" />
                            </div>
                            <div class="form-group">
                            <label class="control-label">File
                            </label>
                           <input class="form-control" type="file" name="userfile" size="50" />
                           </div>
                           
                           <div class="form-group">
                            <label class="control-label">
                           Keterangan/Link</label>
                           <textarea name="keterangan" id="alamat" class="area form-control"><? echo $ket;?></textarea>
                           </div>
                           
                           <div class="form-group">
                            <label class="control-label">
                           Gambar Thumbnail </label>
                           :<br /><img style="width:100%" src="<?php echo base_url(); ?>asset/banner/<?php echo $foto ?>"/><br /> *Kosongkan saja, jika gambar thumbnail tidak diganti
</div>

 <button type="submit" class="btn btn-primary">Simpan Data</button>

</form> 
                                   
                                   
                                 
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->



