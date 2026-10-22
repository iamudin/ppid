
        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Tambah Data Kelurga</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Tambah Foto Profil</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">

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
        <a href="<?php echo site_url('profil') ?>" class="btn btn-default">Cancel</a>
    </form>


            </div>
          </div>
        </div>
      </div> 
    </div>
    </div>
   