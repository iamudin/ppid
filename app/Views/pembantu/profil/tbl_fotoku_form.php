 <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon"><i class="pe-7s-door-lock"></i></div>
                    <div class="header-title">
                        <h1>Tambah Foto Profil</h1>
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

                <form enctype="multipart/form-data" action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label for="varchar">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
            <input readonly="" type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
        </div>
<img style="width:75px;" src="<?php echo base_url(); ?>asset/profil/<?php echo $foto_profil; ?>"/>
        <div class="form-group">
            <label for="varchar">Foto Profil <?php echo form_error('foto') ?></label>
           

             <input class="form-control" type="file" name="userfile" size="40"/>

        </div>
       
        <input type="hidden" name="id_profil" value="<?php echo $id_profil; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('pembantu/profil') ?>" class="btn btn-default">Cancel</a>
    </form>


               </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section> <!-- /.content -->
            </div> <!-- /.content-wrapper -->
   