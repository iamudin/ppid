

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Menu Statis</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Menu Statis</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">

                                <form method="post" action="<?php echo base_url(); ?>webadmin/simpanmenu">
<div class="form-group">
                            <label class="control-label">Menu Induk</label>
 <select class="form-control" name="kategori"  id="kategori2">
    <option value="induk">MENU INDUK</option>
    <?php
foreach($daftar->result_array() as $k)
{
echo"<option value='".$k['id']."'>".$k['title']."</option>";
}
?>
    </select></div>
    <div class="form-group">
                            <label class="control-label">Label Menu</label>
       <input class="form-control" type="search" name="permalink" id="permalink" /></div>
       <div class="form-group">
                            <label class="control-label">Pilihan</label>
<input checked name="visible" type="radio" value="Y">Download / Upload &nbsp;<input name="visible" type="radio" value="N">
Statis &nbsp;<input name="visible" type="radio" value="LINK">
Link &nbsp;<input name="visible" type="radio" value="BERITA">
Berita</div>

<div class="form-group">
                            <label class="control-label">
                            Link</label>
                            <input class="form-control" type="search" name="permalink2" id="permalink2" /> * Masukan Link Tujuan Jika Pilihan (LINK)</div>
                            <input type="submit" value="Simpan Data" class="btn btn-primary" />
</form> 
                               
                  <hr>            
                             
                          <?php
$i=1;
foreach($daftar->result_array() as $artikel)
{
	?>
    <blockquote class="blockquote">
 <p class="text-muted m-b-30 font-16"><?php echo $artikel['title']; ?>
  <a href="<?php echo base_url()."webadmin/ubahmenu/".$artikel['id'];?>"><i class="fa fa-edit"></i></a>
  <a onClick="return confirm('Anda yakin ingin menghapus data ini?')" href="<?php echo base_url()."webadmin/hapusmenu/".$artikel['id'];?>"><i class="fa fa-trash"></i></a>
		
  <?
    $sm = $this->Webadmin_model->Semua_Sitemap_Anak($artikel['id']);
	foreach($sm->result() as $sma)
	{
		?>
  <footer class="blockquote-footer font-14"><?php echo $sma->title; ?> 
  <a href="<?php echo base_url()."webadmin/ubahmenu/".$sma->id;?>"><i class="fa fa-edit"></i></a>
  <a onClick="return confirm('Anda yakin ingin menghapus data ini?')" href="<?php echo base_url()."webadmin/hapusmenu/".$sma->id;?>"><i class="fa fa-trash"></i></a></footer>
  <?
	}
	?>
</blockquote></p>
    
    <?
}
?>       
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


       