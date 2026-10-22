

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

	
   
	                                     

                                    <div class="table-responsived">
    <?php
	foreach($edit->result_array() as $d)
	{
		$id = $d["id_berita"];
		$judul = $d["judul_berita"];
		$isi = $d["isi"];
		$gambar = $d['gambar'];
		$tipe = $d['id_kategori'];
		$ket  = $d['ket_foto'];
		$l  = $d['lite'];
		$anak  = $d['anak'];
		$headline=$d['status'];
		$edi  = $d['editor'];
		$rep  = $d['reporter'];
		$fot  = $d['video'];
        $url_gambar  = $d['url_gambar'];
	}
?>

<?php echo form_open_multipart('webadmin/updateberita');?>
<div class="form-group">
                            <label class="control-label">Sub Judul</label>
                            <input name="anakjudul" type="search" class="input form-control" value="<?php echo $anak; ?>"/></div>
                            
  <div class="form-group">
                            <label class="control-label">Judul Berita</label>
                            
                            <input type="search" name="judul" class="input form-control" value="<?php echo $judul; ?>"/></div>
  
<div class="form-group">
                            <label class="control-label">Kategori Berita</label>
 <select name="kategori" class="input form-control" id="kategori">
  <?php
foreach($kategori->result_array() as $k)
{
if($k['id']==$tipe)
{
echo"<option value='".$k['id']."' selected='selected'>".$k['title']."</option>";
}
else{
echo"<option value='".$k['id']."'>".$k['title']."</option>";
}
}
?>
  </select></div>
  
<div class="form-group" style="display: none;">
                            <label class="control-label">Lead Berita</label>
<textarea class="form-control" name="lite"><?php echo $l;  ?></textarea></div>
  
  <div class="form-group">
                            <label class="control-label">Isi Berita</label>

<textarea id="editor" class="ckeditor form-control" name="content"><?php echo $isi;  ?></textarea>



<input type="hidden" name="id_berita" value="<?php echo $id; ?>" /></div>

<div class="form-group">
                            <label class="control-label">Tag</label>
 <select multiple="multiple" style="width:100%;" name="tag[]" id="demo9">

 <?php
foreach($tag->result_array() as $d)
{
$cek= $this->db->query("SELECT
*
FROM
tbl_tagdetail
 where tbl_tagdetail.id_berita='$id' AND tbl_tagdetail.id_tag='".$d['id_tag']."'");
  if($cek->num_rows() == 1)
             {
				?>	
					<option value="<?php echo $d['id_tag']; ?>" selected="selected"><?php echo $d['tag']; ?></option>
				
			  <?
			 }
			 else
			 {
			 ?>
                <option value="<?php echo $d['id_tag']; ?>"><?php echo $d['tag']; ?></option>    
				<?php
			 }
			}

?>
  </select></div>
  
<div class="form-group">
                            <label class="control-label">
Gambar Thumbnail *Abaikan Jika Ingin Menggunakan Gambar Dari URL/Link</label>
  <img src="<?php echo base_url(); ?>asset/berita/thumb/<?php echo $gambar ?>" width="100"/><br />
  <input type="file" name="userfile" size="40" class="form-control"/><br /> *Kosongkan saja, jika gambar thumbnail tidak diganti
  </div>

    <div class="form-group">
                            <label class="control-label">
Gambar Thumbnail Dari URL/Link</label>

<div class="input-group mb-3">
  <input value="<?php echo $url_gambar; ?>" name="url_gambar" type="text" id="fieldID4" class="form-control" placeholder="URL Gambar">
  <div class="input-group-append">
    <a class="btn btn-success" data-toggle="modal"  href="javascript:;" data-target="#myModal">Cari Gambar</a>
  </div>
</div>


  <div class="form-group">
                            <label class="control-label">
  Ket Foto</label>
<input name="ket_foto" type="search" class="input form-control" value="<?php echo $ket; ?>" size="45"/>
  </div>
  
       <div class="form-group" style="display: none;">
                            <label class="control-label">Headline</label>
                     <select name="headline" class="form-control">
<?
if($headline=="HEADLINE"){
	?>
<option value="HEADLINE" selected="selected">HEADLINE</option>
<option value="">TIDAK</option>
<?
}
else
{
	?>
    <option value="HEADLINE">HEADLINE</option>
<option value="" selected="selected">TIDAK</option>
	<?
}
?>
</select>
    </div>
    
    <div class="form-group">
                            <label class="control-label">Editor</label>
  
    <input type="search" name="edi"  value="<?php echo $edi; ?>" size="55" class="form-control"/>
    </div>
    
      <div class="form-group">
                            <label class="control-label">Reporter</label>
  
    <input type="search" name="rep"  value="<?php echo $rep; ?>" size="55" class="form-control"/>
    </div>
    
      <div class="form-group">
                            <label class="control-label">Fotografer</label>
  
    <input type="search" name="fot"  value="<?php echo $fot; ?>" size="55" class="form-control"/>
    </div>
<input type="submit"  value="Simpan Data" class="btn btn-primary"/>
</table>
            </form>						</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->

       