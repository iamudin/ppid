

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Video</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Video</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahvideo"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/video">Refresh</a>
	</div>
                                    <div class="table-responsive5">
        <?php
foreach($edit->result_array() as $d)
{
	$id = $d['id_video'];
	$tipe=$d['id_kategori'];
}
?>
    
<form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>webadmin/updatevideo">
<div class="form-group">
                            <label class="control-label">Judul Video</label>
                            
                           <input type="search" value="<? echo $d['judul_video'];?>" name="nama" class="input form-control" size="35"/></div>
                           
<div class="form-group">
                            <label class="control-label">Kategori</label>
                            
                            <select name="kategori" class="input form-control" id="kategori">
  <?php
foreach($kategori->result_array() as $k)
{
if($k['id_kategori']==$tipe)
{
echo"<option value='".$k['id_kategori']."' selected='selected'>".$k['kategori']."</option>";
}
else{
echo"<option value='".$k['id_kategori']."'>".$k['kategori']."</option>";
}
}
?>
  </select></div>
  
<div class="form-group">
                            <label class="control-label">
                            
                            URL Youtube</label>
                            <input name="username" type="search" class="input form-control"  id="username" value="<? echo $d['url'];?>" size="30" /></div>
                            
                            <div class="form-group">
                            <label class="control-label">File</label>
                            <input class="form-control" type="file" name="userfile" size="50" /></div>
                            
                            <div class="form-group">
                            <label class="control-label">Gambar Thumbnail</label>
                            
                            <img width="120" src="<?php echo base_url(); ?>asset/banner/<?php echo $d['gambar']; ?>"/><br /> *Kosongkan saja, jika gambar thumbnail tidak diganti</div>
                            
                             <div class="form-group">
                            <label class="control-label">Videografer</label>
  
    <input type="search" value="<? echo $d['penulis'];?>" name="fot"  size="55" class="form-control"/>
    </div>
    
<button type="submit" class="btn btn-primary">Simpan Data</button>
  
<input type="hidden" name="id" value="<? echo $id;?>" />
</form>
                                             
							</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->