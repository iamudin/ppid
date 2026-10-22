 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Tambah Data Keluarga</h1>
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
    <a class="btn btn-success" href="<?php echo base_url(); ?>pembantu/tambahprofil"> Tambah Data</a>
        <a class="btn btn-default" href="<?php echo base_url(); ?>pembantu/profil">Refresh</a>
            </div>
                                    <div class="table-responsivex"> 

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
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
            