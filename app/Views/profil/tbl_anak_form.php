
        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Profil Pegawai</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Update Anak</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
    <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>profil/create"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>profil">Refresh</a>
            </div> <div class="table-responsive5">   

        <form action="<?php echo $action3; ?>" method="post">
	   <input type="hidden" name="id_profil" value="<?php echo $id_profil; ?>" /> 
	    <div class="form-group">
            <label for="varchar">Nama Anak <?php echo form_error('nama_anak') ?></label>
            <input type="text" class="form-control" name="nama_anak" id="nama_anak" placeholder="Nama Anak" value="<?php echo $nama_anak; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Jk <?php echo form_error('id_jk') ?></label>
            <select name="id_jk" class="input form-control" id="id_jk">
  <?php
foreach($jk->result_array() as $k)
{
if($k['id_kelamin']==$id_jk)
{
echo"<option value='".$k['id_kelamin']."' selected='selected'>".$k['kelamin']."</option>";
}
else{
echo"<option value='".$k['id_kelamin']."'>".$k['kelamin']."</option>";
}
}
?>
  </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Pendidikan <?php echo form_error('pendidikan') ?></label>
            <input type="text" class="form-control" name="pendidikan" id="pendidikan" placeholder="Pendidikan" value="<?php echo $pendidikan; ?>" />
        </div>
	    <input type="hidden" name="id_anak" value="<?php echo $id_anak; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	   
	</form>
</div>   
</div>
</div>
</div>
 
 </div>
            </div>
        </div>
   