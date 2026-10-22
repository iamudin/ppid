

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Galeri Foto</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Galeri Foto</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <?php
                                $id2=$this->uri->segment(4);
                                ?>
                               
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahalbum"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/tambahfoto/<?php echo $id2;?>">Refresh</a>
		</div>
                                    <div class="table-responsive5">
   <?php
	foreach($edit->result_array() as $d)
	{
		$id = $d["id_foto"];
		$ket= $d["keterangan"];
		$foto = $d["foto_besar"];
		$al = $d["id_album"];
	}
?>
<?php echo form_open_multipart('webadmin/updatefoto');?>
<input type="hidden" name="id_foto" value="<?php echo $id; ?>" />
<div class="form-group">
                            <label class="control-label">Juduls Berita Foto</label>
<select disabled name="album" class="input form-control" style="width:75%;">
<?php
foreach($album->result_array() as $k)
{
if($k['id_album']==$al)
{
echo"<option value='".$k['id_album']."' selected='selected'>".$k['nama_album']."</option>";
}
else{
echo"<option value='".$k['id_album']."'>".$k['nama_album']."</option>";
}
}
?>
</select>
</div>

<div class="form-group">
                            <label class="control-label form-control">
                            Foto</label>
                            <input type="file" name="userfile" size="50" /></div>
                            
<div class="form-group">
                            <label class="control-label">
                            Keterangan</label>
                            <textarea name="keterangan" id="alamat" class="area form-control" style="width:75%;"><? echo $ket;?></textarea></div>
                            
<div class="form-group">
                            <label class="control-label">Gambar Thumbnail</label><br /><img src="<?php echo base_url(); ?>asset/galeri/original/<?php echo $foto ?>" width="150"/><br /> *Kosongkan saja, jika gambar thumbnail tidak diganti
                            </div>
                            <input type="submit" value="Upload Foto" class="btn btn-primary" name="upload"/>
</form> 
                       
							</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

