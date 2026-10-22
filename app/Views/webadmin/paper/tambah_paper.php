

        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li class="breadcrumb-item"><a href="#"><?php echo $judul_lengkap.'  '.$instansi; ?></a></li>
                                    <li class="breadcrumb-item"><a href="#">Paper</a></li>
                                   
                                </ol>
                            </div>
                            <h4 class="page-title">Paper</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->

                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                   	<div class="btn-toolbar" style="margin-bottom:20px;">
		<a class="btn btn-success" href="<?php echo base_url(); ?>webadmin/tambahpaper"> Tambah Data</a>&nbsp;
        <a class="btn btn-danger" href="<?php echo base_url(); ?>webadmin/paper">Refresh</a>
	
	</div>
                                    <div class="table-responsive5">
  <form enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>webadmin/simpanpaper">
<div class="form-group">
                            <label class="control-label">Judul paper</label>
                            
                            <input type="search" name="nama" class="input form-control" size="35" /></div>
                            
                            <div class="form-group">
                            <label class="control-label">Url Issu</label>
                          
                            <input type="search" name="username" class="input form-control" size="30" id="username"/>
                            </div>
                            <div class="form-group">
                            <label class="control-label">
                            Cover</label>
                            <input class="form-control" type="file" name="userfile" size="50" />
                            </div>

  <div class="form-group" style="display:none;">
                            <label class="control-label">
                            File PDF</label>
                            <input class="form-control" type="file" name="userfile2" size="50" />
                            </div>

                             <button type="submit" class="btn btn-primary">Simpan Data</button>
   
</form> 
                          				</div>   
                             
                              
                               
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
            