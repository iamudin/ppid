

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Berita</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Berita</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahberita"><i class="fa fa-plus-square"></i></a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/berita"><i class="fa fa-refresh"></i></a>&nbsp;
        
        <a class="btn btn-info" href="<?php echo base_url(); ?>webadmin/tagar"><i class="fa fa-tag"></i></a>
	</div>

	
   
	                                     

                                    <div class="table-responsive5s">


<?php echo form_open_multipart('webadmin/simpanberita');?>

 <input type="hidden" name="id_berita" value="<?php echo $unik; ?>" />
<div class="form-group">
                            <label class="control-label">Sub Judul</label>
 <input type="search" name="anakjudul" class="form-control"/>
 </div>
 <div class="form-group">
                            <label class="control-label">
 Judul Berita</label>
 
  <input class="form-control" type="search" name="judul"/></div>
  <div class="form-group">
                            <label class="control-label">Kategori</label>
  
<select name="kategori"  id="kategori" class="form-control">
<?php
foreach($kategori->result_array() as $k)
{
echo"<option value='".$k['id']."'>Berita ".$k['title']."</option>";
}
?>
</select></div>
<div class="form-group" style="display: none;">
                            <label class="control-label">
Lead Berita</label>
<textarea class="form-control" name="lite"></textarea></div>
  
  <div class="form-group">
                            <label class="control-label">Isi Berita</label>
 
  <textarea id="editor" class="ckeditor form-control" name="content"></textarea>



  <input type="hidden" name="tipe" value="berita" /></div>
    <div class="form-group">
                            <label class="control-label">Tag</label>
  
<select multiple="multiple" style="width:100%;" name="tag[]"  id="demo9">
<?php
foreach($tag->result_array() as $k)
{
echo"<option value='".$k['id_tag']."'>".$k['tag']."</option>";
}
?>
</select></div>
 <div class="form-group">
                            <label class="control-label"> Gambar Thumbnail *Abaikan Jika Ingin Menggunakan Gambar Dari URL/Link</label>
  
  <input type="file" name="userfile" size="40" class="form-control"/></div>

    <div class="form-group">
                            <label class="control-label">
Gambar Thumbnail Dari URL/Link</label>

<div class="input-group mb-3">
  <input name="url_gambar" type="text" id="fieldID4" class="form-control" placeholder="URL Gambar">
  <div class="input-group-append">
    <a class="btn btn-success" data-toggle="modal"  href="javascript:;" data-target="#myModal">Cari Gambar</a>
  </div>
</div>


  </div>
  
  <div class="form-group">
                            <label class="control-label">Ket Foto</label>
  
    <input type="search" name="ket_foto"  size="55" class="form-control"/>
    </div>
    
      <div class="form-group" style="display: none;">
                            <label class="control-label">Headline</label>
                     <select name="headline" class="form-control">        
  <option value="HEADLINE" selected="selected">HEADLINE</option>
<option value="">TIDAK</option>
</select>
    </div>
    
      <div class="form-group">
                            <label class="control-label">Editor</label>
  
    <input type="search" name="edi"  size="55" class="form-control"/>
    </div>
    
      <div class="form-group">
                            <label class="control-label">Reporter</label>
  
    <input type="search" name="rep"  size="55" class="form-control"/>
    </div>
    
      <div class="form-group">
                            <label class="control-label">Fotografer</label>
  
    <input type="search" name="fot"  size="55" class="form-control"/>
    </div>
    
<input type="submit"  value="Simpan Data" class="btn btn-primary"/>
            </form>						</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

       

