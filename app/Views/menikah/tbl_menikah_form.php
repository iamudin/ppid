
        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Status Pernikahan</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Status Pernikahan</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
    <div class="btn-toolbar" style="margin-bottom:20px;">
            <a class="btn btn-success" href="<?php echo base_url(); ?>menikah/create"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>menikah">Refresh</a>
            </div> <div class="table-responsive5"> 

        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Menikah <?php echo form_error('menikah') ?></label>
            <input type="text" class="form-control" name="menikah" id="menikah" placeholder="Menikah" value="<?php echo $menikah; ?>" />
        </div>
	    <input type="hidden" name="id_menikah" value="<?php echo $id_menikah; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('menikah') ?>" class="btn btn-default">Cancel</a>
	</form>
 </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
    </div>
   